<?php
/**
 * RefundsApiTest
 * PHP version 5
 *
 * @category Class
 * @package  zipMoney
 * @author   zipMoney Payments Pty Ltd
 * @link     https://github.com/zipMoney/merchantapi-php
 */

namespace zipMoney;

use \zipMoney\Api\RefundsApi;

class RefundsApiTest extends Setup
{

    /**
     * Setup before running any test cases
     */
    public static function setUpBeforeClass()
    {
    }


    /**
     * Clean up after running each test case
     */
    public function tearDown()
    {
    }

    /**
     * Clean up after running all test cases
     */
    public static function tearDownAfterClass()
    {
    }

    /**
     * Test case for refundsCreate
     *
     * Create a refund.
     * @expectedException  \zipMoney\ApiException
     * @expectedExceptionMessage An error occurred while processing payment
     */
    public function testRefundsCreate()
    {
        $refundsApi = new RefundsApi;
        $this->_payloadHelper->setChargeId(1);
        $req = $this->_payloadHelper->getRefundPayload();
        $response = $refundsApi->refundsCreate($req);
    }

    /**
     * Test case for refundsList
     *
     * List refunds.
     *
     */
    public function testRefundsList()
    {
    }

    /**
     * Test case for refundsRetrieve
     *
     * Retrieve a refund.
     *
     */
    public function testRefundsRetrieve()
    {
    }
}
