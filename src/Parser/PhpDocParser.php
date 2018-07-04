<?php
/**
 * Created by PhpStorm.
 * User: inhere
 * Date: 2018/6/5
 * Time: 下午4:26
 */

namespace SwagPhp\Parser;

use phpDocumentor\Reflection\DocBlockFactory;
use SwagPhp\Context;

/**
 * Class PhpDocAnalyser
 * - Extract php annotations from a [PHPDoc](http://en.wikipedia.org/wiki/PHPDoc) using phpdocumentor/reflection-docblock.
 * @package SwagPhp\Parser
 */
class PhpDocParser implements ParserInterface
{
    /**
     * @var DocBlockFactory
     */
    private $factory;

    /**
     * PhpDocParser constructor.
     */
    public function __construct()
    {
        $this->factory = DocBlockFactory::createInstance();
    }

    public function tagHandlers(): array
    {
        return [];
    }

    public function readClass(string $class)
    {

    }

    /**
     * @param string $docComment
     * @param Context|null $context
     * @return array
     */
    public function parseComment(string $docComment, Context $context = null): array
    {
        if ($context === null) {
            $context = new Context(['comment' => $docComment]);
        } else {
            $context->comment = $docComment;
        }

        $dbk = $this->factory->create($docComment);

        \var_dump($dbk);
    }
}