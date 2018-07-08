<?php
/**
 * Created by PhpStorm.
 * User: inhere
 * Date: 2018/7/7
 * Time: 下午8:11
 */

namespace SwagPhp\Parser\DocTags;

use phpDocumentor\Reflection\DocBlock\Description;
use phpDocumentor\Reflection\DocBlock\Tags\BaseTag;
use phpDocumentor\Reflection\DocBlock\Tags\Factory\StaticMethod;
use Webmozart\Assert\Assert;

/**
 * Class Tag
 * @package SwagPhp\Parser\DocBlock
 */
class Tag extends BaseTag implements StaticMethod
{
    public $name = 'Tag';

    /** @var string  */
    public $rawBody = '';

    /** @var string  */
    public $tagName = '';

    /** @var string  */
    public $tagDes = '';

    /**
     * Initializes this tag.
     *
     * @param string $tagName
     * @param Description $description
     */
    public function __construct(string $tagName, Description $description = null)
    {
        $this->tagName = $tagName;

        if ($description) {
            $this->tagDes = $description->render();
        }

        $this->description = $description;
    }

    public static function create($body)
    {
        Assert::notEmpty($body);

        $des = '';
        $parts = preg_split('/\s+/Su', $body, 2);

        if (isset($parts[1])) {
            $des = \trim($parts[1], '"\'');
        }

        $self = new self($parts[0], new Description($des));
        $self->rawBody = $body;

        return $self;
    }

    public function __toString()
    {
        return $this->rawBody;
    }
}