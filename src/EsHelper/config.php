<?php
/**
 * Created by PhpStorm.
 * User: waiting
 * Date: 2016/8/24
 * Time: 16:48
 */
return [
    'client' => [
        'class' => \EsHelper\Supports\Base\Client::class,
        'engine' => [
            'host' => '192.168.106.130',
            'port' => '9200'
        ]
    ],
    'parser' => [
        'class' =>  \EsHelper\Supports\Parser\ParserFactory::class
    ],
/*    'logger' => [
        'class' => \EsHelper\Supports\Base\Log::class,
        'engine' => [
            'name' => 'monolog',
            'config' => [
                'driver' => 'file',
                'path' => '',
                'filename' => 'my.log'

            ]
        ]
    ],*/
];