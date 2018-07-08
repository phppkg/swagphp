<?php
/**
 * Created by PhpStorm.
 * User: inhere
 * Date: 2018-06-05
 * Time: 10:41
 */

namespace SwagPhp\Schema;

use Webmozart\Assert\Assert;

/**
 * Class Items  A Swagger "Tag Object":
 * @link https://github.com/swagger-api/swagger-spec/blob/master/versions/2.0.md#tagObject
 * @package SwagPhp\Schema
 */
class Tag extends AbstractSchema
{
    /**
     * The name of the tag.
     * @var string
     */
    public $name;

    /**
     * A short description for the tag. GFM syntax can be used for rich text representation.
     * @var string
     */
    public $description;

    /**
     * Additional external documentation for this tag.
     * @var ExternalDocs
     */
    public $externalDocs;

    /** @inheritdoc */
    public static $_required = ['name'];

    /** @inheritdoc */
    public static $_types = [
        'name' => 'string',
        'description' => 'string',
    ];

    /** @inheritdoc */
    public static $_parents = [
        Swagger::class,
    ];

    /** @inheritdoc */
    public static $_nested = [
        ExternalDocs::class => 'externalDocs'
    ];

    public static function createFromPhpDoc(string $docBody): self
    {
        Assert::notEmpty($docBody);

        $des = '';
        $parts = preg_split('/\s+/Su', $docBody, 2);

        if (isset($parts[1])) {
            $des = \trim($parts[1], '"\'');
        }

        $self = new static([
            'name' => $parts[0],
            'description' => $des
        ]);
        //$self->rawBody = $docBody;

        return $self;
    }
}