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



    public function config($config)
    {
        foreach($config as $key => $val) {
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
        $className = $this->container[$name];
        $class = new $className;

        return $class->getSetting();
    }

    public static function boot($config = null)
    {
        Application::$app->register("client.reposity", IndexReposity::class);
    }



}