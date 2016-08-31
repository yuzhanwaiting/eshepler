<?php
/**
 * Created by PhpStorm.
 * User: waiting
 * Date: 2016/8/31
 * Time: 9:53
 */

//查询示例

require_once __DIR__."/vendor/autoload.php";

require_once __DIR__."/App/AutoLoader.php";


//程序启动
$app = \EsHelper\Application::run();


//获得查询引擎
$searchEngine = $app->make("client.query");


//设置查询索引
$searchEngine->setIndex("hicu");


//按条件搜索
$res = $searchEngine->match("name", "社会")
    ->filter([
        ['cid', '6', 'lt']
    ])
    ->sort([
        ["id" => "desc"]
    ])
    ->search();


//返回所有结果
//$res = $searchEngine->search();


\EsHelper\Supports\Lib\Utils::jsonExit($res);

