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
use EsHelper\Supports\Index\IndexManagement;
use EsHelper\Supports\Index\IndexReposity;
use EsHelper\Supports\Index\Query;

class Client extends Application implements Bootable,\EsHelper\Contracts\Client\Client
{
    protected $client;

    public function __construct(\Elasticsearch\Client $client)
    {
        $this->client = $client;
    }


    public function createIndex($params)
    {
        try {
            $this->client->indices()->create($params);
        } catch (\Exception $e) {
            echo $e->getMessage();
        }
    }


    public function updateIndex()
    {

    }

    public function insert($data)
    {
        try {
            $this->client->bulk($data);
        } catch (\Exception $e) {

        }
    }


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


    public function search($params)
    {
        return $this->client->search($params);
    }




    public static function boot($config)
    {
        //注册客户端
        $host = [implode(":", $config['engine'])];
        $baseClient = ClientBuilder::create()->setHosts($host)->build();
        Application::$app->register("client", Client::class, $baseClient);


        //注册索引管理器
        Application::$app->register("client.reposity", IndexReposity::class);


        //注册索引管理器
        Application::$app->register("client.index", IndexManagement::class);


        //注册搜索引擎
        Application::$app->register("client.query", Query::class);

    }


    

}