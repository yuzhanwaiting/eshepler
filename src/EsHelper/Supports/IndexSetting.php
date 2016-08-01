<?php
/**
 * Created by PhpStorm.
 * User: waiting
 * Date: 2016/8/1
 * Time: 17:27
 */
namespace EsHelper\Supports;

use Elasticsearch\Client;

class IndexSetting
{
    private $indexObj;
    private $client;

    public function __construct(IndexConfig $indexObj, Client $client)
    {
        $this->indexObj = $indexObj;
        $this->client = $client;
    }

    private function setMapping()
    {
        foreach($this->indexObj->getMapping() as $val) {
            $this->client->indices()->putMapping($val);
        }
    }

    private function setData()
    {
        foreach($this->indexObj->getData() as $val) {
            $this->client->bulk($val);
        }
    }

    public function run()
    {
        $this->setMapping();
        $this->setData();
    }


}