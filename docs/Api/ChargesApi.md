# zipMoney\ChargesApi

All URIs are relative to *https://api.zipmoney.com.au/merchant/v1*

Method | HTTP request | Description
------------- | ------------- | -------------
[**chargesCancel**](ChargesApi.md#chargesCancel) | **POST** /charges/{id}/cancel | Cancel a charge
[**chargesCapture**](ChargesApi.md#chargesCapture) | **POST** /charges/{id}/capture | Capture a charge
[**chargesCreate**](ChargesApi.md#chargesCreate) | **POST** /charges | Create a charge
[**chargesList**](ChargesApi.md#chargesList) | **GET** /charges | List charges
[**chargesRetrieve**](ChargesApi.md#chargesRetrieve) | **GET** /charges/{id} | Retrieve a charge


# **chargesCancel**
> \zipMoney\Model\Charge chargesCancel($id, $idempotency_key)

Cancel a charge

Cancels an authorised charge.  | Error code | Description | |------------------------------------|--------------------------------------------------------------------------------------------------| | invalid_state | The charge is not in authorised state |

### Example
```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');

// Configure API key authorization: Authorization
zipMoney\Configuration::getDefaultConfiguration()->setApiKey('Authorization', 'YOUR_API_KEY');
// Uncomment below to setup prefix (e.g. Bearer) for API key, if needed
// zipMoney\Configuration::getDefaultConfiguration()->setApiKeyPrefix('Authorization', 'Bearer');

$api_instance = new zipMoney\Api\ChargesApi();
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

[**\zipMoney\Model\Charge**](../Model/Charge.md)

### Authorization

[Authorization](../../README.md#Authorization)

### HTTP request headers

 - **Content-Type**: application/json
 - **Accept**: application/javascript

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to Model list]](../../README.md#documentation-for-models) [[Back to README]](../../README.md)

# **chargesCapture**
> \zipMoney\Model\Charge chargesCapture($id, $body, $idempotency_key)

Capture a charge

| Error code | Description | |------------------------------------|--------------------------------------------------------------------------------------------------| | amount_invalid | Capture amount greater than authorised amount | | invalid_state | The charge is not in authorised state |

### Example
```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');

// Configure API key authorization: Authorization
zipMoney\Configuration::getDefaultConfiguration()->setApiKey('Authorization', 'YOUR_API_KEY');
// Uncomment below to setup prefix (e.g. Bearer) for API key, if needed
// zipMoney\Configuration::getDefaultConfiguration()->setApiKeyPrefix('Authorization', 'Bearer');

$api_instance = new zipMoney\Api\ChargesApi();
$id = "id_example"; // string | The id of the authorised charge
$body = new \zipMoney\Model\CaptureChargeRequest(); // \zipMoney\Model\CaptureChargeRequest | 
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
 **body** | [**\zipMoney\Model\CaptureChargeRequest**](../Model/\zipMoney\Model\CaptureChargeRequest.md)|  | [optional]
 **idempotency_key** | **string**| The unique idempotency key. | [optional]

### Return type

[**\zipMoney\Model\Charge**](../Model/Charge.md)

### Authorization

[Authorization](../../README.md#Authorization)

### HTTP request headers

 - **Content-Type**: application/json
 - **Accept**: application/javascript

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to Model list]](../../README.md#documentation-for-models) [[Back to README]](../../README.md)

# **chargesCreate**
> \zipMoney\Model\Charge chargesCreate($body, $idempotency_key)

Create a charge

Creates a #model:ehEN48PET29iNdex3 which represents a charge against a customer's account.  To execute this endpoint you must first obtain customer approval by implementing the #docTextSection:43C79g2JjeGs8AHWi as a part of your online store.  This endpoint will return 201 if successful otherwise 402 with a specific error response.  ## Capture or authorisation  A charge can be created as either an authorisation or an immediate capture. This can be controlled in the initial request to the charge.  In most cases you will want to immediately capture the payment, this will mark the debit for settlement into your account the very same day and will immediately deduct the funds from the customer's account.  In some cases you may wish to delay the settlement of funds until a later date, perhaps until the goods are shipped to the customer. In this scenario you should send { capture: false } in the request to the #endpoint:dtmp3HxaHKjewvvGW endpoint and the charge will be created in an authorised state.  An authorised charge will place a hold for the specified amount on the customer's account in the form of a pending debit. Once authorised you are guaranteed the funds are available and awaiting a capture request to the #endpoint:wReod3JtbzNutMSXj endpoint, at which point the charge will move to the captured state and the funds will be settled into your account. It is at this point the customer's interest free period will start if applicable for the selected account.  ## Specific error responses  If a charge was not able to be performed a \"402 - Request Failed\" status code will be returned as detailed in #docTextSection:fJYHM2ZKtEui8RrAM. The error object can contain more specific error reason codes, which are detailed below.  | Error code | Description | |------------------------------------|--------------------------------------------------------------------------------------------------| | account_insufficient_funds | Customer does not have sufficient funds to perform the charge | | account_inoperative | The account is in arrears or closed and cannot be charged | | account_locked | The account is locked | | amount_invalid | The amount provided does not match the approved checkout amount | | fraud_check | Fraud checks resulted in payment failure |

### Example
```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');

// Configure API key authorization: Authorization
zipMoney\Configuration::getDefaultConfiguration()->setApiKey('Authorization', 'YOUR_API_KEY');
// Uncomment below to setup prefix (e.g. Bearer) for API key, if needed
// zipMoney\Configuration::getDefaultConfiguration()->setApiKeyPrefix('Authorization', 'Bearer');

$api_instance = new zipMoney\Api\ChargesApi();
$body = new \zipMoney\Model\CreateChargeRequest(); // \zipMoney\Model\CreateChargeRequest | 
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
 **body** | [**\zipMoney\Model\CreateChargeRequest**](../Model/\zipMoney\Model\CreateChargeRequest.md)|  | [optional]
 **idempotency_key** | **string**| The unique idempotency key. | [optional]

### Return type

[**\zipMoney\Model\Charge**](../Model/Charge.md)

### Authorization

[Authorization](../../README.md#Authorization)

### HTTP request headers

 - **Content-Type**: application/json
 - **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to Model list]](../../README.md#documentation-for-models) [[Back to README]](../../README.md)

# **chargesList**
> \zipMoney\Model\ChargeCollection chargesList($state, $skip, $limit, $expand)

List charges

Lists all charges matching search criteria.

### Example
```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');

// Configure API key authorization: Authorization
zipMoney\Configuration::getDefaultConfiguration()->setApiKey('Authorization', 'YOUR_API_KEY');
// Uncomment below to setup prefix (e.g. Bearer) for API key, if needed
// zipMoney\Configuration::getDefaultConfiguration()->setApiKeyPrefix('Authorization', 'Bearer');

$api_instance = new zipMoney\Api\ChargesApi();
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

[**\zipMoney\Model\ChargeCollection**](../Model/ChargeCollection.md)

### Authorization

[Authorization](../../README.md#Authorization)

### HTTP request headers

 - **Content-Type**: application/javascript
 - **Accept**: application/javascript

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to Model list]](../../README.md#documentation-for-models) [[Back to README]](../../README.md)

# **chargesRetrieve**
> \zipMoney\Model\Charge chargesRetrieve($id, $expand)

Retrieve a charge

Retrieve details of a previously created charge.

### Example
```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');

// Configure API key authorization: Authorization
zipMoney\Configuration::getDefaultConfiguration()->setApiKey('Authorization', 'YOUR_API_KEY');
// Uncomment below to setup prefix (e.g. Bearer) for API key, if needed
// zipMoney\Configuration::getDefaultConfiguration()->setApiKeyPrefix('Authorization', 'Bearer');

$api_instance = new zipMoney\Api\ChargesApi();
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

[**\zipMoney\Model\Charge**](../Model/Charge.md)

### Authorization

[Authorization](../../README.md#Authorization)

### HTTP request headers

 - **Content-Type**: application/javascript
 - **Accept**: application/javascript

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to Model list]](../../README.md#documentation-for-models) [[Back to README]](../../README.md)

