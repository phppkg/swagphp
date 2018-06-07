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

    /**
     * @param string $source
     * @return array
     * @link http://cn2.php.net/manual/en/function.token-get-all.php#91847
     */
    public static function tokenGetAll(string $source): array
    {
        // Get the tokens
        $tokens = \token_get_all($source);
        $newTokens = [];

        // Split newlines into their own tokens
        foreach ($tokens as $token) {
            $tokenName = \is_array($token) ? $token[0] : null;
            $tokenData = \is_array($token) ? $token[1] : $token;

            // Do not split encapsed strings or multi-line comments
            if ($tokenName === T_CONSTANT_ENCAPSED_STRING || 0 === \strpos($tokenData, '/*')) {
                $newTokens[] = [$tokenName, $tokenData];
                continue;
            }

            // Split the data up by newlines
            $splitData = \preg_split(
                '#(\r\n|\n)#',
                $tokenData,
                -1,
                PREG_SPLIT_DELIM_CAPTURE | PREG_SPLIT_NO_EMPTY
            );

            foreach ($splitData as $data) {
                if ($data === "\r\n" || $data === "\n") {
                    // This is a new line token
                    $newTokens[] = [T_NEW_LINE, $data];
                } else {
                    // Add the token under the original token name
                    $newTokens[] = \is_array($token) ? [$tokenName, $data] : $data;
                }
            }
        }

        return $newTokens;
    }

    /**
     * @param int $token
     * @return string
     */
    public static function tokenName(int $token): string
    {
        if ($token === T_NEW_LINE) {
            return 'T_NEW_LINE';
        }

        return \token_name($token);
    }
}