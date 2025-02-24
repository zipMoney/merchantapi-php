<?php
declare(strict_types=1);

/**
 * ObjectSerializer.
 *
 * @category Class
 * @package  zipMoney
 * @author   zipMoney Payments Pty Ltd
 * @link     https://github.com/zipMoney/merchantapi-php
 */

namespace zipMoney;

/**
 * ObjectSerializer Class Doc Comment.
 *
 * @category Class
 *
 * @see     https://github.com/zipMoney/merchantapi-php
 */
class ObjectSerializer
{
    /**
     * Serialize data.
     *
     * @param mixed $data the data to serialize
     *
     * @return object|string serialized form of $data
     */
    public static function sanitizeForSerialization($data)
    {
        if (is_scalar($data) || null === $data) {
            return $data;
        }
        if ($data instanceof \DateTime) {
            return $data->format(\DateTime::ATOM);
        }
        if (is_array($data)) {
            foreach ($data as $property => $value) {
                $data[$property] = self::sanitizeForSerialization($value);
            }

            return $data;
        }
        if (is_object($data)) {
            $attr = $data::attributeMap();
            $values = [];
            foreach (array_keys($data::zipTypes()) as $property) {
                $getterArr = $data::getters();
                $getter = $getterArr[$property];
                if (method_exists(get_class($data), $getter) && $data->{$getter}() !== null) {
                    $values[$attr[$property]] = self::sanitizeForSerialization($data->{$getter}());
                }
                if (method_exists(get_class($data), 'get') && $data->get($property) !== null) {
                    $values[$attr[$property]] = self::sanitizeForSerialization($data->get($property));
                }
            }

            return (object) $values;
        }

        return (string) $data;
    }

    /**
     * Sanitize filename by removing path.
     * e.g. ../../sun.gif becomes sun.gif.
     *
     * @param string $filename filename to be sanitized
     *
     * @return string the sanitized filename
     */
    public function sanitizeFilename($filename)
    {
        if (preg_match('/.*[\\/\\\\](.*)$/', $filename, $match)) {
            return $match[1];
        }

        return $filename;
    }

    /**
     * Take value and turn it into a string suitable for inclusion in
     * the path, by url-encoding.
     *
     * @param string $value a string which will be part of the path
     *
     * @return string the serialized object
     */
    public function toPathValue($value)
    {
        return rawurlencode($this->toString($value));
    }

    /**
     * Take value and turn it into a string suitable for inclusion in
     * the query, by imploding comma-separated if it's an object.
     * If it's a string, pass through unchanged. It will be url-encoded
     * later.
     *
     * @param \DateTime|string|string[] $object an object to be serialized to a string
     *
     * @return string the serialized object
     */
    public function toQueryValue($object)
    {
        if (is_array($object)) {
            return implode(',', $object);
        }

        return $this->toString($object);
    }

    /**
     * Take value and turn it into a string suitable for inclusion in
     * the header. If it's a string, pass through unchanged
     * If it's a datetime object, format it in ISO8601.
     *
     * @param string $value a string which will be part of the header
     *
     * @return string the header string
     */
    public function toHeaderValue($value)
    {
        return $this->toString($value);
    }

    /**
     * Take value and turn it into a string suitable for inclusion in
     * the http body (form parameter). If it's a string, pass through unchanged
     * If it's a datetime object, format it in ISO8601.
     *
     * @param \SplFileObject|string $value the value of the form parameter
     *
     * @return string the form string
     */
    public function toFormValue($value)
    {
        if ($value instanceof \SplFileObject) {
            return $value->getRealPath();
        }

        return $this->toString($value);
    }

    /**
     * Take value and turn it into a string suitable for inclusion in
     * the parameter. If it's a string, pass through unchanged
     * If it's a datetime object, format it in ISO8601.
     *
     * @param \DateTime|string $value the value of the parameter
     *
     * @return string the header string
     */
    public function toString($value)
    {
        if ($value instanceof \DateTime) { // datetime in ISO8601 format
            return $value->format(\DateTime::ATOM);
        }

        return $value;
    }

    /**
     * Serialize an array to a string.
     *
     * @param array  $collection                 collection to serialize to a string
     * @param string $collectionFormat           the format use for serialization (csv,
     *                                           ssv, tsv, pipes, multi)
     * @param bool   $allowCollectionFormatMulti allow collection format to be a multidimensional array
     *
     * @return string
     */
    public function serializeCollection(array $collection, $collectionFormat, $allowCollectionFormatMulti = false)
    {
        if ($allowCollectionFormatMulti && ('multi' === $collectionFormat)) {
            // http_build_query() almost does the job for us. We just
            // need to fix the result of multidimensional arrays.
            return preg_replace('/%5B[0-9]+%5D=/', '=', http_build_query($collection, '', '&'));
        }
        switch ($collectionFormat) {
            case 'pipes':
                return implode('|', $collection);
            case 'tsv':
                return implode("\t", $collection);
            case 'ssv':
                return implode(' ', $collection);
            case 'csv':
                // Deliberate fall through. CSV is default format.
            default:
                return implode(',', $collection);
        }
    }

    /**
     * Deserialize a JSON string into an object.
     *
     * @param mixed    $data          object or primitive to be deserialized
     * @param string   $class         class name is passed as a string
     * @param string[] $httpHeaders   HTTP headers
     * @param string   $discriminator discriminator if polymorphism is used
     *
     * @return null|array|object an single or an array of $class instances
     */
    public static function deserialize($data, $class, $httpHeaders = null)
    {
        if (null === $data) {
            return null;
        }
        if (substr($class, 0, 4) === 'map[') { // for associative array e.g. map[string,int]
            $inner = substr($class, 4, -1);
            $deserialized = [];
            if (strrpos($inner, ',') !== false) {
                $subClass_array = explode(',', $inner, 2);
                $subClass = $subClass_array[1];
                foreach ($data as $key => $value) {
                    $deserialized[$key] = self::deserialize($value, $subClass, null);
                }
            }

            return $deserialized;
        }
        if (strcasecmp(substr($class, -2), '[]') === 0) {
            $subClass = substr($class, 0, -2);
            $values = [];
            foreach ($data as $key => $value) {
                $values[] = self::deserialize($value, $subClass, null);
            }

            return $values;
        }
        if ($class === 'object') {
            settype($data, 'array');

            return $data;
        }
        if ($class === '\DateTime') {
            // Some API's return an invalid, empty string as a
            // date-time property. DateTime::__construct() will return
            // the current time for empty input which is probably not
            // what is meant. The invalid empty string is probably to
            // be interpreted as a missing field/value. Let's handle
            // this graceful.
            if (!empty($data)) {
                return new \DateTime($data);
            }

            return null;
        } elseif (in_array($class, ['DateTime', 'bool', 'boolean', 'byte', 'double', 'float', 'int', 'integer', 'mixed', 'number', 'object', 'string', 'void'], true)) {
            settype($data, $class);

            return $data;
        } elseif ($class === '\SplFileObject') {
            // determine file name
            if (array_key_exists('Content-Disposition', $httpHeaders) &&
                preg_match('/inline; filename=[\'"]?([^\'"\s]+)[\'"]?$/i', $httpHeaders['Content-Disposition'], $match)) {
                $filename = Configuration::getDefaultConfiguration()->getTempFolderPath() . sanitizeFilename($match[1]);
            } else {
                $filename = tempnam(Configuration::getDefaultConfiguration()->getTempFolderPath(), '');
            }

            return new \SplFileObject($filename, 'w');
        }
        // If a discriminator is defined and points to a valid subclass, use it.
        $discriminator = $class::DISCRIMINATOR;
        if (!empty($discriminator) && isset($data->{$discriminator}) && is_string($data->{$discriminator})) {
            $subclass = '\zipMoney\Model\\' . $data->{$discriminator};
            if (is_subclass_of($subclass, $class)) {
                $class = $subclass;
            }
        }
        $instance = new $class();
        foreach ($instance::zipTypes() as $property => $type) {
            $propertySetters = $instance::setters();
            $propertySetter = $propertySetters[$property];

            $attr = $instance::attributeMap();

            if (!isset($propertySetter) || !isset($data->{$attr[$property]})) {
                continue;
            }

            $propertyValue = $data->{$attr[$property]};

            if (isset($propertyValue)) {
                $instance->{$propertySetter}(self::deserialize($propertyValue, $type, null));
            }
        }

        return $instance;
    }
}
