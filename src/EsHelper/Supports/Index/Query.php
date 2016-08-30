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

    protected $filters = null;

    protected $sorts = null;

    protected $condition = null;

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


    public function match($keyword, $value)
    {
        $this->condition[$keyword] = $value;
        return $this;
    }


    public function filter($params)
    {
        $this->filters = $params;
        return $this;
    }


    public function sort($params)
    {
        $this->sorts = $params;
        return $this;
    }


    public function search()
    {

        if (!$this->condition) {
            throw new \Exception("搜索条件必须");
        } else {

            //搜索关键字
            $keyword = array_keys($this->condition)[0];


//            构建基本搜索条件
            $query = ["query" => [
                'match' => [
                    $keyword => $this->condition[$keyword]
                ]
            ]];

//            构建过滤过则
            $filters = $this->parseFilter() ?: [];


//            构建排序规则
            $sorts = $this->parseSort() ?: [];


//            整体查询条件整理
            $query = ["query" => ["filtered" => array_merge($query, $filters)]];

            $queryWithSort = array_merge($query, $sorts);

//            最终查询语句
            $params = [
                'index' => $this->index,
                'type' => $this->type,
                'body' => $queryWithSort
            ];

//            查询结果
            $result = $this->make("client")->search($params);
            
            //重置查询关键字
            $this->condition = null;

            //重置查询条件，排序规则
            $this->filters = null;
            $this->sorts = null;

            return $result;
        }
    }


    /**
     * 过滤排序规则
     * @return array|bool
     */
    private function parseSort()
    {
        if ($this->sorts) {
            return ["sort" => $this->sorts];
        }
        return false;
    }


    /**
     * 处理过滤规则
     * @return array|bool
     */
    private function parseFilter()
    {
        if ($this->filters) {
            $filters = [];
            foreach($this->filters as $val) {
                array_push($filters, $this->parseCondition($val));
            }
            return ["filter" => ["and" => $filters]];
        }
        return false;
    }


    /**
     * 表达是过滤
     * @param $item
     * @return array
     * @throws \Exception
     */
    private function parseCondition($item)
    {
        list($field, $value, $condition) = $item;

            //过滤相等条件
        if ($condition == "eq") {
            return [
                "term" => [$field => $value]
            ];

            //过滤选择条件
        } else if ($condition == "in") {
            return [
                "terms" => [$field => $value]
            ];

            //过滤区间条件
        } else if ($condition == "range"){
            return [
                "range" => [
                    $field => [
                        "gte" => $value[0],
                        "lte" => $value[1]
                    ]
                ]
            ];

            //过滤区间条件
        } else if (in_array($condition, ["lt", "gt", "gte", "lte"])) {
            return [
                "range" => [
                    $field => [
                        $condition => $value
                    ]
                ]
            ];
        } else {
            throw new \Exception("过滤表达式错误");
        }
    }

}