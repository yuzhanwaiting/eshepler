<?php
/**
 * Created by PhpStorm.
 * User: waiting
 * Date: 2016/8/1
 * Time: 9:22
 */
namespace EsHelper\Supports;

use Elasticsearch\ClientBuilder;

class EsClient
{


    private static $instance = null;


    private $client;


    /**
     * 构造函数
     * EsClient constructor.
     * @param $config
     */
    private function __construct($config)
    {
        $this->client = $this->setClient($config);
    }

    /**
     * 构建客户端
     * @param $host
     * @return \Elasticsearch\Client
     */
    private function setClient($host)
    {
        return ClientBuilder::create()->setHosts($host)->build();
    }


    /**
     * 设置所有配置
     * @param IndexConfig $indexObj
     */
    public function setAll(IndexConfig $indexObj)
    {
        (new IndexSetting($indexObj, $this->client))->run();
    }


    public function deleteIndex($index, $id)
    {
        $params = array_merge(array_combine(["index","type"], $index), ['id' => $id]);
        return $this->client->delete($params);
    }


    /**
     * 搜索方法
     * @param $query
     * @param null $sort
     * @return array
     */
    public function search($index, $key, $query, $sort = null)
    {
        $params['body'] = [
            'query' => [
                'match' => [
                    $key => $query
                ]
            ]
        ];
        if ($sort !== null)
        {
            $order = [];
            foreach($sort as $key => $val) {
                $order[$key] = ['order' => $val];
            }

            $params['body']['sort'] = $order;
        }

        $params = array_merge(array_combine(['index', 'type'], $index), $params);
        
        return $this->client->search($params);
    }


    /**
     * 单例
     * @param null $config
     * @return EsClient|null
     */
    public static function getInstance($config = null)
    {
        if (self::$instance == null) {
            self::$instance = new self($config);
        }
        return self::$instance;
    }
}