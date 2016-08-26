<?php
/**
 * Created by PhpStorm.
 * User: waiting
 * Date: 2016/8/26
 * Time: 9:56
 */
namespace EsHelper\Supports\Base;

class Container extends Object implements \ArrayAccess
{

    public static $instances = [];

    public function make($name)
    {
        if (! isset(self::$instances[$name] )) {
            throw new \Exception("未找到class $name");
        }
        return self::$instances[$name];
    }

    public function register($name, $class, $config = null)
    {
        try {
            self::$instances[$name] = new $class($config);
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage());
        }
    }

    public function registerBoot($name, $class, $config = null)
    {
        try {
            $class::boot($config);
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage());
        }
    }

    public function offsetExists($offset)
    {
        return isset(self::$instances[$offset]);
    }



    /**
     * @param mixed $offset
     * @return mixed|null
     */
    public function offsetGet($offset)
    {
        if (! $this->offsetExists($offset))
            throw new \Exception("$offset 未定义,请检查");

        return self::$instances[$offset];
    }


    /**
     * @param mixed $offset
     * @param mixed $value
     * @throws \Exception
     */
    public function offsetSet($offset, $value)
    {
        throw new \Exception("未定的方法");
    }



    /**
     * @param mixed $offset
     */
    public function offsetUnset($offset)
    {
        self::$instances[$offset];

        unset($this->container[$offset]);
    }
}