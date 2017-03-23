<?php
/**
 * RefundsApiTest
 * PHP version 5
 *
 * @category Class
 * @package  zipMoney
 * @author   Swagger Codegen team
 * @link     https://github.com/swagger-api/swagger-codegen
 */

/**
 * Merchant API
 *
 * ZipMoney Merchant API Initial build
 *
 * OpenAPI spec version: 2017-03-01
 * 
 * Generated by: https://github.com/swagger-api/swagger-codegen.git
 *
 */

/**
 * NOTE: This class is auto generated by the swagger code generator program.
 * https://github.com/swagger-api/swagger-codegen
 * Please update the test case below to test the endpoint.
 */

namespace zipMoney;


use \zipMoney\Api\RefundsApi;


/**
 * RefundsApiTest Class Doc Comment
 *
 * @category Class
 * @package  zipMoney
 * @author   Swagger Codegen team
 * @link     https://github.com/swagger-api/swagger-codegen
 */
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
     * @expectedExceptionMessage [402] Error connecting to the API (https://api.sandbox.zipmoney.com.au/merchant/v1/refunds)
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
