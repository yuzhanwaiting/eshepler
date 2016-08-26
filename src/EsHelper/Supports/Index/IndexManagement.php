<?php
/**
 * Created by PhpStorm.
 * User: waiting
 * Date: 2016/8/2
 * Time: 16:24
 */
namespace EsHelper\Supports\Index;


use EsHelper\Application;
use EsHelper\Contracts\Base\Bootable;

class IndexManagement extends Application implements Bootable
{

    protected $instance = [];

    public function __construct()
    {

    }


    public function create($name)
    {
        $setting = $this->make("client.reposity")->getIndexSetting($name);

        return $this->make("client")->createIndex($setting);
    }


    public function update($params)
    {

    }


    public function delete($name)
    {
        return $this->make("client")->deleteIndex($name);
    }

    public function stat($params)
    {

    }


    public static function boot($config = null)
    {
        //注册索引函数
        Application::$app->register("client.reposity", IndexReposity::class);
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


}