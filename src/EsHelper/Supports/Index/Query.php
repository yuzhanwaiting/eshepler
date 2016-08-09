<?php
/**
 * Created by PhpStorm.
 * User: waiting
 * Date: 2016/8/8
 * Time: 15:32
 */
namespace EsHelper\Supports\Index;

use EsHelper\Contracts\Client\Client;

class Query
{
    protected $index;

    protected $type;

    protected $client;

    public function __construct(Client $client)
    {
        $this->client = $client;
    }


    /**
     * 配置索引和类型
     * @param $index
     * @param $type
     */
    public function config($index, $type)
    {
        $this->index = $index;
        $this->type = $type;
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

        return $this->client->search($params);
    }
}