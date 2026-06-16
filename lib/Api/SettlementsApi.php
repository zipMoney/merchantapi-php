<?php

declare(strict_types=1);

/**
 * SettlementsApi.
 *
 * @category Class
 * @package  zipMoney
 * @author   zipMoney Payments Pty Ltd
 * @link     https://github.com/zipMoney/merchantapi-php
 */

namespace zipMoney\Api;

use zipMoney\ApiClient;
use zipMoney\ApiException;
use zipMoney\Model\Settlement;

class SettlementsApi
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
     * Operation settlementsGet.
     *
     * Retrieve a settlement
     *
     * @param string $id The settlement id (required)
     *
     * @throws ApiException on non-2xx response
     *
     * @return Settlement
     */
    public function settlementsGet($id)
    {
        [$response] = $this->settlementsGetWithHttpInfo($id);

        return $response;
    }

    /**
     * Operation settlementsGetWithHttpInfo.
     *
     * Retrieve a settlement
     *
     * @param string $id The settlement id (required)
     *
     * @throws ApiException on non-2xx response
     *
     * @return array of \zipMoney\Model\Settlement, HTTP status code, HTTP response headers (array of strings)
     */
    public function settlementsGetWithHttpInfo($id)
    {
        // verify the required parameter 'id' is set
        if ($id === null) {
            throw new \InvalidArgumentException('Missing the required parameter $id when calling settlementsGet');
        }
        // parse inputs
        $resourcePath = '/settlements/{id}';
        $httpBody = '';
        $queryParams = [];
        $headerParams = [];
        $formParams = [];
        $_header_accept = $this->apiClient->selectHeaderAccept(['application/javascript']);
        if (!is_null($_header_accept)) {
            $headerParams['Accept'] = $_header_accept;
        }
        $headerParams['Content-Type'] = $this->apiClient->selectHeaderContentType(['application/javascript']);

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

        // make the API Call
        try {
            [$response, $statusCode, $httpHeader] = $this->apiClient->callApi(
                $resourcePath,
                'GET',
                $queryParams,
                $httpBody,
                $headerParams,
                '\zipMoney\Model\Settlement',
                '/settlements/{id}'
            );

            return [$this->apiClient->getSerializer()->deserialize($response, '\zipMoney\Model\Settlement', $httpHeader), $statusCode, $httpHeader];
        } catch (ApiException $e) {
            switch ($e->getCode()) {
                case 200:
                    $data = $this->apiClient->getSerializer()->deserialize($e->getResponseBody(), '\zipMoney\Model\Settlement', $e->getResponseHeaders());
                    $e->setResponseObject($data);
                    break;
                case 400:
                case 404:
                    $data = $this->apiClient->getSerializer()->deserialize($e->getResponseBody(), '\zipMoney\Model\ErrorResponse', $e->getResponseHeaders());
                    $e->setResponseObject($data);
                    break;
            }

            throw $e;
        }
    }

    /**
     * Operation settlementsList.
     *
     * List settlements
     *
     * @throws ApiException on non-2xx response
     */
    public function settlementsList()
    {
        [$response] = $this->settlementsListWithHttpInfo();

        return $response;
    }

    /**
     * Operation settlementsListWithHttpInfo.
     *
     * List settlements
     *
     * @throws ApiException on non-2xx response
     *
     * @return array of null, HTTP status code, HTTP response headers (array of strings)
     */
    public function settlementsListWithHttpInfo()
    {
        // parse inputs
        $resourcePath = '/settlements';
        $httpBody = '';
        $queryParams = [];
        $headerParams = [];
        $formParams = [];
        $_header_accept = $this->apiClient->selectHeaderAccept(['application/javascript']);
        if (!is_null($_header_accept)) {
            $headerParams['Accept'] = $_header_accept;
        }
        $headerParams['Content-Type'] = $this->apiClient->selectHeaderContentType(['application/javascript']);

        // default format to json
        $resourcePath = str_replace('{format}', 'json', $resourcePath);

        // for model (json/xml)
        if (isset($_tempBody)) {
            $httpBody = $_tempBody; // $_tempBody is the method argument, if present
        } elseif ($formParams !== []) {
            $httpBody = $formParams; // for HTTP post (form)
        }

        // make the API Call
        try {
            [$response, $statusCode, $httpHeader] = $this->apiClient->callApi(
                $resourcePath,
                'GET',
                $queryParams,
                $httpBody,
                $headerParams,
                null,
                '/settlements'
            );

            return [null, $statusCode, $httpHeader];
        } catch (ApiException $e) {
            switch ($e->getCode()) {
            }

            throw $e;
        }
    }
}
