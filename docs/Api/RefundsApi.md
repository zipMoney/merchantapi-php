# zipMoney\RefundsApi

All URIs are relative to *https://api.zipmoney.com.au/merchant/v1*

Method | HTTP request | Description
------------- | ------------- | -------------
[**refundsCreate**](RefundsApi.md#refundsCreate) | **POST** /refunds | Create a refund
[**refundsList**](RefundsApi.md#refundsList) | **GET** /refunds | List refunds
[**refundsRetrieve**](RefundsApi.md#refundsRetrieve) | **GET** /refunds/{id} | Retrieve a refund


# **refundsCreate**
> \zipMoney\Model\Refund refundsCreate($body, $idempotency_key)

Create a refund

Creates a refund for a previously authorised or captured charge. See #model:xWJer4QQyRumRi9LD for more information.  This endpoint will return 201 or otherwise 402 if unable to perform the refund.   | Error code | Description | |------------------------------------|--------------------------------------------------------------------------------------------------| | account_inoperative | The account is in arrears or closed and cannot be charged | | amount_invalid | The refund amount is greater than the remaining captured total | | invalid_state | 1. The charge is already fully refunded |

### Example
```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');

// Configure API key authorization: Authorization
zipMoney\Configuration::getDefaultConfiguration()->setApiKey('Authorization', 'YOUR_API_KEY');
// Uncomment below to setup prefix (e.g. Bearer) for API key, if needed
// zipMoney\Configuration::getDefaultConfiguration()->setApiKeyPrefix('Authorization', 'Bearer');

$api_instance = new zipMoney\Api\RefundsApi();
$body = new \zipMoney\Model\CreateRefundRequest(); // \zipMoney\Model\CreateRefundRequest | 
$idempotency_key = "idempotency_key_example"; // string | The unique idempotency key.

try {
    $result = $api_instance->refundsCreate($body, $idempotency_key);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling RefundsApi->refundsCreate: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **body** | [**\zipMoney\Model\CreateRefundRequest**](../Model/\zipMoney\Model\CreateRefundRequest.md)|  | [optional]
 **idempotency_key** | **string**| The unique idempotency key. | [optional]

### Return type

[**\zipMoney\Model\Refund**](../Model/Refund.md)

### Authorization

[Authorization](../../README.md#Authorization)

### HTTP request headers

 - **Content-Type**: application/json
 - **Accept**: application/javascript

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to Model list]](../../README.md#documentation-for-models) [[Back to README]](../../README.md)

# **refundsList**
> \zipMoney\Model\InlineResponse200[] refundsList($charge_id, $skip, $limit)

List refunds

List all refunds

### Example
```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');

// Configure API key authorization: Authorization
zipMoney\Configuration::getDefaultConfiguration()->setApiKey('Authorization', 'YOUR_API_KEY');
// Uncomment below to setup prefix (e.g. Bearer) for API key, if needed
// zipMoney\Configuration::getDefaultConfiguration()->setApiKeyPrefix('Authorization', 'Bearer');

$api_instance = new zipMoney\Api\RefundsApi();
$charge_id = "charge_id_example"; // string | 
$skip = 0; // int | Number of items to skip when paging
$limit = 100; // int | Number of items to retrieve when paging

try {
    $result = $api_instance->refundsList($charge_id, $skip, $limit);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling RefundsApi->refundsList: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **charge_id** | **string**|  | [optional]
 **skip** | **int**| Number of items to skip when paging | [optional] [default to 0]
 **limit** | **int**| Number of items to retrieve when paging | [optional] [default to 100]

### Return type

[**\zipMoney\Model\InlineResponse200[]**](../Model/InlineResponse200.md)

### Authorization

[Authorization](../../README.md#Authorization)

### HTTP request headers

 - **Content-Type**: application/javascript
 - **Accept**: application/javascript

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to Model list]](../../README.md#documentation-for-models) [[Back to README]](../../README.md)

# **refundsRetrieve**
> \zipMoney\Model\Refund refundsRetrieve($id)

Retrieve a refund

Retrieves details of a specific refund

### Example
```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');

// Configure API key authorization: Authorization
zipMoney\Configuration::getDefaultConfiguration()->setApiKey('Authorization', 'YOUR_API_KEY');
// Uncomment below to setup prefix (e.g. Bearer) for API key, if needed
// zipMoney\Configuration::getDefaultConfiguration()->setApiKeyPrefix('Authorization', 'Bearer');

$api_instance = new zipMoney\Api\RefundsApi();
$id = "id_example"; // string | The id of the refund

try {
    $result = $api_instance->refundsRetrieve($id);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling RefundsApi->refundsRetrieve: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **id** | **string**| The id of the refund |

### Return type

[**\zipMoney\Model\Refund**](../Model/Refund.md)

### Authorization

[Authorization](../../README.md#Authorization)

### HTTP request headers

 - **Content-Type**: application/javascript
 - **Accept**: application/javascript

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to Model list]](../../README.md#documentation-for-models) [[Back to README]](../../README.md)

