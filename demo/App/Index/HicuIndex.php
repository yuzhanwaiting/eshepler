<?php
/**
 * Created by PhpStorm.
 * User: waiting
 * Date: 2016/8/1
 * Time: 16:18
 */
namespace App\Index;


use App\Type\TagsType;
use EsHelper\Supports\Index\Index;

class HicuIndex extends Index
{

    protected $indexName = 'hicu';


    protected $typesDefine = [
        'my_type1' => TagsType::class,
    ];

}