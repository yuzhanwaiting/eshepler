<?php
/**
 * Created by PhpStorm.
 * User: waiting
 * Date: 2016/8/9
 * Time: 9:38
 */
namespace App\Type;

use EsHelper\Supports\Index\Type;

class TagsType extends Type
{
    protected $name = "my_type1";


    /**
     * 字段配置
     * 配置格式
     * $fields = [
     *  ['field_name1', 'field_type', 'analyzer'],
     *  ['field_name2', 'field_type', 'analyzer'],
     *  ['field_name3', 'field_type', 'analyzer'],
     * ]
     *
     * @var
     */
    protected $fields = [
        ['tags', 'string']
    ];


    public function get()
    {
        return [
            ['tags' => '你好'],
            ['tags' => '中国'],
            ['tags' => '大街'],
            ['tags' => '世界']
        ];
    }
}