<?php
/**
 * Created by PhpStorm.
 * User: waiting
 * Date: 2016/8/1
 * Time: 16:34
 */
namespace EsHelper\Supports;


class IndexConfig
{
    
    protected $name;

    protected $mappings = [];

    protected $indexInstance = [];

    public function __construct($name, $params)
    {
        $this->setIndexName($name);
        $this->parseConfig($params);
    }

    private function parseConfig($params)
    {
        foreach($params as $val) {
            array_push($this->mappings, new $val['mapping']);
            array_push($this->indexInstance, new $val['type']);
        }
    }


    private function setIndexName($name)
    {
        $this->name = $name;
    }


    public function getMapping()
    {
        $mapping['index'] = $this->name;
        foreach($this->mappings as $val) {
            $mapSetting = $val->getMappingSetting();
            $mapping['body']['mappings'][$mapSetting['type']] = $mapSetting['body'];
        }
        return $mapping;
    }


    public function getData()
    {
        $data = [];
        foreach($this->indexInstance as $val) {
            array_push($data, $this->parseValue($val->getType(), $val->getData()));
        }
        return $data;
    }

    private function parseValue($value)
    {
        $data = [];

        $index = array_combine(["_index","_type"], [$this->name, ]);
        foreach($value as $key => $val) {
            $data['body'][] = [
                'index' => $index
            ];
            $data['body'][] = $val;
        }

        return $data;

    }



}