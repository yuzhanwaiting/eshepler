<?php
/**
 * Created by PhpStorm.
 * User: waiting
 * Date: 2016/8/31
 * Time: 9:10
 */
namespace EsHelper\Supports\Parser;

use EsHelper\Application;
use EsHelper\Contracts\Base\Bootable;

abstract class ParserFactory extends Application implements Bootable
{

    abstract public function parse($data);

    public static function boot($config = null)
    {
        Application::$app->register("parser.query", QueryParser::class);
    }
}