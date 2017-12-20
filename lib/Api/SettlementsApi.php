<?php
/**
 * SettlementsApi
 *
 * @category Class
 * @package  zipMoney
 * @author   zipMoney Payments Pty Ltd
 * @link     https://github.com/zipMoney/merchantapi-php
 */

namespace zipMoney\Api;

use \zipMoney\ApiClient;
use \zipMoney\ApiException;
use \zipMoney\Configuration;
use \zipMoney\ObjectSerializer;

class SettlementsApi
{
    /**
     * API Client
     *
     * @var \zipMoney\ApiClient instance of the ApiClient
     */
    protected $apiClient;

    /**
     * Constructor
     *
     * @param \zipMoney\ApiClient|null $apiClient The api client to use
     */
    public function __construct(\zipMoney\ApiClient $apiClient = null)
    {
        if ($apiClient === null) {
            $apiClient = new ApiClient();
        }
        $this->apiClient = $apiClient;
    }

    /**
     * Get API client
     *
     * @return \zipMoney\ApiClient get the API client
     */
    public function getApiClient()
    {
        return $this->apiClient;
    }

    /**
     * Set the API client
     *
     * @param \zipMoney\ApiClient $apiClient set the API client
     *
     * @return SettlementsApi
     */
    public function setApiClient(\zipMoney\ApiClient $apiClient)
    {
        $this->apiClient = $apiClient;
        return $this;
    }

    /**
     * Operation settlementsGet
     *
     * Retrieve a settlement
     *
     * @param string $id The settlement id (required)
     * @throws \zipMoney\ApiException on non-2xx response
     * @return \zipMoney\Model\Settlement
     */
    public function settlementsGet($id)
    {
        list($response) = $this->settlementsGetWithHttpInfo($id);
        return $response;
    }

    /**
     * Operation settlementsGetWithHttpInfo
     *
     * Retrieve a settlement
     *
     * @param string $id The settlement id (required)
     * @throws \zipMoney\ApiException on non-2xx response
     * @return array of \zipMoney\Model\Settlement, HTTP status code, HTTP response headers (array of strings)
     */
    public function settlementsGetWithHttpInfo($id)
    {
        // verify the required parameter 'id' is set
        if ($id === null) {
            throw new \InvalidArgumentException('Missing the required parameter $id when calling settlementsGet');
        }
        // parse inputs
        $resourcePath = "/settlements/{id}";
        $httpBody = '';
        $queryParams = array();
        $headerParams = array();
        $formParams = array();
        $_header_accept = $this->apiClient->selectHeaderAccept(array('application/javascript'));
        if (!is_null($_header_accept)) {
            $headerParams['Accept'] = $_header_accept;
        }
        $headerParams['Content-Type'] = $this->apiClient->selectHeaderContentType(array('application/javascript'));

        // path params
        if ($id !== null) {
            $resourcePath = str_replace(
                "{" . "id" . "}",
                $this->apiClient->getSerializer()->toPathValue($id),
                $resourcePath
            );
        }
        // default format to json
        $resourcePath = str_replace("{format}", "json", $resourcePath);

        
        // for model (json/xml)
        if (isset($_tempBody)) {
            $httpBody = $_tempBody; // $_tempBody is the method argument, if present
        } elseif (count($formParams) > 0) {
            $httpBody = $formParams; // for HTTP post (form)
        }
        // make the API Call
        try {
            list($response, $statusCode, $httpHeader) = $this->apiClient->callApi(
                $resourcePath,
                'GET',
                $queryParams,
                $httpBody,
                $headerParams,
                '\zipMoney\Model\Settlement',
                '/settlements/{id}'
            );

            return array($this->apiClient->getSerializer()->deserialize($response, '\zipMoney\Model\Settlement', $httpHeader), $statusCode, $httpHeader);
        } catch (ApiException $e) {
            switch ($e->getCode()) {
                case 200:
                    $data = $this->apiClient->getSerializer()->deserialize($e->getResponseBody(), '\zipMoney\Model\Settlement', $e->getResponseHeaders());
                    $e->setResponseObject($data);
                    break;
                case 400:
                    $data = $this->apiClient->getSerializer()->deserialize($e->getResponseBody(), '\zipMoney\Model\ErrorResponse', $e->getResponseHeaders());
                    $e->setResponseObject($data);
                    break;
                case 404:
                    $data = $this->apiClient->getSerializer()->deserialize($e->getResponseBody(), '\zipMoney\Model\ErrorResponse', $e->getResponseHeaders());
                    $e->setResponseObject($data);
                    break;
            }

            throw $e;
        }
    }

    /**
     * Operation settlementsList
     *
     * List settlements
     *
     * @throws \zipMoney\ApiException on non-2xx response
     * @return void
     */
    public function settlementsList()
    {
        list($response) = $this->settlementsListWithHttpInfo();
        return $response;
    }

    /**
     * Operation settlementsListWithHttpInfo
     *
     * List settlements
     *
     * @throws \zipMoney\ApiException on non-2xx response
     * @return array of null, HTTP status code, HTTP response headers (array of strings)
     */
    public function settlementsListWithHttpInfo()
    {
        // parse inputs
        $resourcePath = "/settlements";
        $httpBody = '';
        $queryParams = array();
        $headerParams = array();
        $formParams = array();
        $_header_accept = $this->apiClient->selectHeaderAccept(array('application/javascript'));
        if (!is_null($_header_accept)) {
            $headerParams['Accept'] = $_header_accept;
        }
        $headerParams['Content-Type'] = $this->apiClient->selectHeaderContentType(array('application/javascript'));

        // default format to json
        $resourcePath = str_replace("{format}", "json", $resourcePath);

        
        // for model (json/xml)
        if (isset($_tempBody)) {
            $httpBody = $_tempBody; // $_tempBody is the method argument, if present
        } elseif (count($formParams) > 0) {
            $httpBody = $formParams; // for HTTP post (form)
        }
        // make the API Call
        try {
            list($response, $statusCode, $httpHeader) = $this->apiClient->callApi(
                $resourcePath,
                'GET',
                $queryParams,
                $httpBody,
                $headerParams,
                null,
                '/settlements'
            );

            return array(null, $statusCode, $httpHeader);
        } catch (ApiException $e) {
            switch ($e->getCode()) {
            }

            throw $e;
        }
    }
}
