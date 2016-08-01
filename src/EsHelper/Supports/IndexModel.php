<?php
/**
 * Created by PhpStorm.
 * User: waiting
 * Date: 2016/8/1
 * Time: 18:14
 */
namespace EsHelper\Supports;

abstract class IndexModel
{
    protected $name;


    public function getType()
    {
        return $this->name;
    }

    abstract public function getData();
}