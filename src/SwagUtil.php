<?php
/**
 * Created by PhpStorm.
 * User: inhere
 * Date: 2018/6/5
 * Time: 下午2:56
 */

namespace SwagPhp;

use Toolkit\File\FileFinder;

/**
 * Class SwagUtil
 * @package SwagPhp
 */
class SwagUtil
{
    /**
     * @param string $swaggerJson
     * @return string
     */
    public static function jsonToMarkdown(string $swaggerJson): string
    {
        return '';
    }

    /**
     * @param string $swaggerYml
     * @return string
     */
    public static function ymlToMarkdown(string $swaggerYml): string
    {
        return '';
    }

    /**
     * @param string|array|FileFinder $directory
     * @param null $exclude
     * @return FileFinder
     */
    public static function NewFinder($directory, $exclude = null): FileFinder
    {
        if ($directory instanceof FileFinder) {
            return $directory;
        }

        $finder = new FileFinder();
        // $finder->sortByName();

        $finder->files()->followLinks(true)->name('*.php');

        if (\is_string($directory)) {
            if (\is_file($directory)) { // Scan a single file?
                $finder->append([$directory]);
            } else { // Scan a directory
                $finder->in($directory);
            }
        } elseif (\is_array($directory)) {
            foreach ($directory as $path) {
                if (\is_file($path)) { // Scan a file?
                    $finder->append([$path]);
                } else {
                    $finder->in($path);
                }
            }
        } else {
            throw new \InvalidArgumentException('Unexpected $directory value:' . \gettype($directory));
        }

        if ($exclude) {
            if (\is_string($exclude)) {
                $finder->notPath($exclude);
            } elseif (\is_array($exclude)) {
                $finder->addNotPaths($exclude);
            } else {
                throw new \InvalidArgumentException('Unexpected $exclude value:' . \gettype($exclude));
            }
        }

        return $finder;
    }

    /**
     * @var array
     * [
     *  class => class reflection,
     * ]
     */
    private static $reflectCaches = [];

    /**
     * @param string $class
     * @return \ReflectionClass
     * @throws \ReflectionException
     */
    public static function reflectClass(string $class): \ReflectionClass
    {
        if (!isset(self::$reflectCaches[$class])) {
            self::$reflectCaches[$class] = new \ReflectionClass($class);
        }

        return self::$reflectCaches[$class];
    }

    /**
     * @param string $class
     * @param string $method
     * @return \ReflectionMethod
     * @throws \ReflectionException
     */
    public static function getMethod(string $class, string $method): \ReflectionMethod
    {
        $refClass = self::reflectClass($class);

        if (!$refClass->hasMethod($method)) {
            throw new \InvalidArgumentException("Method $method not exists in the $class");
        }

        return $refClass->getMethod($method);
    }

    /**
     * @param string $class
     * @param int|null $filter
     * @return \ReflectionMethod[]
     * @throws \ReflectionException
     */
    public static function getMethods(string $class, int $filter = null): array
    {
        return self::reflectClass($class)->getMethods($filter);
    }
}