<?php
/**
 * Created by PhpStorm.
 * User: inhere
 * Date: 2018/6/8
 * Time: 上午9:25
 */

namespace SwagPhp;

use SwagPhp\Parser\DoctrineParser;
use SwagPhp\Parser\ParserInterface;
use SwagPhp\Parser\PhpDocParser;

/**
 * Class ClassAnalyser
 * - only support analysis php class files
 * @package SwagPhp
 */
class ClassAnalyser
{
    /**
     * @var array
     */
    private static $reflections = [];

    /**
     * @var DoctrineParser|PhpDocParser
     */
    protected $parser;

    /**
     * @var string base namespace for find model class. eg 'App'
     */
    protected $baseNamespace;

    /**
     * class namespaces map
     * @var array
     * [namespace => directory path]
     */
    protected $namespaces = [];

    /**
     * class list
     * @var array
     * [full class => 1]
     */
    protected $classes = [];

    /**
     * Class constructor.
     * @param ParserInterface $parser
     */
    public function __construct(ParserInterface $parser)
    {
        $this->parser = $parser;
    }

    public function analysis(array $namespaces, SwagPhp $manager,array $opts = [])
    {
        $finder = null;
        $this->addNamespaces($namespaces);

        foreach ($this->namespaces as $namespace => $dir) {
            $finder = SwagUtil::NewFinder($dir, $opts['excludes']);

            foreach ($finder as $file) {
                $collection = $this->fromClass($namespace, $file);
                $manager->collect($collection);
            }
        }

        if ($finder) {
            unset($finder);
        }
    }

    /**
     * @param string $namespace
     * @param \SplFileInfo $file
     * @return array
     */
    public function fromClass(string $namespace, \SplFileInfo $file): array
    {
        // $code = \file_get_contents($file);
        // $tokens = \token_get_all($code);
        // return $this->parseClass($tokens, new Context(['filename' => $file]));

        $class = $namespace . $file->getBasename('.php');

        if (!\class_exists($class)) {
            Logger::warning("class '$class' is not exists!");
            return [];
        }

        $info = [
            'class' => $class,
            'file' => $file->getRealPath(),
        ];

        $this->parser->readClass($class);

        \var_dump($namespace, $class);die;
    }

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
     * @param string $class
     */
    public function addClass(string $class): void
    {
        if (\class_exists($class, true)) {
            $this->classes[$class] = 1;
        }
    }

    /**
     * @return array
     */
    public function getNamespaces(): array
    {
        return $this->namespaces;
    }

    /**
     * @param string $namespace
     * @param string $path
     */
    public function addNamespace(string $namespace, string $path): void
    {
        $path = \rtrim($path, '/\\ ');
        $namespace = \rtrim($namespace, '\\ ');

        if (!$namespace || !$path) {
            return;
        }

        $this->namespaces[$namespace . '\\'] = $path;
    }

    /**
     * @param array $namespaces
     */
    public function addNamespaces(array $namespaces): void
    {
        foreach ($namespaces as $namespace => $path) {
            if (!\is_string($namespace)) {
                Logger::warning("add namespace map param error, key $namespace val $path");
                continue;
            }

            $this->addNamespace($namespace, $path);
        }
    }

    /**
     * @param array $namespaces
     */
    public function setNamespaces(array $namespaces): void
    {
        $this->namespaces = $namespaces;
    }

}