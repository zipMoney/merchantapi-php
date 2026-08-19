<?php

declare(strict_types=1);

/**
 * ApiClient.
 *
 * @category Class
 * @package  zipMoney
 * @author   zipMoney Payments Pty Ltd
 * @link     https://github.com/zipMoney/merchantapi-php
 */

namespace zipMoney;

class ApiClient
{
    public static $PATCH = 'PATCH';

    public static $POST = 'POST';

    public static $GET = 'GET';

    public static $HEAD = 'HEAD';

    public static $OPTIONS = 'OPTIONS';

    public static $PUT = 'PUT';

    public static $DELETE = 'DELETE';

    /**
     * Configuration.
     */
    protected ?Configuration $config;

    /**
     * Object Serializer.
     */
    protected ObjectSerializer $serializer;

    /**
     * Constructor of the class.
     *
     * @param null|Configuration $config config for this ApiClient
     */
    public function __construct(?Configuration $config = null)
    {
        if (!$config instanceof Configuration) {
            $config = Configuration::getDefaultConfiguration();
        }

        $this->config = $config;

        $this->config->setDefaultHeaders();

        $this->serializer = new ObjectSerializer();
    }

    /**
     * Get the config.
     *
     * @return Configuration
     */
    public function getConfig(): ?Configuration
    {
        return $this->config;
    }

    /**
     * Get the serializer.
     */
    public function getSerializer(): ObjectSerializer
    {
        return $this->serializer;
    }

    /**
     * Get API key (with prefix if set).
     *
     * @param string $apiKeyIdentifier name of apikey
     *
     * @return string API key with the prefix
     */
    public function getApiKeyWithPrefix($apiKeyIdentifier): ?string
    {
        $prefix = $this->config->getApiKeyPrefix($apiKeyIdentifier);
        $apiKey = $this->config->getApiKey($apiKeyIdentifier);

        if (!isset($apiKey)) {
            return null;
        }

        return isset($prefix) ? $prefix . ' ' . $apiKey : $apiKey;
    }

    /**
     * Make the HTTP call (Sync).
     *
     * @param string $resourcePath path to method endpoint
     * @param string $method       method to call
     * @param array  $queryParams  parameters to be place in query URL
     * @param array  $postData     parameters to be placed in POST body
     * @param array  $headerParams parameters to be place in request header
     * @param string $responseType expected response type of the endpoint
     * @param string $endpointPath path to method endpoint before expanding parameters
     *
     * @throws ApiException on a non 2xx response
     *
     * @return mixed[]
     */
    public function callApi(string $resourcePath, string $method, $queryParams, $postData, $headerParams, $responseType = null, $endpointPath = null): array
    {
        $headers = [];

        // construct the http header
        $headerParams = array_merge(
            (array) $this->config->getDefaultHeaders(),
            (array) $headerParams
        );

        foreach ($headerParams as $key => $val) {
            $headers[] = "{$key}: {$val}";
        }

        // form data
        if ($postData && in_array('Content-Type: application/x-www-form-urlencoded', $headers, true)) {
            $postData = http_build_query($postData);
        } elseif ((is_object($postData) || is_array($postData)) && !in_array('Content-Type: multipart/form-data', $headers, true)) { // json model
            $postData = json_encode(ObjectSerializer::sanitizeForSerialization($postData));
        }

        $url = $this->config->getHost() . $resourcePath;

        $curl = curl_init();
        // set timeout, if needed
        if ($this->config->getCurlTimeout() !== 0) {
            curl_setopt($curl, CURLOPT_TIMEOUT, $this->config->getCurlTimeout());
        }
        // set connect timeout, if needed
        if ($this->config->getCurlConnectTimeout() != 0) {
            curl_setopt($curl, CURLOPT_CONNECTTIMEOUT, $this->config->getCurlConnectTimeout());
        }

        // return the result on success, rather than just true
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);

        // disable SSL verification, if needed
        if ($this->config->getSSLVerification() === false) {
            curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);
            curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);
        }

        if ($this->config->getCurlProxyHost()) {
            curl_setopt($curl, CURLOPT_PROXY, $this->config->getCurlProxyHost());
        }

        if ($this->config->getCurlProxyPort()) {
            curl_setopt($curl, CURLOPT_PROXYPORT, $this->config->getCurlProxyPort());
        }

        if ($this->config->getCurlProxyType()) {
            curl_setopt($curl, CURLOPT_PROXYTYPE, $this->config->getCurlProxyType());
        }

        if ($this->config->getCurlProxyUser()) {
            curl_setopt($curl, CURLOPT_PROXYUSERPWD, $this->config->getCurlProxyUser() . ':' . $this->config->getCurlProxyPassword());
        }

        if (!empty($queryParams)) {
            $url = ($url . '?' . http_build_query($queryParams));
        }

        if ($method === self::$POST) {
            curl_setopt($curl, CURLOPT_POST, true);
            curl_setopt($curl, CURLOPT_POSTFIELDS, $postData);
        } elseif ($method === self::$HEAD) {
            curl_setopt($curl, CURLOPT_NOBODY, true);
        } elseif ($method === self::$OPTIONS) {
            curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'OPTIONS');
            curl_setopt($curl, CURLOPT_POSTFIELDS, $postData);
        } elseif ($method === self::$PATCH) {
            curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'PATCH');
            curl_setopt($curl, CURLOPT_POSTFIELDS, $postData);
        } elseif ($method === self::$PUT) {
            curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'PUT');
            curl_setopt($curl, CURLOPT_POSTFIELDS, $postData);
        } elseif ($method === self::$DELETE) {
            curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'DELETE');
            curl_setopt($curl, CURLOPT_POSTFIELDS, $postData);
        } elseif ($method !== self::$GET) {
            throw new ApiException('Method ' . $method . ' is not recognized.');
        }
        curl_setopt($curl, CURLOPT_URL, $url);

        // Set user agent
        curl_setopt($curl, CURLOPT_USERAGENT, $this->config->getUserAgent());

        // disable debugging for curl
        curl_setopt($curl, CURLOPT_VERBOSE, 0);

        // obtain the HTTP response headers
        curl_setopt($curl, CURLOPT_HEADER, 1);

        $num_retries = $this->config->getCurlNumRetries() ?: 0;
        $count = 0;

        do {
            if ($count > 0 && $this->config->getRetryInterval() > 0) {
                // Linear back-off: a server that just answered 503 is unlikely to be
                // ready again in the same second, and three immediate retries only add
                // load to something already struggling.
                sleep($this->config->getRetryInterval() * $count);
            }

            // Make the request
            $response = curl_exec($curl);
            $http_header_size = curl_getinfo($curl, CURLINFO_HEADER_SIZE);

            // curl_exec() returns false on a transport-level failure (TLS, DNS,
            // connection). There is no payload to parse, so guard substr() — under
            // declare(strict_types=1) substr(false, ...) is a fatal TypeError. The
            // http_code === 0 handler below turns this into a proper ApiException.
            if ($response === false) {
                $http_header = [];
                $http_body = '';
            } else {
                $http_header = $this->httpParseHeaders(substr($response, 0, $http_header_size));
                $http_body = substr($response, $http_header_size);
            }

            $response_info = curl_getinfo($curl);
            $count++;
            $msg = curl_error($curl);
        } while (($count <= $num_retries) &&
                  (in_array($response_info['http_code'], [0, 500, 502, 503, 504], true) && ($msg === '' || $msg === '0')) &&
                  !empty($headerParams['Idempotency-Key']));

        // Handle the response
        if ($response_info['http_code'] === 0) {
            $curl_error_message = curl_error($curl);

            // curl_exec can sometimes fail but still return a blank message from curl_error().
            if ($curl_error_message !== '' && $curl_error_message !== '0') {
                $error_message = "API call to {$url} failed: {$curl_error_message}";
            } else {
                $error_message = "API call to {$url} failed, but for an unknown reason. " .
                    'This could happen if you are disconnected from the network.';
            }

            $exception = new ApiException($error_message, 0, null, null);
            $exception->setResponseObject($response_info);
            throw $exception;
        }
        if ($response_info['http_code'] >= 200 && $response_info['http_code'] <= 299) {
            // return raw body if response is a file
            if ($responseType === '\SplFileObject' || $responseType === 'string') {
                return [$http_body, $response_info['http_code'], $http_header];
            }

            $data = json_decode($http_body);
            if (json_last_error() > 0) { // if response is a string
                $data = $http_body;
            }
        } else {
            $data = json_decode($http_body);
            if (json_last_error() > 0) { // if response is a string
                $data = $http_body;
            }

            throw new ApiException(
                $this->generateErrorMessage(json_decode($http_body)),
                $response_info['http_code'],
                $http_header,
                $data
            );
        }

        return [$data, $response_info['http_code'], $http_header];
    }

    /**
     * Return the header 'Accept' based on an array of Accept provided.
     *
     * @param string[] $accept Array of header
     *
     * @return string Accept (e.g. application/json)
     */
    public function selectHeaderAccept(array $accept): ?string
    {
        if ($accept === [] || count($accept) === 1 && $accept[0] === '') {
            return null;
        }
        if (preg_grep('/application\\/json/i', $accept)) {
            return 'application/json';
        }

        return implode(',', $accept);
    }

    /**
     * Return the content type based on an array of content-type provided.
     *
     * @param string[] $content_type Array fo content-type
     *
     * @return string Content-Type (e.g. application/json)
     */
    public function selectHeaderContentType(array $content_type): string
    {
        if ($content_type === [] || count($content_type) === 1 && $content_type[0] === '') {
            return 'application/json';
        }
        if (preg_grep('/application\\/json/i', $content_type)) {
            return 'application/json';
        }

        return implode(',', $content_type);
    }

    /**
     * Return an array of HTTP response headers.
     *
     * @param string $raw_headers A string of raw HTTP response headers
     *
     * @return string[] Array of HTTP response heaers
     */
    protected function httpParseHeaders($raw_headers): array
    {
        // ref/credit: http://php.net/manual/en/function.http-parse-headers.php#112986
        $headers = [];
        $key = '';

        foreach (explode("\n", $raw_headers) as $h) {
            $h = explode(':', $h, 2);

            if (isset($h[1])) {
                if (!isset($headers[$h[0]])) {
                    $headers[$h[0]] = trim($h[1]);
                } elseif (is_array($headers[$h[0]])) {
                    $headers[$h[0]] = array_merge($headers[$h[0]], [trim($h[1])]);
                } else {
                    $headers[$h[0]] = [$headers[$h[0]], trim($h[1])];
                }

                $key = $h[0];
            } else {
                if (str_starts_with($h[0], "\t")) {
                    $headers[$key] .= "\r\n\t" . trim($h[0]);
                } elseif ($key === '' || $key === '0') {
                    $headers[0] = trim($h[0]);
                }
                trim($h[0]);
            }
        }

        return $headers;
    }

    protected function generateErrorMessage($response): string
    {
        $errorMessage = 'An error occurred while processing payment';

        if (isset($response->error)) {
            if (isset($response->error->message)) {
                $errorMessage = (string) $response->error->message;
            }

            if (isset($response->error->details)) {
                $errorMessage = '';

                foreach ($response->error->details as $detail) {
                    $errorMessage .= $detail->message;
                }
            }
        }

        return $errorMessage;
    }
}
