<?php
/**
 * Created by PhpStorm.
 * User: waiting
 * Date: 2016/8/1
 * Time: 9:01
 */
namespace EsHelper;

use Elasticsearch\ClientBuilder;

class Client
{
    public $client;


    function __construct($host)
    {
        $this->client = $this->setClient($host);
    }


    private function setClient($host)
    {
        return ClientBuilder::create()->setHosts($host)->build();
    }

    
}