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

//初始化客户端
$client = new \EsHelper\Supports\EsClient($host, $esconfig);



//初始化索引管理
$manager = $client->getIndexManagenemnt();

$manager->delete('hicu');

$manager->create('hicu');

$manager->indexData('hicu','my_type1');




//初始化搜索管理
$searchEngine = $client->getQuery();
//
$searchEngine->config('hicu','my_type1');
////
$res = $searchEngine->search('tags','中国');
////
////
var_dump($res);

