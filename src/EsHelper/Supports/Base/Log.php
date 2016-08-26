<?php
/**
 * Created by PhpStorm.
 * User: waiting
 * Date: 2016/8/24
 * Time: 15:10
 */
namespace EsHelper\Supports\Base;

use EsHelper\Application;
use EsHelper\Contracts\Base\Bootable;
use GuzzleHttp\Ring\Client\StreamHandler;

class Log extends Object implements Bootable
{
    protected $engine;


    public function __construct($config)
    {
        $this->setEngine($config['engine']['name'], $config['engine']['params']);
    }

    public function setEngine($name, $params)
    {
        $methodName = "set" . $name;
        $this->$methodName($params);
    }


    private function setMonolog($params)
    {
        if ($params['driver'] === 'file') {
            $logHandler = new StreamHandler($params['file']);
            $this->engine = new Logger("es-log");
            $this->engine->pushHandler($logHandler);
        } else {
            throw new \Exception("只允许file驱动");
        }
    }


    public static function boot($config)
    {
        Application::$app->register("log", $config);
    }

}