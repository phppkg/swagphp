<?php
/**
 * Created by PhpStorm.
 * User: inhere
 * Date: 2018/6/6
 * Time: 上午10:59
 */

namespace SwagPhp;

use SwagPhp\Parser\DoctrineParser;
use SwagPhp\Parser\PhpDocParser;

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
     * @var DoctrineParser|PhpDocParser
     */
    protected $parser;

    /**
     * @var SwagPhp
     */
    protected $collector;

    /**
     * @param string $file
     * @return array
     */
    public function fromFile(string $file): array
    {
        $code = \file_get_contents($file);
        $tokens = \token_get_all($code);

        return $this->parseTokens($tokens, new Context(['filename' => $file]));
    }

    /**
     * @param string $code
     * @param Context $context
     * @return array
     */
    public function formCode(string $code, Context $context): array
    {
        $tokens = \token_get_all($code);

        return $this->parseTokens($tokens, $context);
    }

    public function parseTokens(array $tokens, Context $topContext)
    {
        $previous = null;
        $docComment = null;
        $classDefinition =null;

        $line = 0;
        $lineOffset = $topContext->line ? : 0;
        $topContext->uses = [];
        $collection = new Collection();
        // Use the $topContext until a definitionContext  (class or trait) is created.
        $definitionContext = $topContext;

        foreach ($tokens as $token) {
            // Ignore tokens like "{", "}", ";"
            if (!\is_array($token)) {
                continue;
            }

            // if $token is array:
            // 0 is token ID constants
            // 1 data string
            // 2 line number
            switch ($token[0]) {
                case T_INLINE_HTML:
                    // $newType = self::TOKEN_HTML;
                    break;
                case T_COMMENT:
                    if ($pos = \stripos($token[1], '@oai\\')) {
                        $line = $topContext->line ? $topContext->line + $token[2] : $token[2];
                        $commentContext = new Context(['line' => $line], $topContext);
                        Logger::notice('Annotations are only parsed inside `/**` DocBlocks, skipping ' . $commentContext);
                    }

                    break;
                case T_DOC_COMMENT: // /** doc comments */
                    if ($docComment) {
                        $annotations = $this->parseComment($collection, $docComment, new Context(['line' => $line], $definitionContext));
                    }

                    $docComment = $token[1];

                    break;
                case T_ENCAPSED_AND_WHITESPACE:
                case T_CONSTANT_ENCAPSED_STRING:
                    $newType = self::TOKEN_STRING;
                    break;
                case T_WHITESPACE:
                    break;
                case T_OPEN_TAG:
                case T_OPEN_TAG_WITH_ECHO:
                case T_CLOSE_TAG:
                case T_STRING:
                case T_VARIABLE:
                    // Constants
                case T_DIR:
                case T_FILE:
                case T_METHOD_C:
                case T_DNUMBER:
                case T_LNUMBER:
                case T_NS_C:
                case T_LINE:
                case T_CLASS_C:
                case T_FUNC_C:
                case T_TRAIT_C:
                    $newType = self::TOKEN_DEFAULT;
                    break;
                default:
                    // Compatibility with PHP 5.3
                    if (\defined('T_TRAIT_C') && $token[0] === T_TRAIT_C) {
                        $newType = self::TOKEN_DEFAULT;
                    } else {
                        $newType = self::TOKEN_KEYWORD;
                    }
            }

            // record previous
            $previous = $token;
        }

        return [];
    }

    protected function parseComment(Collection $collection, string $docComment, Context $context): array
    {
        $annotations = $this->parser->parseComment($docComment, $context);

        $collection->addAnnotations($annotations, $context);
    }
}