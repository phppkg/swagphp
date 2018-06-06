<?php
/**
 * Created by PhpStorm.
 * User: inhere
 * Date: 2018/6/5
 * Time: 下午10:20
 */

require dirname(__DIR__) . '/../vendor/autoload.php';

$files = [
    'User.php',
    'UserController.php'
];

foreach ($files as $file) {
    include __DIR__ . '/' . $file;
}

$factory  = \phpDocumentor\Reflection\DocBlockFactory::createInstance();

$ref = new ReflectionClass(\SwagPhp\Example\SimpleMode\UserController::class);

$docblock = $factory->create($ref->getDocComment());

var_dump($docblock->getTags());

//var_dump(token_get_all(file_get_contents(__DIR__ . '/UserController.php')));