<?php
/**
 * Created by PhpStorm.
 * User: waiting
 * Date: 2016/8/5
 * Time: 10:15
 */
namespace EsHelper\Supports\Client;

class Client implements \EsHelper\Contracts\Client\Client
{
    private $client;

    public function __construct(\Elasticsearch\Client $client)
    {
        $this->client = $client;
    }

    public function createIndex($params)
    {

        return $this->client->indices()->create($params);
//        if (!$this->checkIndex($params['index'])) {
//
//        } else {
//
//            return $this->client->indices()->create($params);
//        }
    }


    public function updateIndex()
    {

    }

    public function insert($data)
    {
        return $this->client->bulk($data);
    }

    public function checkIndex($name)
    {
        return false;
        // TODO: Implement checkIndex() method.
    }

    public function statIndex()
    {
        // TODO: Implement statIndex() method.
    }

    /**
     * 删除索引
     * @param $name
     * @return array
     */
    public function deleteIndex($name)
    {
        $params = [
            'index' => $name
        ];
        return $this->client->indices()->delete($params);
    }


    public function search($params)
    {
        return $this->client->search($params);
    }
}