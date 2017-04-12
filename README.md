# zipMoney Payments Pty Ltd.
ZipMoney Merchant API Initial build

- API version: 2017-03-01

## Requirements

PHP 5.3 and later

## Installation & Usage
### Composer

To install the bindings via [Composer](http://getcomposer.org/), add the following to `composer.json`:

```
{
  "repositories": [
    {
      "type": "git",
      "url": "https://github.com/zipMoney/merchantapi-php.git"
    }
  ],
  "require": {
    "zipMoney/merchantapi-php": "*@dev"
  }
}
```

Then run `composer install`

### Manual Installation

Download the files and include `autoload.php`:

```php
    require_once('/path/to/merchantapi-php/autoload.php');
```

## Tests

To run the unit tests:

```
composer require 
phpunit
```

## Getting Started

Please follow the [installation procedure](#installation--usage) and then run the following:

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');

// Configure API key authorization: Authorization
\zipMoney\Configuration::getDefaultConfiguration()->setApiKey('Authorization', 'YOUR_API_KEY');
\zipMoney\Configuration::getDefaultConfiguration()->setApiKeyPrefix('Bearer');
\zipMoney\Configuration::getDefaultConfiguration()->setEnvironment('ENVIRONMENT HERE'); // Allowed values are  ( sandbox | production )
\zipMoney\Configuration::getDefaultConfiguration()->setPlatform('PLATFORM HERE'); // E.g. Magento/1.9.1.2

$api_instance = new zipMoney\Api\ChargesApi();
$id = "id_example"; // string | The id of the authorised charge
$idempotency_key = "idempotency_key_example"; // string | The unique idempotency key.

try {
    $result = $api_instance->chargesCancel($id, $idempotency_key);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling ChargesApi->chargesCancel: ', $e->getMessage(), PHP_EOL;
}

?>
```

## Documentation for API Endpoints

All URIs are relative to *https://api.zipmoney.com.au/merchant/v1*

Class | Method | HTTP request | Description
------------ | ------------- | ------------- | -------------
*ChargesApi* | [**chargesCancel**](docs/Api/ChargesApi.md#chargescancel) | **POST** /charges/{id}/cancel | Cancel a charge
*ChargesApi* | [**chargesCapture**](docs/Api/ChargesApi.md#chargescapture) | **POST** /charges/{id}/capture | Capture a charge
*ChargesApi* | [**chargesCreate**](docs/Api/ChargesApi.md#chargescreate) | **POST** /charges | Create a charge
*ChargesApi* | [**chargesList**](docs/Api/ChargesApi.md#chargeslist) | **GET** /charges | List charges
*ChargesApi* | [**chargesRetrieve**](docs/Api/ChargesApi.md#chargesretrieve) | **GET** /charges/{id} | Retrieve a charge
*CheckoutsApi* | [**checkoutsCreate**](docs/Api/CheckoutsApi.md#checkoutscreate) | **POST** /checkouts | Create a checkout
*CheckoutsApi* | [**checkoutsGet**](docs/Api/CheckoutsApi.md#checkoutsget) | **GET** /checkouts/{id} | Retrieve a checkout
*CustomersApi* | [**customersGet**](docs/Api/CustomersApi.md#customersget) | **GET** /customers/{id} | Retrieve customer
*CustomersApi* | [**customersList**](docs/Api/CustomersApi.md#customerslist) | **GET** /customers | List customers
*RefundsApi* | [**refundsCreate**](docs/Api/RefundsApi.md#refundscreate) | **POST** /refunds | Create a refund
*RefundsApi* | [**refundsList**](docs/Api/RefundsApi.md#refundslist) | **GET** /refunds | List refunds
*RefundsApi* | [**refundsRetrieve**](docs/Api/RefundsApi.md#refundsretrieve) | **GET** /refunds/{id} | Retrieve a refund
*SettlementsApi* | [**settlementsGet**](docs/Api/SettlementsApi.md#settlementsget) | **GET** /settlements/{id} | Retrieve a settlement
*SettlementsApi* | [**settlementsList**](docs/Api/SettlementsApi.md#settlementslist) | **GET** /settlements | List settlements
*TokensApi* | [**tokensCreate**](docs/Api/TokensApi.md#tokenscreate) | **POST** /tokens | Create token


## Documentation For Models

 - [Address](docs/Model/Address.md)
 - [Authority](docs/Model/Authority.md)
 - [CaptureChargeRequest](docs/Model/CaptureChargeRequest.md)
 - [Charge](docs/Model/Charge.md)
 - [ChargeCollection](docs/Model/ChargeCollection.md)
 - [ChargeOrder](docs/Model/ChargeOrder.md)
 - [Checkout](docs/Model/Checkout.md)
 - [CheckoutConfiguration](docs/Model/CheckoutConfiguration.md)
 - [CheckoutFeatures](docs/Model/CheckoutFeatures.md)
 - [CheckoutFeaturesTokenisation](docs/Model/CheckoutFeaturesTokenisation.md)
 - [CheckoutOrder](docs/Model/CheckoutOrder.md)
 - [CreateChargeRequest](docs/Model/CreateChargeRequest.md)
 - [CreateCheckoutRequest](docs/Model/CreateCheckoutRequest.md)
 - [CreateCheckoutRequestFeatures](docs/Model/CreateCheckoutRequestFeatures.md)
 - [CreateCheckoutRequestFeaturesTokenisation](docs/Model/CreateCheckoutRequestFeaturesTokenisation.md)
 - [CreateRefundRequest](docs/Model/CreateRefundRequest.md)
 - [CreateTokenRequest](docs/Model/CreateTokenRequest.md)
 - [Customer](docs/Model/Customer.md)
 - [ErrorResponse](docs/Model/ErrorResponse.md)
 - [ErrorResponseError](docs/Model/ErrorResponseError.md)
 - [ErrorResponseErrorDetails](docs/Model/ErrorResponseErrorDetails.md)
 - [InlineResponse200](docs/Model/InlineResponse200.md)
 - [Metadata](docs/Model/Metadata.md)
 - [OrderItem](docs/Model/OrderItem.md)
 - [OrderShipping](docs/Model/OrderShipping.md)
 - [OrderShippingTracking](docs/Model/OrderShippingTracking.md)
 - [Refund](docs/Model/Refund.md)
 - [Shopper](docs/Model/Shopper.md)
 - [ShopperStatistics](docs/Model/ShopperStatistics.md)
 - [Token](docs/Model/Token.md)


## Documentation For Authorization


## Authorization

- **Type**: API key
- **API key parameter name**: Authorization
- **Location**: HTTP header


## Author




