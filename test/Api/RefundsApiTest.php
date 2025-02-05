<?php
declare(strict_types=1);
/**
 * RefundsApiTest
 * PHP version 5.
 *
 * @category Class
 *
 * @see     https://github.com/zipMoney/merchantapi-php
 */

namespace zipMoney;

use zipMoney\Api\RefundsApi;

class RefundsApiTest extends Setup
{
    /**
     * Test case for refundsCreate.
     *
     * Create a refund.
     *
     * @expectedException  \zipMoney\ApiException
     *
     * @expectedExceptionMessage An error occurred while processing payment
     */
    public function testRefundsCreate()
    {
        $refundsApi = new RefundsApi;
        $this->_payloadHelper->setChargeId(1);
        $req = $this->_payloadHelper->getRefundPayload();
        $response = $refundsApi->refundsCreate($req);
        $this->assertTrue(true);
    }

    /**
     * Test case for refundsList.
     *
     * List refunds.
     */
    public function testRefundsList()
    {
        $this->assertTrue(true);
    }

    /**
     * Test case for refundsRetrieve.
     *
     * Retrieve a refund.
     */
    public function testRefundsRetrieve()
    {
        $this->assertTrue(true);
    }
}
