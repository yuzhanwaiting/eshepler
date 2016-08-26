<?php
/**
 * Created by PhpStorm.
 * User: waiting
 * Date: 2016/8/5
 * Time: 9:59
 */
namespace EsHelper\Supports\Index;


use EsHelper\Application;

class IndexReposity extends Application
{

    protected $container = [];

    protected $config;


    public function config($config)
    {
        foreach($this->config as $key => $val) {
            $this->addReposity($key, $val);
        }
    }
    
    /**
     * 将索引添加至仓库
     * @param $className
     */
    public function addReposity($name, $className)
    {
        $this->container[$name] = $className;
    }


    public function getIndexSetting($name)
    {
        $class = new $this->container[$name];

        return $class->getSetting();
    }

}