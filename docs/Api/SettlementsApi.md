# zipMoney\SettlementsApi

All URIs are relative to *https://api.zipmoney.com.au/merchant/v1*

Method | HTTP request | Description
------------- | ------------- | -------------
[**settlementsGet**](SettlementsApi.md#settlementsGet) | **GET** /settlements/{id} | Retrieve a settlement
[**settlementsList**](SettlementsApi.md#settlementsList) | **GET** /settlements | List settlements


# **settlementsGet**
> \zipMoney\Model\Settlement settlementsGet($id)

Retrieve a settlement

Retrieves the full transactional details of a settlement.

### Example
```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');

$api_instance = new zipMoney\Api\SettlementsApi();
$id = "id_example"; // string | The settlement id

try {
    $result = $api_instance->settlementsGet($id);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling SettlementsApi->settlementsGet: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **id** | **string**| The settlement id |

### Return type

[**\zipMoney\Model\Settlement**](../Model/Settlement.md)

### Authorization

No authorization required

### HTTP request headers

 - **Content-Type**: application/javascript
 - **Accept**: application/javascript

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to Model list]](../../README.md#documentation-for-models) [[Back to README]](../../README.md)

# **settlementsList**
> settlementsList()

List settlements

This endpoint will allow a merchant to view the settlements which have occured. To view detailed transaction information for a specific settlement you can use the Retrieve a settlement endpoint.

### Example
```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');

$api_instance = new zipMoney\Api\SettlementsApi();

try {
    $api_instance->settlementsList();
} catch (Exception $e) {
    echo 'Exception when calling SettlementsApi->settlementsList: ', $e->getMessage(), PHP_EOL;
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

