<?php
/**
 * Created by PhpStorm.
 * User: waiting
 * Date: 2016/8/8
 * Time: 15:32
 */
namespace EsHelper\Supports\Index;

use EsHelper\Application;

class Query extends Application
{
    protected $index;

    protected $type = 'my_type';

    protected $client;

    
    /**
     * 配置索引和类型
     * @param $index
     * @param $type
     */
    public function setIndex($name, $type = 'my_type')
    {
        $this->index = $name;
        $this->type = $type;
        return $this;
    }



    public function search($fields, $keywords, $sort = null)
    {
        $params['body'] = [
            'query' => [
                'match' => [
                    $fields => $keywords
                ]
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

        $params = array_merge(['index' => $this->index, 'type' => $this->type], $params);

        return $this->make("client")->search($params);
    }
}