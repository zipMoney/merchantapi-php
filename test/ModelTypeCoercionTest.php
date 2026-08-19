<?php

declare(strict_types=1);

/**
 * ModelTypeCoercionTest.
 *
 * @category Class
 *
 * @see     https://github.com/zipMoney/merchantapi-php
 */

namespace zipMoney;

use PHPUnit\Framework\TestCase;
use zipMoney\Model\Address;
use zipMoney\Model\CheckoutOrder;
use zipMoney\Model\OrderItem;
use zipMoney\Model\OrderShippingTracking;
use zipMoney\Model\Shopper;

/**
 * PHP 8 stopped coercing arguments to strlen() and strtolower(), so the length
 * checks in these models turn a non-string into a fatal TypeError rather than a
 * validation result. That is not hypothetical: a shop passing an integer order
 * id into setCartReference() took its own checkout down in production (ZES-91).
 *
 * Every case below is a value a plugin can realistically hand over — an integer
 * id, a missing optional field — and the point of each assertion is that the
 * call returns instead of fataling.
 */
class ModelTypeCoercionTest extends TestCase
{
    /**
     * The exact call from the production stack trace.
     */
    public function testSetCartReferenceAcceptsAnInteger(): void
    {
        $order = new CheckoutOrder();
        $order->setCartReference(146);

        self::assertSame(146, $order->getCartReference(), 'The value is stored as given; only the length check casts.');
    }

    public function testSetReferenceAcceptsAnInteger(): void
    {
        $order = new CheckoutOrder();
        $order->setReference(146);

        self::assertSame(146, $order->getReference());
    }

    /**
     * A length limit still has to be enforced once the value is a string, and
     * the caller should see a domain error rather than a fatal.
     */
    public function testTooLongReferenceStillRaisesAnArgumentError(): void
    {
        $this->expectException(\InvalidArgumentException::class);

        (new CheckoutOrder())->setReference(str_repeat('x', 201));
    }

    /**
     * Plugins build these through the constructor array, which writes straight
     * to the container and bypasses the setters. valid() is the other door into
     * the same length checks, so it has to survive the same values.
     */
    public function testValidationSurvivesIntegersFromTheConstructorArray(): void
    {
        $order = new CheckoutOrder([
            'reference' => 146,
            'cart_reference' => 146,
            'amount' => '120.00',
            'currency' => 'AUD',
        ]);

        self::assertIsBool($order->valid());
        self::assertIsArray($order->listInvalidProperties());
    }

    /**
     * Address checks line1, city, state, postal_code and country without an
     * is_null guard, so a shopper with no second address line — or an order
     * with no shipping address at all — used to reach strlen(null), deprecated
     * since PHP 8.1 and a TypeError in 9.
     */
    public function testAddressValidationSurvivesMissingFields(): void
    {
        $address = new Address();

        self::assertIsArray($address->listInvalidProperties());
        self::assertIsBool($address->valid());
    }

    public function testAddressAcceptsANumericPostcode(): void
    {
        $address = new Address();
        $address->setPostalCode(2000);

        self::assertSame(2000, $address->getPostalCode());
    }

    /**
     * SKUs are frequently numeric in the shop's own database.
     */
    public function testOrderItemAcceptsANumericProductCode(): void
    {
        $item = new OrderItem();
        $item->setProductCode(12345);

        self::assertSame(12345, $item->getProductCode());
    }

    public function testShippingTrackingAcceptsANumericConsignmentNumber(): void
    {
        $tracking = new OrderShippingTracking();
        $tracking->setNumber(900123456789);

        self::assertSame(900123456789, $tracking->getNumber());
    }

    /**
     * setGender() runs the value through ucfirst(strtolower(...)), so it hits
     * the same coercion problem from a different direction.
     */
    public function testGenderIsNormalisedRatherThanRejectedOnCase(): void
    {
        $shopper = new Shopper();
        $shopper->setGender('male');

        self::assertSame('Male', $shopper->getGender());
    }

    /**
     * A value that is not a gender must still be refused — but as an argument
     * error the caller can catch, not a TypeError from strtolower().
     */
    public function testNonStringGenderRaisesAnArgumentErrorNotATypeError(): void
    {
        $this->expectException(\InvalidArgumentException::class);

        (new Shopper())->setGender(123);
    }
}
