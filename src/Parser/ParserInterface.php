<?php
/**
 * Created by PhpStorm.
 * User: inhere
 * Date: 2018/6/8
 * Time: 上午9:51
 */

namespace SwagPhp\Parser;

use SwagPhp\Context;

/**
 * Interface ParserInterface
 * @package SwagPhp\Parser
 */
interface ParserInterface
{
    /**
     * parse the comment block and return the detected annotations.
     *
     * @param string $comment a T_DOC_COMMENT.
     * @param Context $context
     * @return array Annotations
     */
    public function parseComment(string $comment, Context $context = null): array;
}