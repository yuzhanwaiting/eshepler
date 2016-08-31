<?php
/**
 * Created by PhpStorm.
 * User: waiting
 * Date: 2016/8/29
 * Time: 11:46
 */
namespace App\Source;

use Doctrine\DBAL\DriverManager;
use EsHelper\Supports\Index\SourceEngine;

class HicuSource extends SourceEngine
{

    protected $queryBuilder;
    protected $conn;
    
    protected $file = BASE_DIR."/env.data";

    public function __construct($config)
    {
        $this->conn = DriverManager::getConnection($config);
        $this->queryBuilder = $this->conn->createQueryBuilder();
    }


    /**
     * 全部数据
     * @return array
     */
    public function all()
    {
        $sql  = $this->queryBuilder->select("id", "name","cid")->from("goods")->getSQL();

        return $this->conn->fetchAll($sql);
    }


    /**
     * 更新方法
     * @return array
     */
    public function update()
    {
        $lastUpdateTime = $this->readEnv();
        
        $sql  = $this->queryBuilder->select("id", "name","cid")->from("goods")->where("add_time > $lastUpdateTime")->getSQL();

        return $this->conn->fetchAll($sql);

    }

    /**
     * 读取环境配置
     * @return mixed
     */
    public function readEnv()
    {
        $content = file_get_contents($this->file);
        return $content;
    }

    /**
     * 设置环境
     * @return mixed
     */
    public function setEnv()
    {
        $time = time();
        file_put_contents($this->file, $time);
        return $time;
    }
}