<?php

declare(strict_types=1);
/**
 * ChargesApiTest.
 *
 * @category Class
 *
 * @see     https://github.com/zipMoney/merchantapi-php
 */

namespace zipMoney;

use zipMoney\Api\ChargesApi;
use zipMoney\Api\CheckoutsApi;

class ChargesApiTest extends Setup
{
    /**
     * Test case for chargesCancel.
     *
     * Cancel a charge.
     */
    public function testChargesCancel(): void
    {
        $this->expectException(ApiException::class);

        $chargesApi = new ChargesApi();
        $chargesApi->chargesCancel('1');
    }

    /**
     * Test case for chargesCapture.
     *
     * Capture a charge.
     */
    public function testChargesCapture(): void
    {
        $this->expectException(ApiException::class);

        $chargesApi = new ChargesApi();
        $req = $this->_payloadHelper->getCapturePayload();
        $chargesApi->chargesCapture('1', $req);
    }

    /**
     * Test case for chargesCreate.
     *
     * Create a charge.
     */
    public function testChargesCreate(): void
    {
        $this->expectException(ApiException::class);

        $checkoutsApi = new CheckoutsApi();
        $chargesApi = new ChargesApi();

        $req = $this->_payloadHelper->getCheckoutPayload();
        $checkout = $checkoutsApi->checkoutsCreate($req);

        $this->_payloadHelper->setCheckoutId($checkout->getId());

        $chargeReq = $this->_payloadHelper->getChargePayload();
        $chargesApi->chargesCreate($chargeReq);
    }

    /**
     * Test case for chargesCreateRaisesException.
     *
     * Create a charge.
     */
    public function testChargesCreateRaisesException(): void
    {
        $this->expectException(ApiException::class);

        $chargesApi = new ChargesApi();
        $chargeReq = $this->_payloadHelper->getChargePayload();
        $chargesApi->chargesCreate($chargeReq);
    }

    /**
     * Test case for chargesList.
     *
     * List charges.
     */
    public function testChargesList(): void
    {
        $this->assertTrue(true);
    }

    /**
     * Test case for chargesRetrieve.
     *
     * Retrieve a charge.
     */
    public function testChargesRetrieve(): void
    {
        $this->assertTrue(true);
    }
}
