<?php
/**
 * Created by PhpStorm.
 * User: waiting
 * Date: 2016/8/24
 * Time: 8:48
 */
namespace EsHelper\Supports\Base;

class Object
{
    public function __set($name, $value)
    {
        $setter = "set".$name;

        if (method_exists($this, $setter)) {
            return $this->$setter($value);
        } else {
            throw new \Exception("非法设置属性$name");
        }
    }

    public function __get($name)
    {
        $getter = "get".$name;

        if (method_exists($this, $getter)) {
            return $this->$getter();
        } else {
            throw new \Exception("非法调用属性$name");
        }
    }
}