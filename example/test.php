<?php
/**
 * Created by PhpStorm.
 * User: inhere
 * Date: 2018/6/6
 * Time: 上午10:18
 */

require dirname(__DIR__) . '/vendor/autoload.php';


var_dump(token_get_all(file_get_contents(__DIR__ . '/using-refs/api-spec.php')));