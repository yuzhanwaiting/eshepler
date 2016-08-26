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
use EsHelper\Supports\Index\Query;

class Client extends Application implements Bootable
{
    protected $client;

    public function __construct(\EsHelper\Contracts\Client\Client $client)
    {
        $this->client = $client;
    }



    public static function boot($config)
    {

        //注册客户端
        $host = implode(":", $config['engine']);
        $baseClient = ClientBuilder::create()->setHosts($host)->build();
        Application::$app->register("client",$baseClient);



        //注册索引管理器
        Application::$app->registerBoot("client.index", IndexManagement::class);


        //注册搜索引擎
        Application::$app->register("client.query", Query::class);

    }


    

}