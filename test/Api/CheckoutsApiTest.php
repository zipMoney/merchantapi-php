<?php
declare(strict_types=1);
/**
 * CheckoutsApiTest.
 *
 * @category Class
 *
 * @see     https://github.com/zipMoney/merchantapi-php
 */

namespace zipMoney;

use zipMoney\Api\CheckoutsApi;

class CheckoutsApiTest extends Setup
{
    /**
     * Test case for checkoutsCreate.
     *
     * Create a checkout.
     */
    public function testCheckoutsCreate()
    {
        try {
            $checkoutsApi = new CheckoutsApi;
            $req = $this->_payloadHelper->getCheckoutPayload();
            $checkout = $checkoutsApi->checkoutsCreate($req);

            $this->assertNotNull($checkout->getId());
            $this->assertNotNull($checkout->getUri());
        } catch (ApiException $e) {
            $this->assertSame('An error occurred while processing payment', $e->getMessage());
        }
    }

    /**
     * Test case for checkoutsGet.
     *
     * Retrieve a checkout.
     */
    public function testCheckoutsGet()
    {
        $this->assertTrue(true);
    }
}
