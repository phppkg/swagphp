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
     * @var DoctrineParser|PhpDocParser
     */
    protected $parser;

    /**
     * @var string base namespace for find model class. eg 'App'
     */
    protected $baseNamespace;

    /**
     * @var array
     * [namespace => directory path]
     */
    protected $namespaces = [];

    /**
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

    /**
     * @param string $file
     * @return array
     */
    public function fromFile(string $file): array
    {
        $code = \file_get_contents($file);
        $tokens = \token_get_all($code);

        return $this->parseClass($tokens, new Context(['filename' => $file]));
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

        $this->namespaces[$namespace] = $path;
    }

    /**
     * @param array $namespaces
     */
    public function addNamespaces(array $namespaces): void
    {
        foreach ($namespaces as $namespace => $path) {
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