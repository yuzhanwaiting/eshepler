<?php
/**
 * Created by PhpStorm.
 * User: waiting
 * Date: 2016/8/1
 * Time: 15:29
 */

require_once __DIR__."/vendor/autoload.php";

require_once __DIR__."/App/AutoLoader.php";

$esconfig = require __DIR__."/config/esconfig.php";



$host = ['127.0.0.1:9200'];

$app = new \EsHelper\App($host, $esconfig);
$client = $app->make("client");
$reposity = $app->make("reposity");




//初始化客户端
$client = new \EsHelper\Supports\EsClient($host);

//初始化索引仓库
$reposity = new \EsHelper\Supports\Index\IndexReposity($esconfig);






//索引管理
$indexEngine = $client->getEngine("index");


$indexEngine->config($reposity);

$indexEngine->delete('hicu');

$indexEngine->create('hicu');



//资源管理
$sourceEngine = $client->getEngine("source");
$sourceEngine->config($reposity);
$sourceEngine->all()->save();
$sourceEngine->update()->save();



//初始化搜索管理
$searchEngine = $client->getEngine("search");
//
$searchEngine->config('hicu','my_type1');
////
$res = $searchEngine->search('tags','中国');
////
////
var_dump($res);

