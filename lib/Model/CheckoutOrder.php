<?php

declare(strict_types=1);

/**
 * CheckoutOrder.
 *
 * @category Class
 * @package  zipMoney
 * @author   zipMoney Payments Pty Ltd
 * @link     https://github.com/zipMoney/merchantapi-php
 */

namespace zipMoney\Model;

use ArrayAccess;
use zipMoney\ObjectSerializer;

class CheckoutOrder implements ArrayAccess, \Stringable
{
    public const DISCRIMINATOR = 'subclass';

    /**
     * The original name of the model.
     *
     * @var string
     */
    protected static $swaggerModelName = 'CheckoutOrder';

    /**
     * Array of property to type mappings. Used for (de)serialization.
     *
     * @var string[]
     */
    protected static $zipTypes = [
        'reference'      => 'string',
        'amount'         => 'float',
        'currency'       => 'string',
        'shipping'       => '\zipMoney\Model\OrderShipping',
        'items'          => '\zipMoney\Model\OrderItem[]',
        'cart_reference' => 'string',
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
        'reference'      => 'reference',
        'amount'         => 'amount',
        'currency'       => 'currency',
        'shipping'       => 'shipping',
        'items'          => 'items',
        'cart_reference' => 'cart_reference',
    ];

    /**
     * Array of attributes to setter functions (for deserialization of responses).
     *
     * @var string[]
     */
    protected static $setters = [
        'reference'      => 'setReference',
        'amount'         => 'setAmount',
        'currency'       => 'setCurrency',
        'shipping'       => 'setShipping',
        'items'          => 'setItems',
        'cart_reference' => 'setCartReference',
    ];

    /**
     * Array of attributes to getter functions (for serialization of requests).
     *
     * @var string[]
     */
    protected static $getters = [
        'reference'      => 'getReference',
        'amount'         => 'getAmount',
        'currency'       => 'getCurrency',
        'shipping'       => 'getShipping',
        'items'          => 'getItems',
        'cart_reference' => 'getCartReference',
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
        $this->container['reference'] = $data['reference'] ?? null;
        $this->container['amount'] = $data['amount'] ?? null;
        $this->container['currency'] = $data['currency'] ?? null;
        $this->container['shipping'] = $data['shipping'] ?? null;
        $this->container['items'] = $data['items'] ?? null;
        $this->container['cart_reference'] = $data['cart_reference'] ?? null;
    }

    /**
     * show all the invalid properties with reasons.
     *
     * @return array invalid properties with reasons
     */
    public function listInvalidProperties(): array
    {
        $invalid_properties = [];

        if (!is_null($this->container['reference']) && (strlen((string) $this->container['reference']) > 200)) {
            $invalid_properties[] = "invalid value for 'reference', the character length must be smaller than or equal to 200.";
        }

        if ($this->container['amount'] === null) {
            $invalid_properties[] = "'amount' can't be null";
        }
        if (($this->container['amount'] < 0)) {
            $invalid_properties[] = "invalid value for 'amount', must be bigger than or equal to 0.";
        }

        if ($this->container['currency'] === null) {
            $invalid_properties[] = "'currency' can't be null";
        }
        if ($this->container['shipping'] === null) {
            $invalid_properties[] = "'shipping' can't be null";
        }
        if (!is_null($this->container['cart_reference']) && (strlen((string) $this->container['cart_reference']) > 200)) {
            $invalid_properties[] = "invalid value for 'cart_reference', the character length must be smaller than or equal to 200.";
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
        if (strlen((string) $this->container['reference']) > 200) {
            return false;
        }
        if ($this->container['amount'] === null) {
            return false;
        }
        if ($this->container['amount'] < 0) {
            return false;
        }
        if ($this->container['currency'] === null) {
            return false;
        }
        if ($this->container['shipping'] === null) {
            return false;
        }
        return strlen((string) $this->container['cart_reference']) <= 200;
    }

    /**
     * Gets reference.
     *
     * @return string
     */
    public function getReference()
    {
        return $this->container['reference'];
    }

    /**
     * Sets reference.
     *
     * @param string $reference The order id in the eCommerce system
     *
     * @return $this
     */
    public function setReference($reference): static
    {
        if (!is_null($reference) && (strlen((string) $reference) > 200)) {
            throw new \InvalidArgumentException('invalid length for $reference when calling CheckoutOrder., must be smaller than or equal to 200.');
        }

        $this->container['reference'] = $reference;

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
     * @param float $amount The total amount of the order
     *
     * @return $this
     */
    public function setAmount($amount): static
    {
        if (($amount < 0)) {
            throw new \InvalidArgumentException('invalid value for $amount when calling CheckoutOrder., must be bigger than or equal to 0.');
        }

        $this->container['amount'] = $amount;

        return $this;
    }

    /**
     * Gets currency.
     *
     * @return string
     */
    public function getCurrency()
    {
        return $this->container['currency'];
    }

    /**
     * Sets currency.
     *
     * @param string $currency The ISO-4217 currency code. See https://en.wikipedia.org/wiki/ISO_4217
     *
     * @return $this
     */
    public function setCurrency($currency): static
    {
        $this->container['currency'] = $currency;

        return $this;
    }

    /**
     * Gets shipping.
     *
     * @return OrderShipping
     */
    public function getShipping()
    {
        return $this->container['shipping'];
    }

    /**
     * Sets shipping.
     *
     * @param OrderShipping $shipping
     *
     * @return $this
     */
    public function setShipping($shipping): static
    {
        $this->container['shipping'] = $shipping;

        return $this;
    }

    /**
     * Gets items.
     *
     * @return OrderItem[]
     */
    public function getItems()
    {
        return $this->container['items'];
    }

    /**
     * Sets items.
     *
     * @param OrderItem[] $items The order item breakdown
     *
     * @return $this
     */
    public function setItems($items): static
    {
        $this->container['items'] = $items;

        return $this;
    }

    /**
     * Gets cart_reference.
     *
     * @return string
     */
    public function getCartReference()
    {
        return $this->container['cart_reference'];
    }

    /**
     * Sets cart_reference.
     *
     * @param string $cart_reference The shopping cart reference id
     *
     * @return $this
     */
    public function setCartReference($cart_reference): static
    {
        if (!is_null($cart_reference) && (strlen((string) $cart_reference) > 200)) {
            throw new \InvalidArgumentException('invalid length for $cart_reference when calling CheckoutOrder., must be smaller than or equal to 200.');
        }

        $this->container['cart_reference'] = $cart_reference;

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
