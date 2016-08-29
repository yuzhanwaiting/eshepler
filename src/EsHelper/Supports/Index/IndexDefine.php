<?php
/**
 * Created by PhpStorm.
 * User: waiting
 * Date: 2016/8/26
 * Time: 14:41
 */
namespace EsHelper\Supports\Index;

use EsHelper\Supports\Base\Object;

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


    private function getProperties()
    {
        if ($this->fields === null) {
            throw new \Exception("字段未定义");
        } else {
            $properties = [];
            foreach ($this->fields as $val) {
                $properties[$val[0]] = [
                    'type' => $val[1],
                    'analyzer' => $val[2] ?: $this->analyzer
                ];
            }

            return ['properties' => $properties];
        }
    }



}