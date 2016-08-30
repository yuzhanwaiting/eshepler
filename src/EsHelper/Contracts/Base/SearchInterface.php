<?php
/**
 * Created by PhpStorm.
 * User: waiting
 * Date: 2016/8/30
 * Time: 17:18
 */
namespace EsHelper\Contracts\Base;

interface SearchInterface
{
    /**
     * 搜索方法
     * @param $params
     * @return mixed
     */
    public function search($params);
}