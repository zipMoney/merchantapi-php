# Checkout

## Properties
Name | Type | Description | Notes
------------ | ------------- | ------------- | -------------
**id** | **string** | The checkout id | 
**uri** | **string** | The uri to redirect the user to in order to approve this checkout. | 
**type** | **string** | The type of checkout | [optional] [default to 'standard']
**shopper** | [**\zipMoney\Model\Shopper**](Shopper.md) |  | [optional] 
**order** | [**\zipMoney\Model\CheckoutOrder**](CheckoutOrder.md) |  | [optional] 
**features** | [**\zipMoney\Model\CheckoutFeatures**](CheckoutFeatures.md) |  | [optional] 
**config** | [**\zipMoney\Model\CheckoutConfiguration**](CheckoutConfiguration.md) |  | [optional] 
**created** | [**\DateTime**](\DateTime.md) | Date the checkout was created | 
**state** | **string** | Current state of the checkout | 
**customer_id** | **string** | The id of the customer who has approved this checkout request. Only present if approved. | [optional] 
**metadata** | [**\zipMoney\Model\Metadata**](Metadata.md) |  | [optional] 

[[Back to Model list]](../README.md#documentation-for-models) [[Back to API list]](../README.md#documentation-for-api-endpoints) [[Back to README]](../README.md)


