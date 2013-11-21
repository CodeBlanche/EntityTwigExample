<?php

namespace EntityTwigExample\Entity;

use Entity\Converter\Dump;
use Entity\Marshal\Abstraction\MarshalInterface;
use Entity\Marshal\Typed;

class Entity extends \Entity\Entity implements \ArrayAccess
{
    /**
     * @var MarshalInterface Default marshal instance (shared with all entities)
     */
    private static $defaultMarshal;

    /**
     * (PHP 5 &gt;= 5.0.0)<br/>
     * Whether a offset exists
     *
     * @link http://php.net/manual/en/arrayaccess.offsetexists.php
     *
     * @param mixed $offset <p>
     *                      An offset to check for.
     *                      </p>
     *
     * @return boolean true on success or false on failure.
     * </p>
     * <p>
     * The return value will be casted to boolean if non-boolean was returned.
     */
    public function offsetExists($offset)
    {
        return isset($this->$offset);
    }

    /**
     * (PHP 5 &gt;= 5.0.0)<br/>
     * Offset to retrieve
     *
     * @link http://php.net/manual/en/arrayaccess.offsetget.php
     *
     * @param mixed $offset <p>
     *                      The offset to retrieve.
     *                      </p>
     *
     * @return mixed Can return all value types.
     */
    public function offsetGet($offset)
    {
        return $this->$offset;
    }

    /**
     * (PHP 5 &gt;= 5.0.0)<br/>
     * Offset to set
     *
     * @link http://php.net/manual/en/arrayaccess.offsetset.php
     *
     * @param mixed $offset <p>
     *                      The offset to assign the value to.
     *                      </p>
     * @param mixed $value  <p>
     *                      The value to set.
     *                      </p>
     *
     * @return void
     */
    public function offsetSet($offset, $value)
    {
        $this->$offset = $value;
    }

    /**
     * (PHP 5 &gt;= 5.0.0)<br/>
     * Offset to unset
     *
     * @link http://php.net/manual/en/arrayaccess.offsetunset.php
     *
     * @param mixed $offset <p>
     *                      The offset to unset.
     *                      </p>
     *
     * @return void
     */
    public function offsetUnset($offset)
    {
        unset($this->$offset);
    }

    /**
     * @return MarshalInterface
     */
    protected function defaultMarshal()
    {
        if (is_null(self::$defaultMarshal)) {
            self::$defaultMarshal = new Typed();
        }

        return self::$defaultMarshal;
    }

    /**
     * @param string $name
     *
     * @return bool
     */
    public function __isset($name)
    {
        $isSet = parent::__isset($name);
        $type  = $this->typeof($name);

        if ($isSet === false && class_exists($type)) {
            return true;
        }

        return $isSet;
    }

    /**
     * @param string $name
     *
     * @return mixed
     */
    public function &get($name)
    {
        $value = parent::get($name);
        $type  = $this->typeof($name);

        if (is_null($value) && class_exists($type)) {
            $value = new $type();
        }

        return $value;
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return $this->convert(new Dump());
    }
}
