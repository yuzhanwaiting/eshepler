<?php
/**
 * Created by PhpStorm.
 * User: waiting
 * Date: 2016/8/29
 * Time: 13:55
 */

//文档更新，以及文档基本处理示例

set_time_limit(0);

require_once __DIR__."/vendor/autoload.php";

require_once __DIR__."/App/AutoLoader.php";

$config = require_once ("./config/db.php");

$app = \EsHelper\Application::run();

$instance = new \App\Source\HicuSource($config);



//配置主键和索引
$instance->config([
    'id' => 'id',
    'index' => 'hicu'
]);

//插入所有文档
$instance->insert($instance->all());

//更新文档
$res = $instance->updateDoc(14, ["name" => "社会主义国家","cid" => 10]);

//删除文档
$res = $instance->deleteDoc(14);