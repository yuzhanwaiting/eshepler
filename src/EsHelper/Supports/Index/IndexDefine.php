<?php
/**
 * Created by PhpStorm.
 * User: waiting
 * Date: 2016/8/26
 * Time: 14:41
 */
namespace EsHelper\Supports\Index;

use EsHelper\Supports\Base\Object;
use EsHelper\Supports\Lib\Utils;

class IndexDefine extends Object
{
    protected $name;

    protected $type = 'my_type';

    protected $analyzer = 'ik_max_word';


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
    protected $fields = null;



    /**
     * 获得索引配置
     * @return array
     */
    public function getSetting()
    {
         return [
            'index' => $this->name,
            'body' => [
                'mappings' => [
                    $this->type => $this->getProperties()
                ]
            ]
        ];
    }


    /**
     * 获取字段定义
     * @return array
     * @throws \Exception
     */
    private function getProperties()
    {
        if ($this->fields === null) {
            throw new \Exception("字段未定义");
        } else {
            $properties = [];
            foreach ($this->fields as $val) {
                $properties[$val[0]] = $this->parserField($val);
            }

            return ['properties' => $properties];
        }
    }

    /**
     * 处理字段
     * @param $value
     * @return mixed
     */
    public function parserField($value)
    {
        $analyzer = [];
        if ($value[1] == "string") {
            $analyzer = ["analyzer" => $value[2] ?: $this->analyzer];
        }
        return array_merge(["type" => $value[1]], $analyzer);
    }



}