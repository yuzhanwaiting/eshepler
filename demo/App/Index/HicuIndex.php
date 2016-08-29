<?php
/**
 * Created by PhpStorm.
 * User: waiting
 * Date: 2016/8/1
 * Time: 16:18
 */
namespace App\Index;



use EsHelper\Supports\Index\IndexDefine;

class HicuIndex extends IndexDefine
{

    protected $name = "hicu";


    protected $fields = [
        ['tags', 'string']
    ];
}