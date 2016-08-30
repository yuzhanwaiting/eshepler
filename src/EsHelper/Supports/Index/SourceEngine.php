<?php
/**
 * Created by PhpStorm.
 * User: waiting
 * Date: 2016/8/23
 * Time: 15:20
 */
namespace EsHelper\Supports\Index;

use EsHelper\Application;
use EsHelper\Supports\Lib\Utils;

class SourceEngine extends Application
{
    protected $pagesize = 50;

    protected $index;

    protected $type = 'my_type';

    protected $id = null;



    function all()
    {

    }


    function update()
    {

    }


    protected function setIndex($index)
    {
        $this->index = $index;
    }

    protected function setPageSize($pageSize = 50)
    {
        $this->pagesize = $pageSize;
    }

    protected function setType($type = 'my_type')
    {
        $this->type = $type;
    }

    protected function setId($id)
    {
        $this->id = $id;
    }


    /**
     *
     * 插入数据
     * @param $source
     * @return mixed
     * @throws \Exception
     */
    public function insert($source)
    {
        $data = [];
        foreach($source as $val) {


            $id = [];

            if ($this->id)
                $id = ["_id" => $val[$this->id]];

            $index = [
                '_index' => $this->index,
                '_type' => $this->type,
            ];

            $index = array_merge($index, $id);

            $data['body'][] = [
                'index' => $index
            ];

            $data['body'][] = $val;
        }


//        Utils::jsonExit($data);

        
        return $this->make("client")->insert($data);

    }



    public function config($config)
    {
        try {
            foreach($config as $property => $val) {
                $this->$property = $val;
            }
        } catch (\Exception $e) {
            echo $e->getMessage();
        }

    }




}