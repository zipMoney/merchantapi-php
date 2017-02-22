# CheckoutOrder

## Properties
Name | Type | Description | Notes
------------ | ------------- | ------------- | -------------
**reference** | **string** | The order id in the eCommerce system | [optional] 
**amount** | **float** | The total amount of the order | 
**currency** | **string** | The ISO-4217 currency code. See https://en.wikipedia.org/wiki/ISO_4217 | 
**shipping** | [**\zipMoney\Model\ChargeOrderShipping**](ChargeOrderShipping.md) |  | [optional] 
**items** | [**\zipMoney\Model\ChargeOrderItem[]**](ChargeOrderItem.md) | The order item breakdown | [optional] 
**cart_reference** | **string** | The shopping cart reference id | [optional] 

[[Back to Model list]](../README.md#documentation-for-models) [[Back to API list]](../README.md#documentation-for-api-endpoints) [[Back to README]](../README.md)


