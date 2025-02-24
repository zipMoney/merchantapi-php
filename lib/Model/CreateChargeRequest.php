<?php
declare(strict_types=1);

/**
 * CreateChargeRequest.
 *
 * @category Class
 * @package  zipMoney
 * @author   zipMoney Payments Pty Ltd
 * @link     https://github.com/zipMoney/merchantapi-php
 */

namespace zipMoney\Model;

use ArrayAccess;

class CreateChargeRequest implements ArrayAccess
{
    public const DISCRIMINATOR = 'subclass';

    /**
     * The original name of the model.
     *
     * @var string
     */
    protected static $swaggerModelName = 'CreateChargeRequest';

    /**
     * Array of property to type mappings. Used for (de)serialization.
     *
     * @var string[]
     */
    protected static $zipTypes = [
        'authority' => '\zipMoney\Model\Authority',
        'reference' => 'string',
        'amount'    => 'float',
        'currency'  => 'string',
        'capture'   => 'bool',
        'order'     => '\zipMoney\Model\ChargeOrder',
        'metadata'  => 'object',
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
        'authority' => 'authority',
        'reference' => 'reference',
        'amount'    => 'amount',
        'currency'  => 'currency',
        'capture'   => 'capture',
        'order'     => 'order',
        'metadata'  => 'metadata',
    ];

    /**
     * Array of attributes to setter functions (for deserialization of responses).
     *
     * @var string[]
     */
    protected static $setters = [
        'authority' => 'setAuthority',
        'reference' => 'setReference',
        'amount'    => 'setAmount',
        'currency'  => 'setCurrency',
        'capture'   => 'setCapture',
        'order'     => 'setOrder',
        'metadata'  => 'setMetadata',
    ];

    /**
     * Array of attributes to getter functions (for serialization of requests).
     *
     * @var string[]
     */
    protected static $getters = [
        'authority' => 'getAuthority',
        'reference' => 'getReference',
        'amount'    => 'getAmount',
        'currency'  => 'getCurrency',
        'capture'   => 'getCapture',
        'order'     => 'getOrder',
        'metadata'  => 'getMetadata',
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
    public function __construct(array $data = null)
    {
        $this->container['authority'] = isset($data['authority']) ? $data['authority'] : null;
        $this->container['reference'] = isset($data['reference']) ? $data['reference'] : null;
        $this->container['amount'] = isset($data['amount']) ? $data['amount'] : null;
        $this->container['currency'] = isset($data['currency']) ? $data['currency'] : null;
        $this->container['capture'] = isset($data['capture']) ? $data['capture'] : true;
        $this->container['order'] = isset($data['order']) ? $data['order'] : null;
        $this->container['metadata'] = isset($data['metadata']) ? $data['metadata'] : null;
    }

    /**
     * show all the invalid properties with reasons.
     *
     * @return array invalid properties with reasons
     */
    public function listInvalidProperties()
    {
        $invalid_properties = [];

        if ($this->container['authority'] === null) {
            $invalid_properties[] = "'authority' can't be null";
        }
        if ($this->container['amount'] === null) {
            $invalid_properties[] = "'amount' can't be null";
        }
        if ($this->container['currency'] === null) {
            $invalid_properties[] = "'currency' can't be null";
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
        if ($this->container['authority'] === null) {
            return false;
        }
        if ($this->container['amount'] === null) {
            return false;
        }
        if ($this->container['currency'] === null) {
            return false;
        }

        return true;
    }

    /**
     * Gets authority.
     *
     * @return \zipMoney\Model\Authority
     */
    public function getAuthority()
    {
        return $this->container['authority'];
    }

    /**
     * Sets authority.
     *
     * @param \zipMoney\Model\Authority $authority
     *
     * @return $this
     */
    public function setAuthority($authority)
    {
        $this->container['authority'] = $authority;

        return $this;
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
     * @param string $reference The reference for this charge (unique payment reference in your store)
     *
     * @return $this
     */
    public function setReference($reference)
    {
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
     * @param float $amount The amount of the charge
     *
     * @return $this
     */
    public function setAmount($amount)
    {
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
     * @param string $currency The currency
     *
     * @return $this
     */
    public function setCurrency($currency)
    {
        $this->container['currency'] = $currency;

        return $this;
    }

    /**
     * Gets capture.
     *
     * @return bool
     */
    public function getCapture()
    {
        return $this->container['capture'];
    }

    /**
     * Sets capture.
     *
     * @param bool $capture If true this will be a direct capture, pass false to perform an authorisation only
     *
     * @return $this
     */
    public function setCapture($capture)
    {
        $this->container['capture'] = $capture;

        return $this;
    }

    /**
     * Gets order.
     *
     * @return \zipMoney\Model\ChargeOrder
     */
    public function getOrder()
    {
        return $this->container['order'];
    }

    /**
     * Sets order.
     *
     * @param \zipMoney\Model\ChargeOrder $order
     *
     * @return $this
     */
    public function setOrder($order)
    {
        $this->container['order'] = $order;

        return $this;
    }

    /**
     * Gets metadata.
     *
     * @return object
     */
    public function getMetadata()
    {
        return $this->container['metadata'];
    }

    /**
     * Sets metadata.
     *
     * @param object $metadata
     *
     * @return $this
     */
    public function setMetadata($metadata)
    {
        $this->container['metadata'] = $metadata;

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
