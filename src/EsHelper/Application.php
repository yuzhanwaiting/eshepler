<?php
/**
 * Created by PhpStorm.
 * User: waiting
 * Date: 2016/8/23
 * Time: 17:34
 */
namespace EsHelper;





use EsHelper\Supports\Base\Container;

class Application extends Container
{
    public static $app;

    private static $basePath = __DIR__;

    public function __construct($config)
    {
        Application::$app = $this;
        $config = $this->preInit($config);
        $this->bootstrap($config);
    }

    public function preInit($config = [])
    {
        if ($config)
            return array_merge($this->coreInstance(), $config);
        return $this->coreInstance();
    }

    public function coreInstance()
    {
        return require_once(self::getBasePath() . "/config.php");
    }

    public static function getBasePath()
    {
        return self::$basePath;
    }



    /**
     *
     */
    public function bootstrap($config)
    {
        foreach($config as $name => $params) {
            if(!isset($params['class'])) {
                throw new \Exception("请填写class");
            }
            $class = $params['class'];
            unset($params['class']);
            $params = count($params) ? $params : null;
            $this->registerBoot($name, $class, $params);
        }
    }


    public static function run($config = [])
    {
        return new self($config);
    }







}