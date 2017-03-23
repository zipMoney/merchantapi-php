# zipMoney\CustomersApi

All URIs are relative to *https://api.zipmoney.com.au/merchant/v1*

Method | HTTP request | Description
------------- | ------------- | -------------
[**customersGet**](CustomersApi.md#customersGet) | **GET** /customers/{id} | Retrieve customer
[**customersList**](CustomersApi.md#customersList) | **GET** /customers | List customers


# **customersGet**
> customersGet($id)

Retrieve customer

Retrieves the details of a customer by id. This will only return customer details for customers who have transacted previously via the zip Merchant API.

### Example
```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');

$api_instance = new zipMoney\Api\CustomersApi();
$id = "id_example"; // string | 

try {
    $api_instance->customersGet($id);
} catch (Exception $e) {
    echo 'Exception when calling CustomersApi->customersGet: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **id** | **string**|  |

### Return type

void (empty response body)

### Authorization

No authorization required

### HTTP request headers

 - **Content-Type**: application/javascript
 - **Accept**: application/javascript

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to Model list]](../../README.md#documentation-for-models) [[Back to README]](../../README.md)

# **customersList**
> customersList()

List customers

Returns a list of all customers who have transacted previously with your merchant account.

### Example
```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');

$api_instance = new zipMoney\Api\CustomersApi();

try {
    $api_instance->customersList();
} catch (Exception $e) {
    echo 'Exception when calling CustomersApi->customersList: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters
This endpoint does not need any parameter.

### Return type

void (empty response body)

### Authorization

No authorization required

### HTTP request headers

 - **Content-Type**: application/javascript
 - **Accept**: application/javascript

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to Model list]](../../README.md#documentation-for-models) [[Back to README]](../../README.md)

