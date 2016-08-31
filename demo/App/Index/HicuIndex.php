<?php
/**
 * Created by PhpStorm.
 * User: waiting
 * Date: 2016/8/1
 * Time: 16:18
 */
namespace App\Index;

use EsHelper\Supports\Index\IndexDefine;


class HicuIndex extends IndexDefine
{

    /**
     * 定义索引名称
     * @var string
     */
    protected $name = "hicu";


    /**
     * 定义索引字段配置
     * @var array
     */
    protected $fields = [
        ['name', 'string'],
        ['cid', 'integer' ],
        ['id', 'integer']
    ];
}