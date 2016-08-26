<?php
/**
 * Created by PhpStorm.
 * User: waiting
 * Date: 2016/8/25
 * Time: 16:54
 */
namespace EsHelper\Contracts\Base;

interface Bootable
{
    public static function boot($config);
}