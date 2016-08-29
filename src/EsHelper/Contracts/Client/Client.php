<?php
/**
 * Created by PhpStorm.
 * User: waiting
 * Date: 2016/8/2
 * Time: 16:28
 */
namespace EsHelper\Contracts\Client;

interface Client
{

    public function createIndex($name);

    public function updateIndex();
    

    public function existsIndex($name);

    public function deleteIndex($name);


    public function insert($data);



    public function search($params);
}