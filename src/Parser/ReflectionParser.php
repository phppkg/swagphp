<?php
/**
 * Created by PhpStorm.
 * User: inhere
 * Date: 2018/6/6
 * Time: 上午9:27
 */

namespace SwagPhp\Analyser;

/**
 * Class ReflectionAnalyser
 * @package SwagPhp\Analyser
 */
class ReflectionParser
{
    /**
     * @var array
     * [
     *  class => class reflection,
     * ]
     */
    private static $caches = [];

    /**
     * @param string $class
     * @return \ReflectionClass
     * @throws \ReflectionException
     */
    public static function getClass(string $class): \ReflectionClass
    {
        if (!isset(self::$caches[$class])) {
            self::$caches[$class] = new \ReflectionClass($class);
        }

        return self::$caches[$class];
    }

    /**
     * @param string $class
     * @param string $method
     * @return \ReflectionMethod
     * @throws \ReflectionException
     */
    public static function getMethod(string $class, string $method): \ReflectionMethod
    {
        $refClass = self::getClass($class);

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
        $refClass = self::getClass($class);

        return $refClass->getMethods($filter);
    }
}