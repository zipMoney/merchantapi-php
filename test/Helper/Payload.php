<?php
/**
 * Payload
 *
 * @category Class
 * @package  zipMoney
 * @author   zipMoney Payments Pty Ltd
 * @link     https://github.com/zipMoney/merchantapi-php
 */

namespace zipMoney\Helper;

use \zipMoney\Model\CreateCheckoutRequest as CheckoutRequest;
use \zipMoney\Model\CreateChargeRequest as ChargeRequest;
use \zipMoney\Model\CreateRefundRequest as RefundRequest;
use \zipMoney\Model\CaptureChargeRequest;
use \zipMoney\Model\Shopper;
use \zipMoney\Model\CheckoutOrder;
use \zipMoney\Model\ChargeOrder;
use \zipMoney\Model\Authority;
use \zipMoney\Model\OrderShipping;
use \zipMoney\Model\OrderShippingTracking;
use \zipMoney\Model\Address;
use \zipMoney\Model\OrderItem;
use \zipMoney\Model\ShopperStatistics;
use \zipMoney\Model\Metadata;
use \zipMoney\Model\CheckoutConfiguration;

class Payload
{

  /**
   * @var Mage_Customer_Model_Session
   */
  protected $_quote;

  /**
   * @var Mage_Customer_Model_Session
   */
  protected $_order;

  protected $_checkoutId;

  protected $_chargeId;
  

  public function getCheckoutPayload()
  {
    $checkoutReq = new CheckoutRequest();


    $checkoutReq->setType("standard")
                ->setShopper($this->getShopper())
                ->setOrder($this->getOrderDetails(new CheckoutOrder))
                ->setMetadata($this->getMetadata())
                ->setConfig($this->getCheckoutConfiguration());

  return $checkoutReq;
  }


  public function getChargePayload()
  {
    $chargeReq = new ChargeRequest();

    $chargeReq->setAmount(100)             
              ->setOrder($this->getOrderDetails(new ChargeOrder))
              ->setCurrency("AUD")
              ->setCapture(true)              
              ->setMetadata($this->getMetadata())
              ->setAuthority($this->getAuthority());

    return $chargeReq;
  }

  public function getRefundPayload()
  {
    $chargeReq = new RefundRequest();


    $chargeReq->setAmount(100)
              ->setReason("Reason Text")
              ->setChargeId($this->getChargeId())
              ->setMetadata($this->getMetadata());

    return $chargeReq;
  }


  public function getCapturePayload()
  {
    $captureChargeReq = new CaptureChargeRequest();

    $captureChargeReq->setAmount(100);

    return $captureChargeReq;
  }


  public function getShopper()
  {
    
    $shopper = new Shopper;

    $shopper->setEmail("test@zipmoney.com.au");
    $shopper->setFirstName("zipMoney");
    $shopper->setLastName("Test");
    $shopper->setGender("Male");
    //$shopper->setBirthDate("1990-12-12");
    $shopper->setPhone("+610400000000");
    $shopper->setTitle("Mr.");

    $statistics = new ShopperStatistics;

    $statistics->setAccountCreated("2017-01-01")
             ->setSalesTotalCount(1000)
             ->setSalesAvgAmount(100)
             ->setSalesMaxAmount(500)
             ->setRefundsTotalAmount(0)
             ->setPreviousChargeback(false)
             ->setCurrency("AUD");
//             ->setLastLogin("2017-01-01 01:11:00");
        
    $shopper->setStatistics($statistics);

    $address = new Address;

    $address->setFirstName("zipMoney");
    $address->setLastName("Test");
    $address->setLine1("50 Test Street");
    $address->setState("NSW");
    $address->setCity("Sydney");
    $address->setCountry("AU");
    $address->setPostalCode("2000");

    $shopper->setBillingAddress($address);

    return $shopper;
  }

  public function getShippingDetails()
  {    
    
    return $shipping;
  }

  public function getOrderDetails($reqOrder)
  {
  
    $shipping = new OrderShipping;

    $address = new Address;

    $address->setFirstName("zipMoney");
    $address->setLastName("Test");
    $address->setLine1("50 Test Street");
    $address->setState("NSW");
    $address->setCity("Sydney");
    $address->setCountry("AU");
    $address->setPostalCode("2000");
    
    $shipping->setAddress($address);


    $orderItem = new OrderItem;

    $orderItem->setName("Test Product")
              ->setAmount(100)
              ->setReference(120)
              ->setDescription("Test Description")
              ->setQuantity(1)
              ->setType("sku")
              ->setImageUri("http://imageurl")
              ->setItemUri("http://itemurl")
              ->setProductCode("QAS00BB");  
    
    $orderItems = array();

    $orderItems[] = $orderItem;
    // Discount Item
    $discountItem = new OrderItem;
    $discountItem->setName("Discount");
    $discountItem->setAmount(-10);      
    $discountItem->setQuantity(1);      
    $discountItem->setType("discount");
    $orderItems[] = $discountItem;
  

    // Shipping Item
    $shippingItem = new OrderItem;      
    $shippingItem->setName("Shipping");
    $shippingItem->setAmount(15);
    $shippingItem->setType("shipping");      
    $shippingItem->setQuantity(1);      
    $orderItems[] = $shippingItem;
  

    // Tax Item
    $taxItem = new OrderItem;      
    $taxItem->setName("Tax");
    $taxItem->setAmount(5);
    $taxItem->setType("tax");            
    $taxItem->setQuantity(1);     

    $orderItems[] = $taxItem;

    if($reqOrder instanceOf CheckoutOrder){
      $reqOrder->setAmount(110)
               ->setCurrency("AUD");
    }

    $reqOrder->setShipping($shipping)
             ->setReference(1000055)
             ->setCartReference(1111)
             ->setItems($orderItems);
  
    return $reqOrder;      
  }


  public function getMetadata()
  { 
    $metadata = new Metadata;
  
    return $metadata;
  }

  public function setCheckoutId($checkout_id)
  {
    $this->_checkoutId = $checkout_id;
  }
  
  public function getCheckoutId()
  {
    return $this->_checkoutId;
  }


  public function setChargeId($charge_id)
  {
    $this->_chargeId = $charge_id;
  }
  
  public function getChargeId()
  {
    return $this->_chargeId;
  }


  public function getAuthority()
  { 

    $checkout_id = $this->getCheckoutId();

    $authority = new Authority;
    $authority->setType('checkout_id')
              ->setValue($checkout_id);
  
    return $authority;
  }

  public function getCheckoutConfiguration()
  {
    $checkout_config = new CheckoutConfiguration();

    $checkout_config->setRedirectUri("http://localhost/zipmoneypayment/complete");

   return $checkout_config;

  }
  

}

