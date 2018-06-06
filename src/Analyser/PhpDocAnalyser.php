<?php
/**
 * Created by PhpStorm.
 * User: inhere
 * Date: 2018/6/5
 * Time: 下午4:26
 */

namespace SwagPhp\Analyser;

use phpDocumentor\Reflection\DocBlockFactory;

/**
 * Class PhpDocAnalyser
 * - Extract php annotations from a [PHPDoc](http://en.wikipedia.org/wiki/PHPDoc) using phpdocumentor/reflection-docblock.
 * @package SwagPhp\Analyser
 */
class PhpDocAnalyser
{
    /**
     * @var DocBlockFactory
     */
    private $factory;

    public function __construct()
    {
        $this->factory  = DocBlockFactory::createInstance();
    }

    public function tagHandlers(): array
    {
        return [];
    }

    public function readClass(string $class)
    {

    }

    public function readDocBlock(string $docComment)
    {
        $dbk = $this->factory->create($docComment);
        
    }
}