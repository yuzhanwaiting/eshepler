<?php
/**
 * Created by PhpStorm.
 * User: waiting
 * Date: 2016/8/5
 * Time: 9:59
 */
namespace EsHelper\Supports\Index;

use EsHelper\Supports\Client\Client;

class IndexReposity
{
    protected $indices = [];

    public function __construct($indexConfig)
    {
        $this->initReposity($indexConfig);
    }


    /**
     * 初始化仓库配置
     * @param $indexConfig
     */
    public function initReposity($indexConfig)
    {
        foreach ($indexConfig as $key => $val) {
            $this->addReposity($key, $val);
        }
    }

    /**
     * 将索引添加至仓库
     * @param $className
     */
    public function addReposity($name, $className)
    {
        $this->indices[$name] = $className;
    }

    /**
     * 获取所有索引
     * @param $name
     * @return array|bool|mixed
     */
    public function getIndex($name)
    {
        if (is_string($name)) {
            if(isset($this->indices[$name])) {
                return $this->indices[$name];
            } else {
                return false;
            }
        } else {
            return $this->indices;
        }

    }

}