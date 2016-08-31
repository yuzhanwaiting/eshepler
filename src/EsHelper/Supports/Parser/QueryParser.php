<?php
/**
 * Created by PhpStorm.
 * User: waiting
 * Date: 2016/8/31
 * Time: 9:15
 */
namespace EsHelper\Supports\Parser;

class QueryParser extends ParserFactory
{
    
    /**
     * 查询结果方法优化
     * @param $data
     * @return array
     */
    public function parse($data)
    {
        $records = [];

        $count = $data["hits"]['total'];

        if ($count) {
            foreach ($data["hits"]["hits"] as $val) {
               $records[] = $val['_source'];
            }
        }

        return ["count" => $count, "records" => $records];
    }
}