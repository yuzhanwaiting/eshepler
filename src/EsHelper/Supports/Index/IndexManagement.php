<?php
/**
 * Created by PhpStorm.
 * User: waiting
 * Date: 2016/8/2
 * Time: 16:24
 */
namespace EsHelper\Supports\Index;





use EsHelper\Supports\Client\Client;

class IndexManagement
{
    protected $client;

    protected $indexReposity;

    protected $instance = [];

    public function __construct(Client $client, IndexReposity $indexReposity)
    {
        $this->client = $client;
        $this->indexReposity = $indexReposity;
    }


    /**
     * 创建索引
     * @param Index $index
     */
    public function create($name)
    {
        $setting = $this->instanceIndex($name)->getSetting();

        return $this->client->createIndex($setting);
    }

    /**
     * 实例化索引
     * @param $name
     * @return mixed
     */
    private function instanceIndex($name)
    {
        if (!$this->instance[$name]) {
            $indexname = $this->indexReposity->getIndex($name);
            $this->instance[$name] = new $indexname;
        }


        return $this->instance[$name];
    }


    public function indexData($index, $type)
    {
        $typeObj = $this->instanceIndex($index)->getType($type);
        $sourceData = $typeObj->get();

        $data = [];
        foreach($sourceData as $key => $val)
        {
            $data['body'][] = [
                'index' => [
                    '_index' => $index,
                    '_type' => $type,
                ]
            ];

            $data['body'][] = $val;
        }

        $this->client->insert($data);

    }



    public function update()
    {

    }

    public function delete($name)
    {
        $this->client->deleteIndex($name);
    }
}