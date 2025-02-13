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
     *
     * @expectedException  \zipMoney\ApiException
     *
     * @expectedExceptionMessage An error occurred while processing payment
     */
    public function testChargesCancel()
    {
        $chargesApi = new ChargesApi;
        $response = $chargesApi->chargesCancel('1');
    }

    /**
     * Test case for chargesCapture.
     *
     * Capture a charge.
     *
     * @expectedException  \zipMoney\ApiException
     *
     * @expectedExceptionMessage An error occurred while processing payment
     */
    public function testChargesCapture()
    {
        $chargesApi = new ChargesApi;
        $req = $this->_payloadHelper->getCapturePayload();
        $response = $chargesApi->chargesCapture('1', $req);
    }

    /**
     * Test case for chargesCreate.
     *
     * Create a charge.
     *
     * @expectedException  \zipMoney\ApiException
     *
     * @expectedExceptionMessage An error occurred while processing payment
     */
    public function testChargesCreate()
    {
        $checkoutsApi = new CheckoutsApi;
        $chargesApi = new ChargesApi;

        $req = $this->_payloadHelper->getCheckoutPayload();
        $checkout = $checkoutsApi->checkoutsCreate($req);

        $this->_payloadHelper->setCheckoutId($checkout->getId());

        $chargeReq = $this->_payloadHelper->getChargePayload();
        $response = $chargesApi->chargesCreate($chargeReq);

        $this->assertTrue(true);
    }

    /**
     * Test case for chargesCreateRaisesException.
     *
     * Create a charge.
     *
     * @expectedException  \zipMoney\ApiException
     *
     * @expectedExceptionMessage An error occurred while processing payment
     */
    public function testChargesCreateRaisesException()
    {
        $chargesApi = new ChargesApi;
        $chargeReq = $this->_payloadHelper->getChargePayload();
        $response = $chargesApi->chargesCreate($chargeReq);

        $this->assertTrue(true);
    }

    /**
     * Test case for chargesList.
     *
     * List charges.
     */
    public function testChargesList()
    {
        $this->assertTrue(true);
    }

    /**
     * Test case for chargesRetrieve.
     *
     * Retrieve a charge.
     */
    public function testChargesRetrieve()
    {
        $this->assertTrue(true);
    }
}
