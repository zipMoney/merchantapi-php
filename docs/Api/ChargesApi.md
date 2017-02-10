# zipMoneyPHP\ChargesApi

All URIs are relative to *https://api.zipmoney.com.au/merchant/v1*

Method | HTTP request | Description
------------- | ------------- | -------------
[**chargesCancel**](ChargesApi.md#chargesCancel) | **POST** /charges/{id}/cancel | Cancel a charge
[**chargesCapture**](ChargesApi.md#chargesCapture) | **POST** /charges/{id}/capture | Capture a charge
[**chargesCreate**](ChargesApi.md#chargesCreate) | **POST** /charges | Create a charge
[**chargesList**](ChargesApi.md#chargesList) | **GET** /charges | List charges
[**chargesRetrieve**](ChargesApi.md#chargesRetrieve) | **GET** /charges/{id} | Retrieve a charge


# **chargesCancel**
> \zipMoneyPHP\Model\Charge chargesCancel($id, $idempotency_key)

Cancel a charge

Cancels an authorised charge.

### Example
```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');

// Configure API key authorization: Authorization
zipMoneyPHP\Configuration::getDefaultConfiguration()->setApiKey('Authorization', 'YOUR_API_KEY');
// Uncomment below to setup prefix (e.g. Bearer) for API key, if needed
// zipMoneyPHP\Configuration::getDefaultConfiguration()->setApiKeyPrefix('Authorization', 'Bearer');

$api_instance = new zipMoneyPHP\Api\ChargesApi();
$id = "id_example"; // string | The id of the authorised charge
$idempotency_key = "idempotency_key_example"; // string | The unique idempotency key.

try {
    $result = $api_instance->chargesCancel($id, $idempotency_key);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling ChargesApi->chargesCancel: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **id** | **string**| The id of the authorised charge |
 **idempotency_key** | **string**| The unique idempotency key. | [optional]

### Return type

[**\zipMoneyPHP\Model\Charge**](../Model/Charge.md)

### Authorization

[Authorization](../../README.md#Authorization)

### HTTP request headers

 - **Content-Type**: application/json
 - **Accept**: application/javascript

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to Model list]](../../README.md#documentation-for-models) [[Back to README]](../../README.md)

# **chargesCapture**
> \zipMoneyPHP\Model\Charge chargesCapture($id, $body, $idempotency_key)

Capture a charge

Captures a previously authorised charge.  The capture can be less than or equal to the previously authorised amount. Note however that once the capture is performed the authorisation is removed, and any difference between the captured amount and authorised amount will be void.  ## Specific error responses  If a charge was not able to be performed a \"402 - Request Failed\" status code will be returned as detailed in #docTextSection:2oq6mr8Y6L45XaaQ3. The error object can contain more specific error reason codes, which are detailed below.  | Error code | Description | |------------------------------------|--------------------------------------------------------------------------------------------------| | invalid_state | The resource is in an invalid state for this operation | | invalid_capture | The captured amount must be less than or equal to the authorised amount |

### Example
```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');

// Configure API key authorization: Authorization
zipMoneyPHP\Configuration::getDefaultConfiguration()->setApiKey('Authorization', 'YOUR_API_KEY');
// Uncomment below to setup prefix (e.g. Bearer) for API key, if needed
// zipMoneyPHP\Configuration::getDefaultConfiguration()->setApiKeyPrefix('Authorization', 'Bearer');

$api_instance = new zipMoneyPHP\Api\ChargesApi();
$id = "id_example"; // string | The id of the authorised charge
$body = new \zipMoneyPHP\Model\CaptureChargeRequest(); // \zipMoneyPHP\Model\CaptureChargeRequest | 
$idempotency_key = "idempotency_key_example"; // string | The unique idempotency key.

try {
    $result = $api_instance->chargesCapture($id, $body, $idempotency_key);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling ChargesApi->chargesCapture: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **id** | **string**| The id of the authorised charge |
 **body** | [**\zipMoneyPHP\Model\CaptureChargeRequest**](../Model/\zipMoneyPHP\Model\CaptureChargeRequest.md)|  | [optional]
 **idempotency_key** | **string**| The unique idempotency key. | [optional]

### Return type

[**\zipMoneyPHP\Model\Charge**](../Model/Charge.md)

### Authorization

[Authorization](../../README.md#Authorization)

### HTTP request headers

 - **Content-Type**: application/json
 - **Accept**: application/javascript

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to Model list]](../../README.md#documentation-for-models) [[Back to README]](../../README.md)

# **chargesCreate**
> \zipMoneyPHP\Model\Charge chargesCreate($body, $idempotency_key)

Create a charge

Creates a #model:ehEN48PET29iNdex3 which represents a charge against a customer's account.  To execute this endpoint you must first obtain customer approval by implementing the #docTextSection:43C79g2JjeGs8AHWi as a part of your online store.  This endpoint will return 201 if successful otherwise 402 with a specific error response.  ## Capture or authorisation  A charge can be created as either an authorisation or an immediate capture. This can be controlled in the initial request to the charge.  In most cases you will want to immediately capture the payment, this will mark the debit for settlement into your account the very same day and will immediately deduct the funds from the customer's account.  In some cases you may wish to delay the settlement of funds until a later date, perhaps until the goods are shipped to the customer. In this scenario you should send { capture: false } in the request to the #endpoint:SykanpN2kmpuGriHv endpoint and the charge will be created in an authorised state.  An authorised charge will place a hold for the specified amount on the customer's account in the form of a pending debit. Once authorised you are guaranteed the funds are available and awaiting a capture request to the #endpoint:wReod3JtbzNutMSXj endpoint, at which point the charge will move to the captured state and the funds will be settled into your account. It is at this point the customer's interest free period will start if applicable fofr the selected account.  If a capture is not performed within 14 days the authorised charge will auto-expire and the customer will be free to use these funds for other purchases and any calls to capture the charge will be declined.  ## Specific error responses  If a charge was not able to be performed a \"402 - Request Failed\" status code will be returned as detailed in #docTextSection:2oq6mr8Y6L45XaaQ3. The error object can contain more specific error reason codes, which are detailed below.  | Error code | Description | |------------------------------------|--------------------------------------------------------------------------------------------------| | account_insufficient_funds | Customer does not have sufficient funds to perform the charge | | account_inoperative | The account is in arrears or closed and cannot be charged | | account_locked | The account is locked | | fraud_check | Fraud checks resulted in payment failure |

### Example
```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');

// Configure API key authorization: Authorization
zipMoneyPHP\Configuration::getDefaultConfiguration()->setApiKey('Authorization', 'YOUR_API_KEY');
// Uncomment below to setup prefix (e.g. Bearer) for API key, if needed
// zipMoneyPHP\Configuration::getDefaultConfiguration()->setApiKeyPrefix('Authorization', 'Bearer');

$api_instance = new zipMoneyPHP\Api\ChargesApi();
$body = new \zipMoneyPHP\Model\CreateChargeRequest(); // \zipMoneyPHP\Model\CreateChargeRequest | 
$idempotency_key = "idempotency_key_example"; // string | The unique idempotency key.

try {
    $result = $api_instance->chargesCreate($body, $idempotency_key);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling ChargesApi->chargesCreate: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **body** | [**\zipMoneyPHP\Model\CreateChargeRequest**](../Model/\zipMoneyPHP\Model\CreateChargeRequest.md)|  | [optional]
 **idempotency_key** | **string**| The unique idempotency key. | [optional]

### Return type

[**\zipMoneyPHP\Model\Charge**](../Model/Charge.md)

### Authorization

[Authorization](../../README.md#Authorization)

### HTTP request headers

 - **Content-Type**: application/json
 - **Accept**: application/javascript

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to Model list]](../../README.md#documentation-for-models) [[Back to README]](../../README.md)

# **chargesList**
> \zipMoneyPHP\Model\Charge[] chargesList($state, $skip, $limit, $expand)

List charges

Lists all charges matching search criteria.

### Example
```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');

// Configure API key authorization: Authorization
zipMoneyPHP\Configuration::getDefaultConfiguration()->setApiKey('Authorization', 'YOUR_API_KEY');
// Uncomment below to setup prefix (e.g. Bearer) for API key, if needed
// zipMoneyPHP\Configuration::getDefaultConfiguration()->setApiKeyPrefix('Authorization', 'Bearer');

$api_instance = new zipMoneyPHP\Api\ChargesApi();
$state = "state_example"; // string | The state filter
$skip = 0; // int | Number of items to skip when paging
$limit = 100; // int | Number of items to retrieve when paging
$expand = "expand_example"; // string | Allows expanding related entities in the response. Only valid entry is 'customer'

try {
    $result = $api_instance->chargesList($state, $skip, $limit, $expand);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling ChargesApi->chargesList: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **state** | **string**| The state filter | [optional]
 **skip** | **int**| Number of items to skip when paging | [optional] [default to 0]
 **limit** | **int**| Number of items to retrieve when paging | [optional] [default to 100]
 **expand** | **string**| Allows expanding related entities in the response. Only valid entry is &#39;customer&#39; | [optional]

### Return type

[**\zipMoneyPHP\Model\Charge[]**](../Model/Charge.md)

### Authorization

[Authorization](../../README.md#Authorization)

### HTTP request headers

 - **Content-Type**: application/javascript
 - **Accept**: application/javascript

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to Model list]](../../README.md#documentation-for-models) [[Back to README]](../../README.md)

# **chargesRetrieve**
> \zipMoneyPHP\Model\Charge chargesRetrieve($id, $expand)

Retrieve a charge

Retrieve details of a previously created charge.

### Example
```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');

// Configure API key authorization: Authorization
zipMoneyPHP\Configuration::getDefaultConfiguration()->setApiKey('Authorization', 'YOUR_API_KEY');
// Uncomment below to setup prefix (e.g. Bearer) for API key, if needed
// zipMoneyPHP\Configuration::getDefaultConfiguration()->setApiKeyPrefix('Authorization', 'Bearer');

$api_instance = new zipMoneyPHP\Api\ChargesApi();
$id = "id_example"; // string | The id of the charge
$expand = "expand_example"; // string | Allows expanding related entities in the response. Only valid entry is 'customer'

try {
    $result = $api_instance->chargesRetrieve($id, $expand);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling ChargesApi->chargesRetrieve: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **id** | **string**| The id of the charge |
 **expand** | **string**| Allows expanding related entities in the response. Only valid entry is &#39;customer&#39; | [optional]

### Return type

[**\zipMoneyPHP\Model\Charge**](../Model/Charge.md)

### Authorization

[Authorization](../../README.md#Authorization)

### HTTP request headers

 - **Content-Type**: application/javascript
 - **Accept**: application/javascript

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to Model list]](../../README.md#documentation-for-models) [[Back to README]](../../README.md)

