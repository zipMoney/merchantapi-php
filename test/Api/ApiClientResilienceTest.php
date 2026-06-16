<?php

declare(strict_types=1);

/**
 * ApiClientResilienceTest.
 *
 * @category Class
 *
 * @see     https://github.com/zipMoney/merchantapi-php
 */

namespace zipMoney;

use zipMoney\Api\CheckoutsApi;

class ApiClientResilienceTest extends Setup
{
    /**
     * A transport-level cURL failure must surface as a catchable ApiException,
     * not a fatal TypeError. Here the host is unreachable so curl_exec() returns
     * false; under declare(strict_types=1) substr(false, ...) would otherwise
     * throw TypeError instead of letting the http_code === 0 handler run.
     */
    public function testTransportFailureThrowsApiExceptionNotTypeError(): void
    {
        // Unreachable address — connection is refused immediately, curl_exec() === false.
        Configuration::getDefaultConfiguration()->setHost('https://127.0.0.1:1/merchant');

        $this->expectException(ApiException::class);

        $checkoutsApi = new CheckoutsApi();
        $req = $this->_payloadHelper->getCheckoutPayload();
        $checkoutsApi->checkoutsCreate($req);
    }
}
