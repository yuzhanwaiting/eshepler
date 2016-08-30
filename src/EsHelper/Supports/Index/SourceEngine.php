<?php
/**
 * Created by PhpStorm.
 * User: waiting
 * Date: 2016/8/23
 * Time: 15:20
 */
namespace EsHelper\Supports\Index;

use EsHelper\Application;

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

    /**
     * 更新单篇文档
     * @param $id
     * @param $params
     * @return mixed
     * @throws \Exception
     */
    public function updateDoc($id, $params)
    {
        $data = [
            'index' => $this->index,
            'type' => $this->type,
            'id' => $id,
            'body' => [
                'doc' => $params
            ]
        ];
        return $this->make("client")->update($data);
    }


    /**
     * 删除文档
     * @param $id
     * @return mixed
     * @throws \Exception
     */
    public function deleteDoc($id)
    {
        $data = [
            'index' => $this->index,
            'type' => $this->type,
            'id' => $id
        ];
        return $this->make("client")->delete($data);
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