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



new \App\Index\TagsIndex();
$host = ['127.0.0.1:9200'];

//初始化客户端
$client = new \EsHelper\Client($host);



$index = ["index", "fulltext"];
$key = "content";
$response = $client->search($index, $key,  "中国");
var_dump($response);

//初始化索引

//$client->initIndices($esconfig)->run();



//搜索方法
//$client->search();
