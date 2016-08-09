<?php
/**
 * Created by PhpStorm.
 * User: waiting
 * Date: 2016/8/4
 * Time: 14:28
 */
namespace EsHelper\Supports\Index;


class Index
{
    /**
     * index name
     * @var
     */
    protected $indexName;


    /**
     * type实例
     * @var array
     */
    protected $typeInstances = [];


    /**
     *
     * 定义type 格式：
     *     protected $typesDefine = [
            'my_type1' => 'TypeClass1',
            'my_typw2' => 'TypeClass2',
            ];
     * index tags
     * @var
     */
    protected $typesDefine;


    /**
     * 构造函数
     * Index constructor.
     */
    public function __construct()
    {
        $this->initTypes();
    }

    /**
     * 初始化type
     */
    public function initTypes()
    {
        foreach($this->typesDefine as $key => $val) {
            $this->typeInstances[$key] = new $val;
        }
    }


    /**
     * 通过type名称获得type实例
     * @param $name
     * @return mixed
     */
    public function getType($name)
    {
        return $this->typeInstances[$name];
    }


    /**
     * 获得索引名称
     * @return mixed
     */
    public function getIndexName()
    {
        return $this->indexName;
    }


    /**
     * 获得索引配置
     * @return array
     */
    public function getSetting()
    {
        return [
            'index' => $this->indexName,
            'body' => [
                'mappings' => $this->getMapping()
            ]
        ];
    }


    /**
     * 获得mapping配置
     * @return array
     */
    public function getMapping()
    {
        $mapping = [];
        foreach($this->typesDefine as $key => $val) {
            $mapping[$key] = [
                'properties' => $this->typeInstances[$key]->getMapping()
            ];
        }
        return $mapping;
    }




}