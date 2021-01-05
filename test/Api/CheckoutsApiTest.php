<?php
/**
 * CheckoutsApiTest
 *
 * @category Class
 * @package  zipMoney
 * @author   zipMoney Payments Pty Ltd
 * @link     https://github.com/zipMoney/merchantapi-php
 */

namespace zipMoney;

use \zipMoney\Api\CheckoutsApi;

class CheckoutsApiTest extends Setup
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
     * Test case for checkoutsCreate
     *
     * Create a checkout.
     *
     */
    public function testCheckoutsCreate()
    {
        try {
            $checkoutsApi = new CheckoutsApi;
            $req =  $this->_payloadHelper->getCheckoutPayload();
            $checkout = $checkoutsApi->checkoutsCreate($req);

            $this->assertNotNull($checkout->getId());
            $this->assertNotNull($checkout->getUri());
        } catch (ApiException $e) {
            $this->assertSame('An error occurred while processing payment', $e->getMessage());
        }
    }

    /**
     * Test case for checkoutsGet
     *
     * Retrieve a checkout.
     *
     */
    public function testCheckoutsGet()
    {
    }
}
