<?php

declare(strict_types=1);

/**
 * CheckoutsApi.
 *
 * @category Class
 * @package  zipMoney
 * @author   zipMoney Payments Pty Ltd
 * @link     https://github.com/zipMoney/merchantapi-php
 */

namespace zipMoney\Api;

use zipMoney\ApiClient;
use zipMoney\ApiException;
use zipMoney\Model\Checkout;
use zipMoney\Model\CreateCheckoutRequest;

class CheckoutsApi
{
    /**
     * API Client.
     *
     * @var ApiClient instance of the ApiClient
     */
    protected ?ApiClient $apiClient;

    /**
     * Constructor.
     *
     * @param null|ApiClient $apiClient The api client to use
     */
    public function __construct(?ApiClient $apiClient = null)
    {
        if (!$apiClient instanceof ApiClient) {
            $apiClient = new ApiClient();
        }
        $this->apiClient = $apiClient;
    }

    /**
     * Get API client.
     *
     * @return ApiClient get the API client
     */
    public function getApiClient(): ?ApiClient
    {
        return $this->apiClient;
    }

    /**
     * Set the API client.
     *
     * @param ApiClient $apiClient set the API client
     */
    public function setApiClient(ApiClient $apiClient): static
    {
        $this->apiClient = $apiClient;

        return $this;
    }

    /**
     * Operation checkoutsCreate.
     *
     * Create a checkout
     *
     * @param CreateCheckoutRequest $body (optional)
     *
     * @throws ApiException on non-2xx response
     *
     * @return Checkout
     */
    public function checkoutsCreate($body = null)
    {
        [$response] = $this->checkoutsCreateWithHttpInfo($body);

        return $response;
    }

    /**
     * Operation checkoutsCreateWithHttpInfo.
     *
     * Create a checkout
     *
     * @param CreateCheckoutRequest $body (optional)
     *
     * @throws ApiException on non-2xx response
     *
     * @return array of \zipMoney\Model\Checkout, HTTP status code, HTTP response headers (array of strings)
     */
    public function checkoutsCreateWithHttpInfo($body = null)
    {
        // parse inputs
        $resourcePath = '/checkouts';
        $httpBody = '';
        $queryParams = [];
        $headerParams = [];
        $formParams = [];
        $_header_accept = $this->apiClient->selectHeaderAccept(['application/json']);
        if (!is_null($_header_accept)) {
            $headerParams['Accept'] = $_header_accept;
        }
        $headerParams['Content-Type'] = $this->apiClient->selectHeaderContentType(['application/json']);

        // default format to json
        $resourcePath = str_replace('{format}', 'json', $resourcePath);

        // body params
        $_tempBody = null;
        if (isset($body)) {
            $_tempBody = $body;
        }

        // for model (json/xml)
        if (isset($_tempBody)) {
            $httpBody = $_tempBody; // $_tempBody is the method argument, if present
        } elseif ($formParams !== []) {
            $httpBody = $formParams; // for HTTP post (form)
        }
        // this endpoint requires API key authentication
        $apiKey = $this->apiClient->getApiKeyWithPrefix('Authorization');
        if (strlen($apiKey) !== 0) {
            $headerParams['Authorization'] = $apiKey;
        }

        // make the API Call
        try {
            [$response, $statusCode, $httpHeader] = $this->apiClient->callApi(
                $resourcePath,
                'POST',
                $queryParams,
                $httpBody,
                $headerParams,
                '\zipMoney\Model\Checkout',
                '/checkouts'
            );

            return [$this->apiClient->getSerializer()->deserialize($response, '\zipMoney\Model\Checkout', $httpHeader), $statusCode, $httpHeader];
        } catch (ApiException $e) {
            switch ($e->getCode()) {
                case 201:
                    $data = $this->apiClient->getSerializer()->deserialize($e->getResponseBody(), '\zipMoney\Model\Checkout', $e->getResponseHeaders());
                    $e->setResponseObject($data);
                    break;
                case 400:
                case 401:
                case 402:
                case 403:
                case 409:
                    $data = $this->apiClient->getSerializer()->deserialize($e->getResponseBody(), '\zipMoney\Model\ErrorResponse', $e->getResponseHeaders());
                    $e->setResponseObject($data);
                    break;
            }

            throw $e;
        }
    }

    /**
     * Operation checkoutsGet.
     *
     * Retrieve a checkout
     *
     * @param string $id (required)
     *
     * @throws ApiException on non-2xx response
     *
     * @return Checkout
     */
    public function checkoutsGet($id)
    {
        [$response] = $this->checkoutsGetWithHttpInfo($id);

        return $response;
    }

    /**
     * Operation checkoutsGetWithHttpInfo.
     *
     * Retrieve a checkout
     *
     * @param string $id (required)
     *
     * @throws ApiException on non-2xx response
     *
     * @return array of \zipMoney\Model\Checkout, HTTP status code, HTTP response headers (array of strings)
     */
    public function checkoutsGetWithHttpInfo($id)
    {
        // verify the required parameter 'id' is set
        if ($id === null) {
            throw new \InvalidArgumentException('Missing the required parameter $id when calling checkoutsGet');
        }
        // parse inputs
        $resourcePath = '/checkouts/{id}';
        $httpBody = '';
        $queryParams = [];
        $headerParams = [];
        $formParams = [];
        $_header_accept = $this->apiClient->selectHeaderAccept(['application/json']);
        if (!is_null($_header_accept)) {
            $headerParams['Accept'] = $_header_accept;
        }
        $headerParams['Content-Type'] = $this->apiClient->selectHeaderContentType(['application/json']);

        // path params
        if ($id !== null) {
            $resourcePath = str_replace(
                '{id}',
                $this->apiClient->getSerializer()->toPathValue($id),
                $resourcePath
            );
        }
        // default format to json
        $resourcePath = str_replace('{format}', 'json', $resourcePath);

        // for model (json/xml)
        if (isset($_tempBody)) {
            $httpBody = $_tempBody; // $_tempBody is the method argument, if present
        } elseif ($formParams !== []) {
            $httpBody = $formParams; // for HTTP post (form)
        }
        // this endpoint requires API key authentication
        $apiKey = $this->apiClient->getApiKeyWithPrefix('Authorization');
        if (strlen($apiKey) !== 0) {
            $headerParams['Authorization'] = $apiKey;
        }

        // make the API Call
        try {
            [$response, $statusCode, $httpHeader] = $this->apiClient->callApi(
                $resourcePath,
                'GET',
                $queryParams,
                $httpBody,
                $headerParams,
                '\zipMoney\Model\Checkout',
                '/checkouts/{id}'
            );

            return [$this->apiClient->getSerializer()->deserialize($response, '\zipMoney\Model\Checkout', $httpHeader), $statusCode, $httpHeader];
        } catch (ApiException $e) {
            switch ($e->getCode()) {
                case 200:
                    $data = $this->apiClient->getSerializer()->deserialize($e->getResponseBody(), '\zipMoney\Model\Checkout', $e->getResponseHeaders());
                    $e->setResponseObject($data);
                    break;
                case 401:
                case 403:
                case 404:
                case 409:
                    $data = $this->apiClient->getSerializer()->deserialize($e->getResponseBody(), '\zipMoney\Model\ErrorResponse', $e->getResponseHeaders());
                    $e->setResponseObject($data);
                    break;
            }

            throw $e;
        }
    }
}
