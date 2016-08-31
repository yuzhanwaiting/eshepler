<?php
/**
 * Created by PhpStorm.
 * User: waiting
 * Date: 2016/8/1
 * Time: 15:29
 */


//索引示例，支持删除，新增索引
require_once __DIR__."/vendor/autoload.php";

require_once __DIR__."/App/AutoLoader.php";

$esconfig = require __DIR__."/config/esconfig.php";



$app = \EsHelper\Application::run();

$indexEngine = $app->make("client.index");


$reposity = $app->make("client.reposity");

//配置索引仓库
$reposity->config($esconfig);


$indexEngine->delete("hicu");

$indexEngine->create("hicu");

