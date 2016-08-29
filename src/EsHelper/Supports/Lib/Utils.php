<?php
/**
 * Created by PhpStorm.
 * User: waiting
 * Date: 2016/8/29
 * Time: 11:16
 */
namespace EsHelper\Supports\Lib;


class Utils
{


    /**
     * json格式化输出
     * @param array $array
     */
    public static function jsonExit(array $array)
    {
        echo json_encode($array);
        exit;
    }




}