<?php
declare(strict_types=1);

/**
 * CreateCheckoutRequest.
 *
 * @category Class
 * @package  zipMoney
 * @author   zipMoney Payments Pty Ltd
 * @link     https://github.com/zipMoney/merchantapi-php
 */

namespace zipMoney\Model;

use ArrayAccess;

class CreateCheckoutRequest implements ArrayAccess
{
    public const DISCRIMINATOR = 'subclass';

    /**
     * The original name of the model.
     *
     * @var string
     */
    protected static $swaggerModelName = 'CreateCheckoutRequest';

    /**
     * Array of property to type mappings. Used for (de)serialization.
     *
     * @var string[]
     */
    protected static $zipTypes = [
        'type'     => 'string',
        'shopper'  => '\zipMoney\Model\Shopper',
        'order'    => '\zipMoney\Model\CheckoutOrder',
        'features' => '\zipMoney\Model\CreateCheckoutRequestFeatures',
        'metadata' => '\zipMoney\Model\Metadata',
        'config'   => '\zipMoney\Model\CheckoutConfiguration',
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
        'type'     => 'type',
        'shopper'  => 'shopper',
        'order'    => 'order',
        'features' => 'features',
        'metadata' => 'metadata',
        'config'   => 'config',
    ];

    /**
     * Array of attributes to setter functions (for deserialization of responses).
     *
     * @var string[]
     */
    protected static $setters = [
        'type'     => 'setType',
        'shopper'  => 'setShopper',
        'order'    => 'setOrder',
        'features' => 'setFeatures',
        'metadata' => 'setMetadata',
        'config'   => 'setConfig',
    ];

    /**
     * Array of attributes to getter functions (for serialization of requests).
     *
     * @var string[]
     */
    protected static $getters = [
        'type'     => 'getType',
        'shopper'  => 'getShopper',
        'order'    => 'getOrder',
        'features' => 'getFeatures',
        'metadata' => 'getMetadata',
        'config'   => 'getConfig',
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

    public const TYPE_STANDARD = 'standard';
    public const TYPE_EXPRESS = 'express';

    /**
     * Gets allowable values of the enum.
     *
     * @return string[]
     */
    public function getTypeAllowableValues()
    {
        return [
            self::TYPE_STANDARD,
            self::TYPE_EXPRESS,
        ];
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
        $this->container['type'] = isset($data['type']) ? $data['type'] : 'standard';
        $this->container['shopper'] = isset($data['shopper']) ? $data['shopper'] : null;
        $this->container['order'] = isset($data['order']) ? $data['order'] : null;
        $this->container['features'] = isset($data['features']) ? $data['features'] : null;
        $this->container['metadata'] = isset($data['metadata']) ? $data['metadata'] : null;
        $this->container['config'] = isset($data['config']) ? $data['config'] : null;
    }

    /**
     * show all the invalid properties with reasons.
     *
     * @return array invalid properties with reasons
     */
    public function listInvalidProperties()
    {
        $invalid_properties = [];

        $allowed_values = ['standard', 'express'];
        if (!in_array($this->container['type'], $allowed_values)) {
            $invalid_properties[] = "invalid value for 'type', must be one of 'standard', 'express'.";
        }

        if ($this->container['order'] === null) {
            $invalid_properties[] = "'order' can't be null";
        }
        if ($this->container['config'] === null) {
            $invalid_properties[] = "'config' can't be null";
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
        $allowed_values = ['standard', 'express'];
        if (!in_array($this->container['type'], $allowed_values)) {
            return false;
        }
        if ($this->container['order'] === null) {
            return false;
        }
        if ($this->container['config'] === null) {
            return false;
        }

        return true;
    }

    /**
     * Gets type.
     *
     * @return string
     */
    public function getType()
    {
        return $this->container['type'];
    }

    /**
     * Sets type.
     *
     * @param string $type The checkout type.
     *
     * @return $this
     */
    public function setType($type)
    {
        $allowed_values = ['standard', 'express'];
        if (!is_null($type) && (!in_array($type, $allowed_values))) {
            throw new \InvalidArgumentException("Invalid value for 'type', must be one of 'standard', 'express'");
        }
        $this->container['type'] = $type;

        return $this;
    }

    /**
     * Gets shopper.
     *
     * @return \zipMoney\Model\Shopper
     */
    public function getShopper()
    {
        return $this->container['shopper'];
    }

    /**
     * Sets shopper.
     *
     * @param \zipMoney\Model\Shopper $shopper
     *
     * @return $this
     */
    public function setShopper($shopper)
    {
        $this->container['shopper'] = $shopper;

        return $this;
    }

    /**
     * Gets order.
     *
     * @return \zipMoney\Model\CheckoutOrder
     */
    public function getOrder()
    {
        return $this->container['order'];
    }

    /**
     * Sets order.
     *
     * @param \zipMoney\Model\CheckoutOrder $order
     *
     * @return $this
     */
    public function setOrder($order)
    {
        $this->container['order'] = $order;

        return $this;
    }

    /**
     * Gets features.
     *
     * @return \zipMoney\Model\CreateCheckoutRequestFeatures
     */
    public function getFeatures()
    {
        return $this->container['features'];
    }

    /**
     * Sets features.
     *
     * @param \zipMoney\Model\CreateCheckoutRequestFeatures $features
     *
     * @return $this
     */
    public function setFeatures($features)
    {
        $this->container['features'] = $features;

        return $this;
    }

    /**
     * Gets metadata.
     *
     * @return \zipMoney\Model\Metadata
     */
    public function getMetadata()
    {
        return $this->container['metadata'];
    }

    /**
     * Sets metadata.
     *
     * @param \zipMoney\Model\Metadata $metadata
     *
     * @return $this
     */
    public function setMetadata($metadata)
    {
        $this->container['metadata'] = $metadata;

        return $this;
    }

    /**
     * Gets config.
     *
     * @return \zipMoney\Model\CheckoutConfiguration
     */
    public function getConfig()
    {
        return $this->container['config'];
    }

    /**
     * Sets config.
     *
     * @param \zipMoney\Model\CheckoutConfiguration $config
     *
     * @return $this
     */
    public function setConfig($config)
    {
        $this->container['config'] = $config;

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
