<?php
/**
 * Created by PhpStorm.
 * User: waiting
 * Date: 2016/8/30
 * Time: 17:16
 */
namespace EsHelper\Contracts\Base;

interface IndexInterface
{
    /**
     * 创建索引
     * @param $name
     * @return mixed
     */
    public function createIndex($name);


    /**
     * 更新索引
     * @return mixed
     */
    public function updateIndex();


    /**
     * 判断索引是否存在
     * @param $name
     * @return mixed
     */
    public function existsIndex($name);


    /**
     * 删除索引
     * @param $name
     * @return mixed
     */
    public function deleteIndex($name);
}