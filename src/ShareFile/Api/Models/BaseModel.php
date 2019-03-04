<?php

namespace Citrix\ShareFile\Api\Models;

use \ArrayAccess;
use Citrix\Contracts\Arrayable;

/**
 * Class BaseModel
 * @package src\ShareFile\Api\Models
 */
class BaseModel implements ArrayAccess, Arrayable
{

    /**
     * BaseModel constructor.
     * @param array $attributes
     */
    public function __construct($attributes = [])
    {
        $this->setAttributes($attributes);
    }

    /**
     * @param array $attributes
     *
     * @return $this
     */
    protected function setAttributes($attributes = [])
    {
        if (!empty($attributes))
            foreach ($attributes as $key => $value) {
                $method = 'set' . ucwords($key) . 'Attribute';
                if (method_exists($this, $method)) $this->$method($value);
                else $this->$key = $value;
            }
        return $this;
    }

    /**
     * @return string
     */
    public function toJson()
    {
        return \ait\guzzle\json_encode($this);
    }

    /**
     * @return array
     */
    public function toArray()
    {
        $array = get_object_vars($this);

        foreach ($array as &$value) {
            if (is_object($value)) {
                $value = $value->toArray();
            };
            if (is_array($value)) {
                foreach ($value as &$_value) {
                    if (is_object($_value)) {
                        $_value = $_value->toArray();
                    };
                }
            }
        }

        return $array;
    }

    /**
     * @param $name
     * @param $value
     * @return $this
     */
    public function __set($name, $value)
    {
        $method = 'set' . ucwords($name) . 'Attribute';

        if (method_exists($this, $method)) $this->$method($value);
        else $this->$name = $value;

        return $this;
    }

    /**
     * @param $name
     * @param $arguments
     * @return BaseModel
     */
    public function __call($name, $arguments)
    {
        if (strncmp('set', $name, 3) == 0) {
            $attr = str_replace('set', '', $name);
            if (property_exists($this, $attr)) {
                return $this->__set($attr, $arguments[0]);
            }
        }
    }

    /**
     * @param $name
     * @return mixed
     */
    public function __get($name)
    {
        if (method_exists($this, 'get' . ucfirst($name))) return call_user_func([$this, 'get' . ucfirst($name)]);
        return $this->$name;
    }

    /**
     * Whether a offset exists
     * @link  http://php.net/manual/en/arrayaccess.offsetexists.php
     *
     * @param mixed $offset <p>
     *                      An offset to check for.
     *                      </p>
     *
     * @return boolean true on success or false on failure.
     * </p>
     * <p>
     * The return value will be casted to boolean if non-boolean was returned.
     * @since 5.0.0
     */
    public function offsetExists($offset)
    {
        return property_exists($this, $offset);
    }

    /**
     * Offset to retrieve
     * @link  http://php.net/manual/en/arrayaccess.offsetget.php
     *
     * @param mixed $offset <p>
     *                      The offset to retrieve.
     *                      </p>
     *
     * @return mixed Can return all value types.
     * @since 5.0.0
     */
    public function offsetGet($offset)
    {
        return $this->$offset;
    }

    /**
     * Offset to set
     * @link  http://php.net/manual/en/arrayaccess.offsetset.php
     *
     * @param mixed $offset <p>
     *                      The offset to assign the value to.
     *                      </p>
     * @param mixed $value <p>
     *                      The value to set.
     *                      </p>
     *
     * @return void
     * @since 5.0.0
     */
    public function offsetSet($offset, $value)
    {
        $this->$offset = $value;
    }

    /**
     * Offset to unset
     * @link  http://php.net/manual/en/arrayaccess.offsetunset.php
     *
     * @param mixed $offset <p>
     *                      The offset to unset.
     *                      </p>
     *
     * @return void
     * @since 5.0.0
     */
    public function offsetUnset($offset)
    {
        unset($this->$offset);
    }

    /**
     * Specify data which should be serialized to JSON
     * @link  http://php.net/manual/en/jsonserializable.jsonserialize.php
     * @return mixed data which can be serialized by <b>json_encode</b>,
     * which is a value of any type other than a resource.
     * @since 5.4.0
     */
    function jsonSerialize()
    {
        return $this;
    }
}