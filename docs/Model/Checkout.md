# Checkout

## Properties
Name | Type | Description | Notes
------------ | ------------- | ------------- | -------------
**id** | **string** | The checkout id | 
**uri** | **string** | The uri to redirect the user to in order to approve this checkout. | 
**initiator** | [**\zipMoneyPHP/Model\CheckoutInitiator**](CheckoutInitiator.md) |  | [optional] 
**order** | [**\zipMoneyPHP/Model\Order**](Order.md) |  | [optional] 
**config** | [**\zipMoneyPHP/Model\CheckoutConfig**](CheckoutConfig.md) |  | [optional] 
**additional_features** | **string[]** | Specific checkout features | [optional] 
**created** | [**\DateTime**](\DateTime.md) | Date the checkout was created | 
**state** | **string** | Current state of the checkout | 
**customer_id** | **string** | The id of the customer who has approved this checkout request. Only present if approved. | [optional] 
**metadata** | [**\zipMoneyPHP/Model\Metadata**](Metadata.md) |  | [optional] 

[[Back to Model list]](../README.md#documentation-for-models) [[Back to API list]](../README.md#documentation-for-api-endpoints) [[Back to README]](../README.md)


