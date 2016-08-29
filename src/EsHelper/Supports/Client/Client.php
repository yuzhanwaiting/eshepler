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
        try {
            $this->client->indices()->create($params);
        } catch (\Exception $e) {
            echo $e->getMessage();
        }
    }


    public function updateIndex()
    {

    }

    public function insert($data)
    {
        try {
            $this->client->bulk($data);
        } catch (\Exception $e) {

        }
    }


    /**
     * 删除索引
     * @param $name
     * @return array
     */
    public function deleteIndex($name)
    {
        try {
            $params = [
                'index' => $name
            ];
            $this->client->indices()->delete($params);

        } catch(\Exception $e) {
            echo $e->getMessage();
        }
    }


    public function search($params)
    {
        return $this->client->search($params);
    }

    public function existsIndex($name)
    {
        // TODO: Implement existsIndex() method.
    }
}