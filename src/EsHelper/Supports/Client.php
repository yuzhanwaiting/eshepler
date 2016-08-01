<?php
/**
 * Created by PhpStorm.
 * User: waiting
 * Date: 2016/8/1
 * Time: 9:22
 */
namespace EsHelper\Supports;

use Elasticsearch\ClientBuilder;

class Client
{
    private static $instance = null;


    private $client;


    private function __construct($config)
    {
        $this->client = $this->setClient($config);
    }

    private function setClient($host)
    {
        return ClientBuilder::create()->setHosts($host)->build();
    }


    public function createIndex($index, $value, $mappingObj, $multi = false)
    {
        $this->setMapping($mappingObj);
        return $this->parseValue($index, $value, $multi);
    }

    private function setMapping(BaseMapping $mappingObj)
    {
        $this->client->indices()->putMapping($mappingObj->getMappingSetting());
    }


    private function parseValue($index, $value, $multi)
    {
        $data = [];
        if ($multi) {
            $index = array_combine(["_index","_type"], $index);
            foreach($value as $key => $val) {
                $data['body'][] = [
                    'index' => $index
                ];
                $data['body'][] = $val;
            }
            $response = $this->client->bulk($data);
        } else {
            $index = array_combine(["index","type"], $index);
            $data = array_merge($index, ["body" => $value]);
            $response = $this->client->index($data);
        }
        return $response;
    }



    public function updateIndex()
    {

    }

    public function deleteIndex($index, $id)
    {
        $params = array_merge(array_combine(["index","type"], $index), ['id' => $id]);
        return $this->client->delete($params);
    }


    public function search($query, $sort = null)
    {
        $params['body'] = [
            'query' => [
                'match' => $query
            ]
        ];
        if ($sort !== null)
        {
            $order = [];
            foreach($sort as $key => $val) {
                $order[$key] = ['order' => $val];
            }

            $params['body']['sort'] = $order;
        }

        return $this->client->search($params);
    }


    public static function getInstance($config = null)
    {
        if (self::$instance == null) {
            self::$instance = new self($config);
        }
        return self::$instance;
    }
}