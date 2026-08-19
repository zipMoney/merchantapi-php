<?php

declare(strict_types=1);

/**
 * CaptureChargeRequest.
 *
 * @category Class
 * @package  zipMoney
 * @author   zipMoney Payments Pty Ltd
 * @link     https://github.com/zipMoney/merchantapi-php
 */

namespace zipMoney\Model;

use ArrayAccess;
use zipMoney\ObjectSerializer;

class CaptureChargeRequest implements ArrayAccess, \Stringable
{
    public const DISCRIMINATOR = 'subclass';

    /**
     * The original name of the model.
     *
     * @var string
     */
    protected static $swaggerModelName = 'CaptureChargeRequest';

    /**
     * Array of property to type mappings. Used for (de)serialization.
     *
     * @var string[]
     */
    protected static $zipTypes = [
        'amount' => 'float',
        'is_partial_capture' => 'boolean',
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
        'amount' => 'amount',
        'is_partial_capture' => 'is_partial_capture',
    ];

    /**
     * Array of attributes to setter functions (for deserialization of responses).
     *
     * @var string[]
     */
    protected static $setters = [
        'amount' => 'setAmount',
        'is_partial_capture' => 'setCaptureIsPartial',
    ];

    /**
     * Array of attributes to getter functions (for serialization of requests).
     *
     * @var string[]
     */
    protected static $getters = [
        'amount' => 'getAmount',
        'is_partial_capture' => 'getCaptureIsPartial',
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
        $this->container['amount'] = $data['amount'] ?? null;
        $this->container['is_partial_capture'] = $data['is_partial_capture'] ?? false;
    }

    /**
     * show all the invalid properties with reasons.
     *
     * @return array invalid properties with reasons
     */
    public function listInvalidProperties(): array
    {
        $invalid_properties = [];

        if ($this->container['amount'] === null) {
            $invalid_properties[] = "'amount' can't be null";
        }
        if (($this->container['amount'] < 0)) {
            $invalid_properties[] = "invalid value for 'amount', must be bigger than or equal to 0.";
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
        if ($this->container['amount'] === null) {
            return false;
        }
        return $this->container['amount'] >= 0;
    }

    /**
     * Gets is_partial_capture.
     *
     * @return bool
     */
    public function getCaptureIsPartial()
    {
        return $this->container['is_partial_capture'];
    }

    /**
     * Sets is_partial_capture.
     *
     * Tells Zip that this capture is for part of the authorised amount rather
     * than all of it, so the rest is not released. Defaults to false, which is
     * the previous behaviour for callers that never set it.
     *
     * @param bool $isCapturePartial
     *
     * @return $this
     */
    public function setCaptureIsPartial($isCapturePartial): static
    {
        $this->container['is_partial_capture'] = $isCapturePartial;

        return $this;
    }

    /**
     * Gets amount.
     *
     * @return float
     */
    public function getAmount()
    {
        return $this->container['amount'];
    }

    /**
     * Sets amount.
     *
     * @param float $amount Amount can be less than or equal to the previously authorised amount
     *
     * @return $this
     */
    public function setAmount($amount): static
    {
        if (($amount < 0)) {
            throw new \InvalidArgumentException('invalid value for $amount when calling CaptureChargeRequest., must be bigger than or equal to 0.');
        }

        $this->container['amount'] = $amount;

        return $this;
    }

    /**
     * Returns true if offset exists. False otherwise.
     *
     * @param int $offset Offset
     */
    public function offsetExists($offset): bool
    {
        return isset($this->container[$offset]);
    }

    /**
     * Gets offset.
     *
     * @param int $offset Offset
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
    public function offsetSet($offset, mixed $value): void
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
     */
    public function __toString(): string
    {
        if (defined('JSON_PRETTY_PRINT')) { // use JSON pretty print
            return (string) json_encode(ObjectSerializer::sanitizeForSerialization($this), JSON_PRETTY_PRINT);
        }

        return (string) json_encode(ObjectSerializer::sanitizeForSerialization($this));
    }
}
