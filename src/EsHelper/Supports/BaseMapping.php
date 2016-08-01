<?php
/**
 * Created by PhpStorm.
 * User: waiting
 * Date: 2016/8/1
 * Time: 14:19
 */
namespace EsHelper\Supports;

class BaseMapping
{
    protected $analyzer = 'ik_max_word';

    protected $searchAnalyzer = 'ik_max_word';


    protected $fields = ["tags"];

    protected $index;


    private function getProperties()
    {
        $properties = [];
        foreach($this->fields as $key => $val) {
            $data['properties'][$key] = [
                'type' => 'string',
                'analyzer' => $this->analyzer,
                'search_analyzer' => $this->searchAnalyzer,
                'boost' => '8'
            ];
        }
        return $properties;
    }

    public function getMappingSetting()
    {
        return [
            'index' => $this->index[0],
            'type' => $this->index[1],
            'body' => $this->getProperties()
        ];
    }

}