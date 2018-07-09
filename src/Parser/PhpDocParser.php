<?php
/**
 * Created by PhpStorm.
 * User: inhere
 * Date: 2018/6/5
 * Time: 下午4:26
 */

namespace SwagPhp\Parser;

use phpDocumentor\Reflection\DocBlock;
use phpDocumentor\Reflection\DocBlockFactory;
use phpDocumentor\Reflection\Types\ContextFactory;
use SwagPhp\Context;
use SwagPhp\DocTags;
use SwagPhp\Schema;
use SwagPhp\Schema\Swagger;

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
            // 'Tag' => Tag::class,
        ]);
    }

    public function tagHandlers(): array
    {
        return [];
    }

    public function readClass(string $class, Swagger $swag): array
    {
        $factory = $this->factory;
        $refClass = self::getReflection($class);
        $classDoc = \trim($refClass->getDocComment());

        $ctx = new ContextFactory();
        $dbc = $factory->create($classDoc, $ctx->createFromReflector($refClass));

        $cInfo = $this->collectClassTags($dbc, $swag);

        if ($refClass->isInterface() || $refClass->isTrait()) {
            return [];
        }

        if ($cInfo['isDef']) {
            // $refClass->getDefaultProperties() 属性默认值数组： [prop => def value]
            foreach ($refClass->getProperties() as $prop) {
                if ($prop->isStatic()) {
                    continue;
                }

                $propDoc = $prop->getDocComment();
                $dbc = $factory->create($propDoc, $ctx->createFromReflector($prop));
                $this->collectPropertyTags($dbc, $swag);
            }

            return [];
        }

        if ($cInfo['isApi']) {
            foreach ($refClass->getMethods(\ReflectionMethod::IS_PUBLIC) as $refM) {
                if ($refM->isStatic() || $refM->isAbstract()) {
                    continue;
                }

                $name = $refM->getName();
                $sName = $refM->getShortName();

                if ($sName[0] === '_') {
                    continue;
                }

                $methodDoc = $refM->getDocComment();
                $dbc = $factory->create($methodDoc, $ctx->createFromReflector($refM));
                $this->collectMethodTags($dbc, $swag);
            }
        }

        return [];
    }

    protected function collectClassTags(DocBlock $dbc, Swagger $swag)
    {
        $dbc->hasTag(DocTags::DESCRIPTION);
        $dTags = $dbc->getTagsByName(DocTags::DESCRIPTION);

        $classInfo = [
            'isApi' => false,
            'isDef' => false,
            'def' => null,
            'des' => $dbc->getDescription()->render(),
            'sum' => $dbc->getSummary(),
        ];

        $inDef = false;

        foreach ($dbc->getTags() as $tag) {
            switch ($tag->getName()){
                case DocTags::DESCRIPTION:
                    $classInfo['des'] = $tag->render();
                    break;
                case DocTags::DEFINITION:
                    $inDef = true;
                    $def = Schema\Definition::createFromPhpDoc((string)$tag);
                    $classInfo['def'] = $def;
                    $classInfo['isDef'] = true;
                    break;
                case DocTags::PROPERTY:
                    if ($inDef) {

                    }
                    $classInfo['isDef'] = true;
                    break;
                case DocTags::TAG: // add new tag
                    $s = Schema\Tag::createFromPhpDoc((string)$tag);
                    $swag->tags[$s->name] = $s;
                    break;
                case DocTags::TAGS: // add tag for current api
                    $s = Schema\Tag::createFromPhpDoc((string)$tag);
                    $swag->tags[$s->name] = $s;
                    break;
            }
        }
    }

    protected function collectPropertyTags(DocBlock $dbc, Swagger $swag)
    {

    }

    protected function collectMethodTags(DocBlock $dbc, Swagger $swag)
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

        // \var_dump($dbk->getSummary(), $dbk->getTags());

        return [];
    }
}