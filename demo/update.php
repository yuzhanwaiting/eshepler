<?php
/**
 * Created by PhpStorm.
 * User: waiting
 * Date: 2016/8/29
 * Time: 13:55
 */
//局部更新测试
require_once __DIR__."/vendor/autoload.php";

require_once __DIR__."/App/AutoLoader.php";


$config = require_once ("./config/db.php");


define("BASE_DIR", __DIR__);


$app = \EsHelper\Application::run();

$instance = new \App\Source\HicuSource($config);


/**
 * id 用来指定主键字段
 * index 用来指定索引
 */
$instance->config([
    'id' => 'id',
    'index' => 'hicu'
]);

//插入数据
$instance->insert($instance->update());

//设置新的环境
$instance->setEnv();

