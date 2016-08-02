<?php
/**
 * Created by PhpStorm.
 * User: waiting
 * Date: 2016/8/1
 * Time: 9:01
 */
namespace EsHelper;

use EsHelper\Supports\EsClient;
use EsHelper\Supports\IndexConfig;

class Client
{
    protected $indices = [];

    protected $client = null;



    function __construct($host)
    {
        $this->initClient($host);
    }


    /**
     * 初始化客户端
     * @param $host
     */
    private function initClient($host)
    {
        $this->client = EsClient::getInstance($host);
    }


    public function search($index, $key, $query,  $sort = null)
    {
        return $this->client->search($index,$key , $query, $sort);
    }


    /**
     * 生成索引文件
     * @param $config
     */
    public function initIndices($config)
    {
        $this->parseConfig($config);
        return $this;
    }

    /**
     * 生成索引
     */
    public function run()
    {
        foreach($this->indices as $key => $indexObj)
        {
            $this->client->setAll($indexObj);
        }
    }

    /**
     * 处理配置文件
     * @param $config
     */
    private function parseConfig($config)
    {
        foreach($config as $key => $val) {
            $this->makeIndex($key, $val);
        }
    }

    /**
     * 生成索引
     * @param $index
     * @param $type
     * @return mixed
     */
    private function makeIndex($index, $params)
    {
        if (!$this->indices[$index])
            $this->indices[$index] = new IndexConfig($index, $params);

        return $this->indices[$index];
    }




    
}