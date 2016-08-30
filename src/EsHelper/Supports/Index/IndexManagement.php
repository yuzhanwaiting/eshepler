<?php
/**
 * Created by PhpStorm.
 * User: waiting
 * Date: 2016/8/2
 * Time: 16:24
 */
namespace EsHelper\Supports\Index;


use EsHelper\Application;

class IndexManagement extends Application
{

    /**
     * 创建索引
     * @param $name
     * @return mixed
     * @throws \Exception
     */
    public function create($name)
    {
        $setting = $this->make("client.reposity")->getIndexSetting($name);
        return $this->make("client")->createIndex($setting);
    }



    public function update($params)
    {
        //TODO:
        throw new \Exception("非法操作");
    }


    /**
     * 删除索引
     * @param $name
     * @return mixed
     * @throws \Exception
     */
    public function delete($name)
    {
        return $this->make("client")->deleteIndex($name);
    }


    
    /**
     * 检测索引是否存在
     * @param $name
     * @return mixed
     * @throws \Exception
     */
    public function exists($name)
    {
        return $this->make("client")->existsIndex($name);
    }


}