<?php
/**
 * Created by PhpStorm.
 * User: waiting
 * Date: 2016/8/2
 * Time: 16:25
 */
namespace EsHelper\Contracts\Index;

interface Source
{
    /**
     * 索引数据源配置
     * @return mixed
     */
    public function get();
}