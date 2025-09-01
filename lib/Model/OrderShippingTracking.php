<?php
declare(strict_types=1);

/**
 * OrderShippingTracking.
 *
 * @category Class
 * @package  zipMoney
 * @author   zipMoney Payments Pty Ltd
 * @link     https://github.com/zipMoney/merchantapi-php
 */

namespace zipMoney\Model;

use ArrayAccess;

class OrderShippingTracking implements ArrayAccess
{
    public const DISCRIMINATOR = 'subclass';

    /**
     * The original name of the model.
     *
     * @var string
     */
    protected static $swaggerModelName = 'OrderShipping_tracking';

    /**
     * Array of property to type mappings. Used for (de)serialization.
     *
     * @var string[]
     */
    protected static $zipTypes = [
        'uri'     => 'string',
        'number'  => 'string',
        'carrier' => 'string',
    ];

    public static function zipTypes()
    {
        return self::$zipTypes;
    }

    /**
     * Array of attributes where the key is the local name, and the value is the original name.
     *
     * @var string[]
     */
    protected static $attributeMap = [
        'uri'     => 'uri',
        'number'  => 'number',
        'carrier' => 'carrier',
    ];

    /**
     * Array of attributes to setter functions (for deserialization of responses).
     *
     * @var string[]
     */
    protected static $setters = [
        'uri'     => 'setUri',
        'number'  => 'setNumber',
        'carrier' => 'setCarrier',
    ];

    /**
     * Array of attributes to getter functions (for serialization of requests).
     *
     * @var string[]
     */
    protected static $getters = [
        'uri'     => 'getUri',
        'number'  => 'getNumber',
        'carrier' => 'getCarrier',
    ];

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
     * Associative array for storing property values.
     *
     * @var mixed[]
     */
    protected $container = [];

    /**
     * Constructor.
     *
     * @param mixed[] $data Associated array of property values initializing the model
     */
    public function __construct(?array $data = null)
    {
        $this->container['uri'] = isset($data['uri']) ? $data['uri'] : null;
        $this->container['number'] = isset($data['number']) ? $data['number'] : null;
        $this->container['carrier'] = isset($data['carrier']) ? $data['carrier'] : null;
    }

    /**
     * show all the invalid properties with reasons.
     *
     * @return array invalid properties with reasons
     */
    public function listInvalidProperties()
    {
        $invalid_properties = [];

        if (!is_null($this->container['uri']) && (strlen($this->container['uri']) > 500)) {
            $invalid_properties[] = "invalid value for 'uri', the character length must be smaller than or equal to 500.";
        }

        if (!is_null($this->container['number']) && (strlen($this->container['number']) > 120)) {
            $invalid_properties[] = "invalid value for 'number', the character length must be smaller than or equal to 120.";
        }

        if (!is_null($this->container['carrier']) && (strlen($this->container['carrier']) > 120)) {
            $invalid_properties[] = "invalid value for 'carrier', the character length must be smaller than or equal to 120.";
        }

        return $invalid_properties;
    }

    /**
     * validate all the properties in the model
     * return true if all passed.
     *
     * @return bool True if all properties are valid
     */
    public function valid()
    {
        if (strlen($this->container['uri']) > 500) {
            return false;
        }
        if (strlen($this->container['number']) > 120) {
            return false;
        }
        if (strlen($this->container['carrier']) > 120) {
            return false;
        }

        return true;
    }

    /**
     * Gets uri.
     *
     * @return string
     */
    public function getUri()
    {
        return $this->container['uri'];
    }

    /**
     * Sets uri.
     *
     * @param string $uri
     *
     * @return $this
     */
    public function setUri($uri)
    {
        if (!is_null($uri) && (strlen($uri) > 500)) {
            throw new \InvalidArgumentException('invalid length for $uri when calling OrderShippingTracking., must be smaller than or equal to 500.');
        }

        $this->container['uri'] = $uri;

        return $this;
    }

    /**
     * Gets number.
     *
     * @return string
     */
    public function getNumber()
    {
        return $this->container['number'];
    }

    /**
     * Sets number.
     *
     * @param string $number
     *
     * @return $this
     */
    public function setNumber($number)
    {
        if (!is_null($number) && (strlen($number) > 120)) {
            throw new \InvalidArgumentException('invalid length for $number when calling OrderShippingTracking., must be smaller than or equal to 120.');
        }

        $this->container['number'] = $number;

        return $this;
    }

    /**
     * Gets carrier.
     *
     * @return string
     */
    public function getCarrier()
    {
        return $this->container['carrier'];
    }

    /**
     * Sets carrier.
     *
     * @param string $carrier
     *
     * @return $this
     */
    public function setCarrier($carrier)
    {
        if (!is_null($carrier) && (strlen($carrier) > 120)) {
            throw new \InvalidArgumentException('invalid length for $carrier when calling OrderShippingTracking., must be smaller than or equal to 120.');
        }

        $this->container['carrier'] = $carrier;

        return $this;
    }

    /**
     * Returns true if offset exists. False otherwise.
     *
     * @param int $offset Offset
     *
     * @return bool
     */
    public function offsetExists($offset): bool
    {
        return isset($this->container[$offset]);
    }

    /**
     * Gets offset.
     *
     * @param int $offset Offset
     *
     * @return mixed
     */
    public function offsetGet($offset): mixed
    {
        return $this->container[$offset] ?? null;
    }

    /**
     * Sets value based on offset.
     *
     * @param int   $offset Offset
     * @param mixed $value  Value to be set
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
     *
     * @param int $offset Offset
     */
    public function offsetUnset($offset): void
    {
        unset($this->container[$offset]);
    }

    /**
     * Gets the string presentation of the object.
     *
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
