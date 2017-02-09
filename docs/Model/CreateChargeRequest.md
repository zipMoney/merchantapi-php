# CreateChargeRequest

## Properties
Name | Type | Description | Notes
------------ | ------------- | ------------- | -------------
**reference** | **string** | The reference for this charge (unique payment reference in your store) | 
**authority** | [**\zipMoneyPHP/Model\Authority**](Authority.md) |  | 
**capture** | **bool** | If true this will be a direct capture, pass false to perform an authorisation only | [optional] [default to true]
**order** | [**\zipMoneyPHP/Model\Order**](Order.md) |  | [optional] 
**metadata** | **object** |  | [optional] 

[[Back to Model list]](../README.md#documentation-for-models) [[Back to API list]](../README.md#documentation-for-api-endpoints) [[Back to README]](../README.md)


