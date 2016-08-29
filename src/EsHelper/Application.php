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

    /**
     * 应用实例
     * @var
     */
    public static $app;


    /**
     * 项目根目录
     * @var string
     */
    private static $basePath = __DIR__;


    /**
     * 初始化方法
     * Application constructor.
     * @param $config
     */
    public function __construct($config)
    {
        Application::$app = $this;
        $config = $this->preInit($config);
        $this->bootstrap($config);
    }


    /**
     * 处理预加载类
     * @param array $config
     * @return mixed
     */
    public function preInit($config = [])
    {
        if ($config)
            return array_merge($this->coreInstance(), $config);
        return $this->coreInstance();
    }


    /**
     * 预加载核心类
     * @return mixed
     */
    public function coreInstance()
    {
        return require_once(self::getBasePath() . "/config.php");
    }


    /**
     * 获取根目录
     * @return string
     */
    public static function getBasePath()
    {
        return self::$basePath;
    }


    /**
     * 项目启动注册
     * @param $config
     * @throws \Exception
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


    /**
     * 项目启动
     * @param array $config
     * @return Application
     */
    public static function run($config = [])
    {
        return new self($config);
    }







}