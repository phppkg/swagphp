<?php
/**
 * Created by PhpStorm.
 * User: inhere
 * Date: 2018/6/6
 * Time: 上午10:59
 */

namespace SwagPhp;

/**
 * Class AbstractAnalyser
 * @package SwagPhp
 */
class TokenAnalyser
{
    /**
     * @var string base namespace for find model class. eg 'App'
     */
    protected $baseNamespace;

    /**
     * @param string $file
     */
    public function formFile(string $file)
    {
        $code = \file_get_contents($file);
        $tokens = \token_get_all($code);

        return $this->parseTokens($tokens, new Context(['filename' => $file]));
    }

    /**
     * @param string $code
     * @param Context $context
     */
    public function formCode(string $code, Context $context)
    {
        $tokens = \token_get_all($code);

        return $this->parseTokens($tokens, $context);
    }

    public function parseTokens(array $tokens, Context $context)
    {
        $token = '';

        while ($token !== false) {
            $prev = $token;
        }
    }

    /**
     * The next non-whitespace, non-comment token.
     *
     * @param array $tokens
     * @param Context $context
     * @return string|array The next token (or false)
     */
    private function nextToken(&$tokens, $context)
    {
        while (true) {
            $token = next($tokens);
            if ($token[0] === T_WHITESPACE) {
                continue;
            }
            if ($token[0] === T_COMMENT) {
                $pos = strpos($token[1], '@SWG\\');
                if ($pos) {
                    $line = $context->line ? $context->line + $token[2] : $token[2];
                    $commentContext = new Context(['line' => $line], $context);
                    Logger::notice('Annotations are only parsed inside `/**` DocBlocks, skipping ' . $commentContext);
                }
                continue;
            }
            return $token;
        }
    }
}