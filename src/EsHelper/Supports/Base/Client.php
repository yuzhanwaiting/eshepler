<?php
/**
 * Created by PhpStorm.
 * User: waiting
 * Date: 2016/8/24
 * Time: 15:06
 */
namespace EsHelper\Supports\Base;

use Elasticsearch\ClientBuilder;
use EsHelper\Application;
use EsHelper\Contracts\Base\Bootable;
use EsHelper\Contracts\Base\IndexInterface;
use EsHelper\Contracts\Base\SearchInterface;
use EsHelper\Contracts\Base\SourceInterface;
use EsHelper\Supports\Index\IndexEngine;
use EsHelper\Supports\Index\Reposity;
use EsHelper\Supports\Index\QueryEngine;

class Client extends Application implements Bootable,IndexInterface,SearchInterface,SourceInterface
{
    protected $client;


    public function __construct(\Elasticsearch\Client $client)
    {
        $this->client = $client;
    }


    /**
     * 创建索引
     * @param $params
     */
    public function createIndex($params)
    {
        try {
            $this->client->indices()->create($params);
        } catch (\Exception $e) {
            echo $e->getMessage();
        }
    }


    /**
     * 更新索引
     * @throws \Exception
     */
    public function updateIndex()
    {
        throw new \Exception("暂不支持该方法");
    }


    /**
     * 判断索引是否存在
     * @param $name
     * @return bool
     */
    public function existsIndex($name)
    {
        $params = [
            'index' => $name
        ];
        return $this->client->indices()->exists($params);
    }

    /**
     * 删除索引
     * @param $name
     * @return array
     */
    public function deleteIndex($name)
    {
        try {
            $params = [
                'index' => $name
            ];
            $this->client->indices()->delete($params);

        } catch(\Exception $e) {
            echo $e->getMessage();
        }
    }


    /**
     * 插入文档
     * @param $data
     * @return array
     */
    public function insert($data)
    {
        try {
            return $this->client->bulk($data);
        } catch (\Exception $e) {

        }
    }


    /**
     * 删除文档
     * @param $params
     * @return array
     */
    public function update($params)
    {
        return $this->client->update($params);
    }

    /**
     * 删除文档
     * @param $params
     */
    public function delete($params)
    {
        return $this->client->delete($params);
    }


    /**
     * 搜索方法
     * @param $params
     * @return array
     */
    public function search($params)
    {
        return $this->client->search($params);
    }


    /**
     * 启动方法
     * @param $config
     */
    public static function boot($config)
    {
        //注册客户端
        $host = [implode(":", $config['engine'])];
        $baseClient = ClientBuilder::create()->setHosts($host)->build();
        Application::$app->register("client", Client::class, $baseClient);


        //注册索引管理器
        Application::$app->register("client.reposity", Reposity::class);


        //注册索引管理器
        Application::$app->register("client.index", IndexEngine::class);


        //注册搜索引擎
        Application::$app->register("client.query", QueryEngine::class);

    }


    

}