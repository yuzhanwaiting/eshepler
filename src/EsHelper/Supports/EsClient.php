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
    
    protected $indexReposity;

    protected $indexManagement;

    protected $query;

    /**
     * 构造函数
     * EsClient constructor.
     * @param $config
     */
    public function __construct($host, $indexConfig)
    {
        $this->client = $this->setClient($host);

        //初始化索引配置
        $this->initIndex($indexConfig);
    }

    /**
     * 初始化索引
     * @param $indexConfig
     */
    private function initIndex($indexConfig)
    {
        //初始化仓库
        $this->indexReposity = new IndexReposity($indexConfig);
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
     * 初始化索引管理
     * @return IndexManagement
     */
    public function getIndexManagenemnt()
    {
        $this->indexManagement = new IndexManagement($this->client, $this->indexReposity);
        return $this->indexManagement;
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

}