# zipMoneyPHP\CheckoutsApi

All URIs are relative to *https://api.zipmoney.com.au/merchant/v1*

Method | HTTP request | Description
------------- | ------------- | -------------
[**checkoutsCreate**](CheckoutsApi.md#checkoutsCreate) | **POST** /checkouts | Create a checkout
[**checkoutsGet**](CheckoutsApi.md#checkoutsGet) | **GET** /checkouts/{id} | Retrieve a checkout


# **checkoutsCreate**
> \zipMoneyPHP/Model\Checkout checkoutsCreate($body)

Create a checkout

Creates a zipMoney checkout.  During the checkout process a customer can apply for credit decisioning in real-time. This means the checkout needs to represent a good picture of known customer details along with order information and the checkout entity represents this as a resource.  For more information on how to checkout with zipMoney see the #model:Z2QcrzRGHACY8wM6G guide.

### Example
```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');

// Configure API key authorization: Authorization
zipMoneyPHP\Configuration::getDefaultConfiguration()->setApiKey('Authorization', 'YOUR_API_KEY');
// Uncomment below to setup prefix (e.g. Bearer) for API key, if needed
// zipMoneyPHP\Configuration::getDefaultConfiguration()->setApiKeyPrefix('Authorization', 'Bearer');

$api_instance = new zipMoneyPHP\Api\CheckoutsApi();
$body = new \zipMoneyPHP/Model\CreateCheckoutRequest(); // \zipMoneyPHP/Model\CreateCheckoutRequest | 

try {
    $result = $api_instance->checkoutsCreate($body);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling CheckoutsApi->checkoutsCreate: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **body** | [**\zipMoneyPHP/Model\CreateCheckoutRequest**](../Model/\zipMoneyPHP/Model\CreateCheckoutRequest.md)|  | [optional]

### Return type

[**\zipMoneyPHP/Model\Checkout**](../Model/Checkout.md)

### Authorization

[Authorization](../../README.md#Authorization)

### HTTP request headers

 - **Content-Type**: application/json
 - **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to Model list]](../../README.md#documentation-for-models) [[Back to README]](../../README.md)

# **checkoutsGet**
> \zipMoneyPHP/Model\Checkout checkoutsGet($id)

Retrieve a checkout

### Example
```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');

// Configure API key authorization: Authorization
zipMoneyPHP\Configuration::getDefaultConfiguration()->setApiKey('Authorization', 'YOUR_API_KEY');
// Uncomment below to setup prefix (e.g. Bearer) for API key, if needed
// zipMoneyPHP\Configuration::getDefaultConfiguration()->setApiKeyPrefix('Authorization', 'Bearer');

$api_instance = new zipMoneyPHP\Api\CheckoutsApi();
$id = "id_example"; // string | 

try {
    $result = $api_instance->checkoutsGet($id);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling CheckoutsApi->checkoutsGet: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **id** | **string**|  |

### Return type

[**\zipMoneyPHP/Model\Checkout**](../Model/Checkout.md)

### Authorization

[Authorization](../../README.md#Authorization)

### HTTP request headers

 - **Content-Type**: application/json
 - **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to Model list]](../../README.md#documentation-for-models) [[Back to README]](../../README.md)

