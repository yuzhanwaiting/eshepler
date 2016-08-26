<?php
/**
 * Created by PhpStorm.
 * User: waiting
 * Date: 2016/8/1
 * Time: 9:22
 */
namespace EsHelper\Supports;

use Elasticsearch\ClientBuilder;
use EsHelper\Supports\Client\Client;
use EsHelper\Supports\Index\IndexManagement;
use EsHelper\Supports\Index\IndexReposity;
use EsHelper\Supports\Index\Query;

class EsClient
{

    private $client;
    
    protected $searchEngine;

    protected $indexEngine;

    protected $sourceEngine;

    /**
     * 构造函数
     * EsClient constructor.
     * @param $config
     */
    public function __construct($host)
    {
        $this->client = $this->setClient($host);
    }

    /**
     * 构建客户端
     * @param $host
     * @return \Elasticsearch\Client
     */
    private function setClient($host)
    {
        return new Client(ClientBuilder::create()->setHosts($host)->build());
    }


    /**
     * 搜索方法
     * @return Query
     */
    public function getQuery()
    {
        $this->query = new Query($this->client);
        return $this->query;
    }


    /**
     * 获得对应的引擎
     */
    public function getEngine($name)
    {
        $methodName = sprintf("get%sEngine", ucfirst(strtolower($name)));
        return call_user_func([$this, $methodName]);
    }

    public function getSearchEngine()
    {
        return $this->searchEngine = new Query($this->client);
    }


    public function getIndexEngine()
    {
        return $this->indexEngine = new IndexManagement($this->client);
    }

    public function getSourceEngine()
    {
        
    }

}