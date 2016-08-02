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

    
    protected $fields;

    protected $index;

    protected $type;


    private function getProperties()
    {
        $data = [];
        foreach($this->fields as $val) {
            $data['properties'][$val] = [
                'type' => 'string',
                'analyzer' => $this->analyzer,
                'search_analyzer' => $this->searchAnalyzer,
                'boost' => '8'
            ];
        }
        return $data;
    }

    public function getMappingSetting()
    {
        $one =  [
            'index' => $this->index,
            'type' => $this->type,
            'body' => $this->getProperties()
        ];
        
        return $one;
    }


}