# CreateChargeRequest

## Properties
Name | Type | Description | Notes
------------ | ------------- | ------------- | -------------
**authority** | [**\zipMoney\Model\Authority**](Authority.md) |  | 
**reference** | **string** | The reference for this charge (unique payment reference in your store) | [optional] 
**amount** | **float** | The amount of the charge | 
**currency** | **string** | The currency | 
**capture** | **bool** | If true this will be a direct capture, pass false to perform an authorisation only | [optional] [default to true]
**order** | [**\zipMoney\Model\ChargeOrder**](ChargeOrder.md) |  | [optional] 
**metadata** | **object** |  | [optional] 

[[Back to Model list]](../README.md#documentation-for-models) [[Back to API list]](../README.md#documentation-for-api-endpoints) [[Back to README]](../README.md)


