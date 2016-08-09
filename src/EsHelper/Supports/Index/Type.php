<?php
/**
 * Created by PhpStorm.
 * User: waiting
 * Date: 2016/8/5
 * Time: 9:18
 */
namespace EsHelper\Supports\Index;

use EsHelper\Contracts\Index\Source;

abstract class Type implements Source
{
    
    /**
     * type名称
     * @var
     */
    protected $name;

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
    protected $fields;

    protected $analyzer = 'ik_max_word';


    /**
     * 获得typename
     * @return mixed
     */
    public function getTypeName()
    {
        return $this->name;
    }


    /**
     * 获得mapping配置
     * @return array
     */
    public function getMapping()
    {
        $properties = [];

        foreach($this->fields as $val) {
            $properties[$val[0]] = $this->parseProperty($val);
        }
        return $properties;
    }


    /**
     * 解析属性配置
     * @param $val
     * @return array
     */
    private function parseProperty($val)
    {
        return [
            'type' => $val[1],
            'analyzer' => $val[2] ?: $this->analyzer
        ];
    }

}