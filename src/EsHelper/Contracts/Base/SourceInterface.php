<?php
/**
 * Created by PhpStorm.
 * User: waiting
 * Date: 2016/8/30
 * Time: 17:20
 */
namespace EsHelper\Contracts\Base;

interface SourceInterface
{

    /**
     * 插入文档
     * @param $data
     * @return array
     */
    public function insert($data);



    /**
     * 删除文档
     * @param $params
     * @return array
     */
    public function update($params);

    
    /**
     * 删除文档
     * @param $params
     */
    public function delete($params);

}