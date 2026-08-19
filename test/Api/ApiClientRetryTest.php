<?php

declare(strict_types=1);

/**
 * ApiClientRetryTest.
 *
 * @category Class
 *
 * @see     https://github.com/zipMoney/merchantapi-php
 */

namespace zipMoney;

class ApiClientRetryTest extends Setup
{
    /** @var resource|null */
    private $server;

    private string $hitFile = '';

    private int $port = 0;

    protected function tearDown(): void
    {
        if (is_resource($this->server)) {
            proc_terminate($this->server);
            proc_close($this->server);
        }

        if ($this->hitFile !== '' && is_file($this->hitFile)) {
            unlink($this->hitFile);
        }

        parent::tearDown();
    }

    /**
     * A 5xx is retried, and only while an Idempotency-Key makes replaying the
     * request safe. Zip returning 503 for a moment used to surface as an
     * immediate failure; the merchant saw a declined checkout for what was a
     * transient upstream blip.
     *
     * Asserts on the number of requests the server actually received, because
     * that is the behaviour merchants feel — not on the shape of the loop.
     */
    public function testFiveHundredIsRetriedWhenIdempotencyKeyIsPresent(): void
    {
        $this->startAlwaysFailingServer();

        $config = Configuration::getDefaultConfiguration();
        $config->setHost('http://127.0.0.1:' . $this->port . '/merchant');
        $config->setApiKey('Authorization', 'Bearer test');
        // Keep the suite quick: the default back-off would add 1+2+3 seconds.
        $config->setCurlNumRetries(2);
        $config->setRetryInterval(0);

        $client = new ApiClient($config);

        try {
            $client->callApi('/checkouts', 'POST', [], ['x' => 1], ['Idempotency-Key' => 'test-key'], null, '/checkouts');
            self::fail('A persistent 500 must end in an ApiException.');
        } catch (ApiException $apiException) {
            self::assertSame(500, $apiException->getCode());
        }

        self::assertSame(3, $this->countHits(), 'Expected the first attempt plus two retries.');
    }

    /**
     * Without an Idempotency-Key the request cannot be replayed safely — a
     * retried charge could take the shopper's money twice — so one attempt is
     * all it gets, however the server answered.
     */
    public function testFiveHundredIsNotRetriedWithoutIdempotencyKey(): void
    {
        $this->startAlwaysFailingServer();

        $config = Configuration::getDefaultConfiguration();
        $config->setHost('http://127.0.0.1:' . $this->port . '/merchant');
        $config->setApiKey('Authorization', 'Bearer test');
        $config->setCurlNumRetries(2);
        $config->setRetryInterval(0);

        $client = new ApiClient($config);

        try {
            $client->callApi('/checkouts', 'POST', [], ['x' => 1], [], null, '/checkouts');
            self::fail('A persistent 500 must end in an ApiException.');
        } catch (ApiException $apiException) {
            self::assertSame(500, $apiException->getCode());
        }

        self::assertSame(1, $this->countHits(), 'Expected no retry without an Idempotency-Key.');
    }

    private function startAlwaysFailingServer(): void
    {
        $this->hitFile = (string) tempnam(sys_get_temp_dir(), 'zip-hits-');
        $router = (string) tempnam(sys_get_temp_dir(), 'zip-router-') . '.php';
        file_put_contents($router, '<?php file_put_contents(' . var_export($this->hitFile, true)
            . ', "1", FILE_APPEND); http_response_code(500); header("Content-Type: application/json");'
            . ' echo \'{"error":{"message":"upstream is having a moment"}}\';');

        $this->port = 8000 + (getmypid() % 1000);
        $descriptors = [1 => ['file', '/dev/null', 'w'], 2 => ['file', '/dev/null', 'w']];
        $this->server = proc_open(
            sprintf('exec php -S 127.0.0.1:%d %s', $this->port, escapeshellarg($router)),
            $descriptors,
            $pipes
        );

        if (!is_resource($this->server)) {
            self::markTestSkipped('Could not start the built-in PHP server.');
        }

        // Wait for the port to accept connections rather than guessing at a sleep.
        for ($i = 0; $i < 50; ++$i) {
            $socket = @fsockopen('127.0.0.1', $this->port, $errno, $errstr, 0.1);
            if (is_resource($socket)) {
                fclose($socket);

                return;
            }

            usleep(100000);
        }

        self::markTestSkipped('The built-in PHP server did not come up on port ' . $this->port . '.');
    }

    private function countHits(): int
    {
        return is_file($this->hitFile) ? strlen((string) file_get_contents($this->hitFile)) : 0;
    }
}
