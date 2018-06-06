<?php
/**
 * Created by PhpStorm.
 * User: inhere
 * Date: 2018/6/5
 * Time: 下午4:25
 */

namespace SwagPhp\Analyser;

/**
 * Class TokenAnalyser
 * - extracts annotations from php code using static analysis(by token_get_all).
 * @package SwagPhp\Analyser
 */
class TokenParser
{
    /**
     * @var array
     */
    private static $caches = [];

    /**
     * @param string $file
     * @return \Generator
     */
    public static function formFile(string $file)
    {
        $code = \file_get_contents($file);

        return self::formCode($code);
    }

    /**
     * @param string $code
     * @return \Generator
     */
    public static function formCode(string $code)
    {
        $tokens = \token_get_all($code);

        foreach ($tokens as $index => $token) {
            yield $index => $token;
        }
    }
}