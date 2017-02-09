# zipMoneyPHP\TokensApi

All URIs are relative to *https://api.zipmoney.com.au/merchant/v1*

Method | HTTP request | Description
------------- | ------------- | -------------
[**tokensCreate**](TokensApi.md#tokensCreate) | **POST** /tokens | Create token


# **tokensCreate**
> \zipMoneyPHP/Model\Token tokensCreate($body, $idempotency_key)

Create token

Tokenises a zip account allowing a charge to be performed at a later date without direct customer involvement.  In order to create a token you will first need to request customer approval by implementing one of the online checkout flows.  An approved checkout_id will need to be provided as the authority.  This endpoint will return 201 for success, otherwise 402. - 403 if checkout is invalid - 402 if account is not operational or pending  | Error code | Description | |------------------------------------|--------------------------------------------------------------------------------------------------| | account_inoperative | The account is in arrears or closed and cannot be charged | | account_locked | The account is locked |

### Example
```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');

// Configure API key authorization: Authorization
zipMoneyPHP\Configuration::getDefaultConfiguration()->setApiKey('Authorization', 'YOUR_API_KEY');
// Uncomment below to setup prefix (e.g. Bearer) for API key, if needed
// zipMoneyPHP\Configuration::getDefaultConfiguration()->setApiKeyPrefix('Authorization', 'Bearer');

$api_instance = new zipMoneyPHP\Api\TokensApi();
$body = new \zipMoneyPHP/Model\CreateTokenRequest(); // \zipMoneyPHP/Model\CreateTokenRequest | 
$idempotency_key = "idempotency_key_example"; // string | The unique idempotency key.

try {
    $result = $api_instance->tokensCreate($body, $idempotency_key);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling TokensApi->tokensCreate: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **body** | [**\zipMoneyPHP/Model\CreateTokenRequest**](../Model/\zipMoneyPHP/Model\CreateTokenRequest.md)|  | [optional]
 **idempotency_key** | **string**| The unique idempotency key. | [optional]

### Return type

[**\zipMoneyPHP/Model\Token**](../Model/Token.md)

### Authorization

[Authorization](../../README.md#Authorization)

### HTTP request headers

 - **Content-Type**: application/json
 - **Accept**: application/javascript

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to Model list]](../../README.md#documentation-for-models) [[Back to README]](../../README.md)

