<?php
/**
 * Created by PhpStorm.
 * User: inhere
 * Date: 2018/6/5
 * Time: 下午4:26
 */

namespace SwagPhp\Parser;

use phpDocumentor\Reflection\DocBlockFactory;
use phpDocumentor\Reflection\Types\ContextFactory;
use SwagPhp\Context;
use SwagPhp\DocTags;
use SwagPhp\Parser\DocTags\Tag;

/**
 * Class PhpDocAnalyser
 * - Extract php annotations from a [PHPDoc](http://en.wikipedia.org/wiki/PHPDoc) using phpdocumentor/reflection-docblock.
 * @package SwagPhp\Parser
 */
class PhpDocParser implements ParserInterface
{
    /**
     * @var array
     */
    private static $reflections = [];

    /**
     * @var DocBlockFactory
     */
    private $factory;

    /**
     * @param string $class
     * @return \ReflectionClass
     * @throws \ReflectionException
     */
    public static function getReflection(string $class): \ReflectionClass
    {
        return self::createReflection($class);
    }

    /**
     * @param string $class
     * @return \ReflectionClass
     * @throws \ReflectionException
     */
    public static function createReflection(string $class): \ReflectionClass
    {
        if (!isset(self::$reflections[$class])) {
            self::$reflections[$class] = new \ReflectionClass($class);
        }

        return self::$reflections[$class];
    }

    /**
     * PhpDocParser constructor.
     */
    public function __construct()
    {
        $this->factory = DocBlockFactory::createInstance([
            'Tag' => Tag::class,
        ]);
    }

    public function tagHandlers(): array
    {
        return [];
    }

    public function readClass(string $class): array
    {
        $refClass = self::getReflection($class);
        $classDoc = \trim($refClass->getDocComment());

        $ctx = new ContextFactory();
        $dbc = $this->factory->create($classDoc, $ctx->createFromReflector($refClass));

        \var_dump($dbc->getSummary(), $dbc->getDescription(), $dbc->getTags());

        $dbc->hasTag(DocTags::DESCRIPTION);
        $dTags = $dbc->getTagsByName(DocTags::DESCRIPTION);

        $classInfo = [
            'des' => $dbc->getDescription()->render(),
            'sum' => $dbc->getSummary(),
        ];

        foreach ($dbc->getTags() as $tag) {
            switch ($tag->getName()){
                case DocTags::DESCRIPTION:
                    $classInfo['des'] = $tag->render();
                    break;
                case DocTags::DEFINITION:
                    //
                    break;
                case DocTags::TAG:
                    $value = (string)$tag;
                    $classInfo['tags'][] = $tag->render();
                    break;
            }
        }

        return [];
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

        \var_dump($dbk->getSummary(), $dbk->getTags());

        return [];
    }
}