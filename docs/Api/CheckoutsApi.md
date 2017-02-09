# Swagger\Client\CheckoutsApi

All URIs are relative to *https://api.zipmoney.com.au/merchant/v1*

Method | HTTP request | Description
------------- | ------------- | -------------
[**checkoutsCreate**](CheckoutsApi.md#checkoutsCreate) | **POST** /checkouts | Create a checkout
[**checkoutsGet**](CheckoutsApi.md#checkoutsGet) | **GET** /checkouts/{id} | Retrieve a checkout


# **checkoutsCreate**
> \Swagger\Client\Model\Checkout checkoutsCreate($body)

Create a checkout

Creates a zipMoney checkout.  During the checkout process a customer can apply for credit decisioning in real-time. This means the checkout needs to represent a good picture of known customer details along with order information and the checkout entity represents this as a resource.  For more information on how to checkout with zipMoney see the #model:Z2QcrzRGHACY8wM6G guide.

### Example
```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');

// Configure API key authorization: Authorization
Swagger\Client\Configuration::getDefaultConfiguration()->setApiKey('Authorization', 'YOUR_API_KEY');
// Uncomment below to setup prefix (e.g. Bearer) for API key, if needed
// Swagger\Client\Configuration::getDefaultConfiguration()->setApiKeyPrefix('Authorization', 'Bearer');

$api_instance = new Swagger\Client\Api\CheckoutsApi();
$body = new \Swagger\Client\Model\CreateCheckoutRequest(); // \Swagger\Client\Model\CreateCheckoutRequest | 

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
 **body** | [**\Swagger\Client\Model\CreateCheckoutRequest**](../Model/\Swagger\Client\Model\CreateCheckoutRequest.md)|  | [optional]

### Return type

[**\Swagger\Client\Model\Checkout**](../Model/Checkout.md)

### Authorization

[Authorization](../../README.md#Authorization)

### HTTP request headers

 - **Content-Type**: application/json
 - **Accept**: application/javascript

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to Model list]](../../README.md#documentation-for-models) [[Back to README]](../../README.md)

# **checkoutsGet**
> \Swagger\Client\Model\Checkout checkoutsGet($id)

Retrieve a checkout

### Example
```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');

// Configure API key authorization: Authorization
Swagger\Client\Configuration::getDefaultConfiguration()->setApiKey('Authorization', 'YOUR_API_KEY');
// Uncomment below to setup prefix (e.g. Bearer) for API key, if needed
// Swagger\Client\Configuration::getDefaultConfiguration()->setApiKeyPrefix('Authorization', 'Bearer');

$api_instance = new Swagger\Client\Api\CheckoutsApi();
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

[**\Swagger\Client\Model\Checkout**](../Model/Checkout.md)

### Authorization

[Authorization](../../README.md#Authorization)

### HTTP request headers

 - **Content-Type**: application/json
 - **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to Model list]](../../README.md#documentation-for-models) [[Back to README]](../../README.md)

