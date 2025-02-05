<?php

/**
 * OrderShipping
 *
 * @category Class
 * @package  zipMoney
 * @author   zipMoney Payments Pty Ltd
 * @link     https://github.com/zipMoney/merchantapi-php
 */

namespace zipMoney\Model;

use ArrayAccess;

class OrderShipping implements ArrayAccess
{
    public const DISCRIMINATOR = 'subclass';

    /**
      * The original name of the model.
      * @var string
      */
    protected static $swaggerModelName = 'OrderShipping';

    /**
      * Array of property to type mappings. Used for (de)serialization
      * @var string[]
      */
    protected static $zipTypes = array(
        'pickup' => 'bool',
        'tracking' => '\zipMoney\Model\OrderShippingTracking',
        'address' => '\zipMoney\Model\Address'
    );

    public static function zipTypes()
    {
        return self::$zipTypes;
    }

    /**
     * Array of attributes where the key is the local name, and the value is the original name
     * @var string[]
     */
    protected static $attributeMap = array(
        'pickup' => 'pickup',
        'tracking' => 'tracking',
        'address' => 'address'
    );


    /**
     * Array of attributes to setter functions (for deserialization of responses)
     * @var string[]
     */
    protected static $setters = array(
        'pickup' => 'setPickup',
        'tracking' => 'setTracking',
        'address' => 'setAddress'
    );


    /**
     * Array of attributes to getter functions (for serialization of requests)
     * @var string[]
     */
    protected static $getters = array(
        'pickup' => 'getPickup',
        'tracking' => 'getTracking',
        'address' => 'getAddress'
    );

    public static function attributeMap()
    {
        return self::$attributeMap;
    }

    public static function setters()
    {
        return self::$setters;
    }

    public static function getters()
    {
        return self::$getters;
    }





    /**
     * Associative array for storing property values
     * @var mixed[]
     */
    protected $container = array();

    /**
     * Constructor
     * @param mixed[] $data Associated array of property values initializing the model
     */
    public function __construct(array $data = null)
    {
        $this->container['pickup'] = isset($data['pickup']) ? $data['pickup'] : null;
        $this->container['tracking'] = isset($data['tracking']) ? $data['tracking'] : null;
        $this->container['address'] = isset($data['address']) ? $data['address'] : null;
    }

    /**
     * show all the invalid properties with reasons.
     *
     * @return array invalid properties with reasons
     */
    public function listInvalidProperties()
    {
        $invalid_properties = array();

        return $invalid_properties;
    }

    /**
     * validate all the properties in the model
     * return true if all passed
     *
     * @return bool True if all properties are valid
     */
    public function valid()
    {

        return true;
    }


    /**
     * Gets pickup
     * @return bool
     */
    public function getPickup()
    {
        return $this->container['pickup'];
    }

    /**
     * Sets pickup
     * @param bool $pickup States if the shipping method is pickup, otherwise the shipping address should be provided
     * @return $this
     */
    public function setPickup($pickup)
    {
        $this->container['pickup'] = $pickup;

        return $this;
    }

    /**
     * Gets tracking
     * @return \zipMoney\Model\OrderShippingTracking
     */
    public function getTracking()
    {
        return $this->container['tracking'];
    }

    /**
     * Sets tracking
     * @param \zipMoney\Model\OrderShippingTracking $tracking
     * @return $this
     */
    public function setTracking($tracking)
    {
        $this->container['tracking'] = $tracking;

        return $this;
    }

    /**
     * Gets address
     * @return \zipMoney\Model\Address
     */
    public function getAddress()
    {
        return $this->container['address'];
    }

    /**
     * Sets address
     * @param \zipMoney\Model\Address $address
     * @return $this
     */
    public function setAddress($address)
    {
        $this->container['address'] = $address;

        return $this;
    }
    /**
     * Returns true if offset exists. False otherwise.
     * @param  integer $offset Offset
     * @return boolean
     */
    public function offsetExists($offset): bool
    {
        return isset($this->container[$offset]);
    }

    /**
     * Gets offset.
     * @param  integer $offset Offset
     * @return mixed
     */
    public function offsetGet($offset)
    {
        return $this->container[$offset] ?? null;
    }

    /**
     * Sets value based on offset.
     * @param  integer $offset Offset
     * @param  mixed   $value  Value to be set
     * @return void
     */
    public function offsetSet($offset, $value): void
    {
        if (is_null($offset)) {
            $this->container[] = $value;
        } else {
            $this->container[$offset] = $value;
        }
    }

    /**
     * Unsets offset.
     * @param  integer $offset Offset
     * @return void
     */
    public function offsetUnset($offset): void
    {
        unset($this->container[$offset]);
    }

    /**
     * Gets the string presentation of the object
     * @return string
     */
    public function __toString()
    {
        if (defined('JSON_PRETTY_PRINT')) { // use JSON pretty print
            return json_encode(\zipMoney\ObjectSerializer::sanitizeForSerialization($this), JSON_PRETTY_PRINT);
        }

        return json_encode(\zipMoney\ObjectSerializer::sanitizeForSerialization($this));
    }
}
