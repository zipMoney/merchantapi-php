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
     */
    public function testRefundsCreate(): void
    {
        $this->expectException(ApiException::class);

        $refundsApi = new RefundsApi();
        $this->_payloadHelper->setChargeId(1);
        $req = $this->_payloadHelper->getRefundPayload();
        $refundsApi->refundsCreate($req);
    }

    /**
     * Test case for refundsList.
     *
     * List refunds.
     */
    public function testRefundsList(): void
    {
        $this->assertTrue(true);
    }

    /**
     * Test case for refundsRetrieve.
     *
     * Retrieve a refund.
     */
    public function testRefundsRetrieve(): void
    {
        $this->assertTrue(true);
    }
}
