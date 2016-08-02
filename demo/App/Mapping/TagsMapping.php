<?php
/**
 * Created by PhpStorm.
 * User: waiting
 * Date: 2016/8/1
 * Time: 16:22
 */
namespace App\Mapping;

use EsHelper\Supports\BaseMapping;

class TagsMapping extends BaseMapping
{
    protected $fields = ["tags"];

    protected $index = 'hicu';

    protected $type = 'tags';

    
}