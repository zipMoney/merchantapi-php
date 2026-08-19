<?php

declare(strict_types=1);

/**
 * MagentoParityTest.
 *
 * @category Class
 *
 * @see     https://github.com/zipMoney/merchantapi-php
 */

namespace zipMoney;

use PHPUnit\Framework\TestCase;
use zipMoney\Model\Address;
use zipMoney\Model\CaptureChargeRequest;
use zipMoney\Model\CreateRefundRequest;
use zipMoney\Model\Shopper;

/**
 * The Magento 2 module carried its own copy of this library for years and grew
 * fields and tolerances that never came back here. Moving that module onto the
 * Composer package surfaced them the hard way — a capture and a refund both
 * died on an undefined method.
 *
 * These tests are what stops the same gap opening again.
 */
class MagentoParityTest extends TestCase
{
    /**
     * Capturing part of an authorisation has to say so, or Zip releases the
     * remainder. The module sets this on every capture.
     */
    public function testCaptureCanBeMarkedPartial(): void
    {
        $request = new CaptureChargeRequest();
        $request->setCaptureIsPartial(true);

        self::assertTrue($request->getCaptureIsPartial());
    }

    /**
     * A caller that never heard of the flag must keep the old behaviour.
     */
    public function testCaptureIsWholeByDefault(): void
    {
        self::assertFalse((new CaptureChargeRequest())->getCaptureIsPartial());
    }

    public function testPartialCaptureIsSerialised(): void
    {
        $request = new CaptureChargeRequest(['amount' => 10.0, 'is_partial_capture' => true]);
        $payload = (array) ObjectSerializer::sanitizeForSerialization($request);

        self::assertArrayHasKey('is_partial_capture', $payload);
        self::assertTrue($payload['is_partial_capture']);
    }

    /**
     * A shop selling in more than one currency cannot be refunded correctly
     * from the amount alone.
     */
    public function testRefundCarriesACurrency(): void
    {
        $request = new CreateRefundRequest();
        $request->setCurrency('AUD');

        self::assertSame('AUD', $request->getCurrency());
    }

    public function testRefundWithoutACurrencyIsInvalid(): void
    {
        $request = new CreateRefundRequest([
            'charge_id' => 'ch_123',
            'reason' => 'customer changed their mind',
            'amount' => 10.0,
        ]);

        self::assertFalse($request->valid());
        self::assertContains("'currency' can't be null", $request->listInvalidProperties());
    }

    public function testRefundWithACurrencyIsValid(): void
    {
        $request = new CreateRefundRequest([
            'charge_id' => 'ch_123',
            'reason' => 'customer changed their mind',
            'amount' => 10.0,
            'currency' => 'AUD',
        ]);

        self::assertTrue($request->valid());
    }

    /**
     * Gender is optional. A shop that does not know it passes null, and the
     * Magento module does exactly that whenever the customer attribute has been
     * removed — getOptionText() returns null for an option id that no longer
     * exists.
     */
    public function testUnknownGenderIsAccepted(): void
    {
        $shopper = new Shopper();
        $shopper->setGender(null);

        self::assertNull($shopper->getGender());
    }

    public function testWrongGenderIsStillRefused(): void
    {
        $this->expectException(\InvalidArgumentException::class);

        (new Shopper())->setGender('helicopter');
    }

    /**
     * Whole countries have no state or province. Sending "state": "" makes Zip
     * interpret an empty string as a value; leaving the field out does not.
     */
    public function testBlankStateIsLeftOutOfThePayload(): void
    {
        $address = new Address();
        $address->setLine1('1 Test St');
        $address->setCity('Sydney');
        $address->setState('');
        $address->setPostalCode('2000');
        $address->setCountry('AU');

        $payload = (array) ObjectSerializer::sanitizeForSerialization($address);

        self::assertArrayNotHasKey('state', $payload, 'An empty state must not reach the payload at all.');
    }

    public function testAStateThatExistsIsStillSent(): void
    {
        $address = new Address();
        $address->setState('NSW');

        $payload = (array) ObjectSerializer::sanitizeForSerialization($address);

        self::assertSame('NSW', $payload['state']);
    }

    /**
     * deserialize() is static and called sanitizeFilename() as though it were a
     * global function, so the one path that uses it — a file response with a
     * Content-Disposition header — died with "undefined function".
     */
    public function testSanitizeFilenameIsReachableFromStaticContext(): void
    {
        self::assertSame('report.pdf', ObjectSerializer::sanitizeFilename('../../etc/report.pdf'));
    }
}
