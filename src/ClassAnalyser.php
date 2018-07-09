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
use SwagPhp\Schema\Swagger;

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
     * @var Swagger
     */
    private $swag;

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

        $this->swag = new Swagger();

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
        // load file
        $this->scopedRequire($file->getPathname());

        $class = $namespace . $file->getBasename('.php');

        if (!\class_exists($class)) {
            Logger::warning("class '$class' is not exists!");
            return [];
        }

        $info = [
            'class' => $class,
            'file' => $file->getRealPath(),
        ];

        $this->parser->readClass($class, $this->swag);

        \var_dump($namespace, $class);die;
    }

    protected function scopedRequire(string $class)
    {
        require_once $class;
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