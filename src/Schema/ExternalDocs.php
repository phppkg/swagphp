<?php
/**
 * Created by PhpStorm.
 * User: inhere
 * Date: 2018-06-05
 * Time: 10:41
 */

namespace SwagPhp\Schema;

/**
 * Class ExternalDocs
 * @package SwagPhp\Schema
 */
class ExternalDocs extends AbstractSchema
{
    /**
     * The URL for the target documentation.
     * @var string
     */
    public $url;

    /**
     * A short description of the target documentation.
     * GFM syntax can be used for rich text representation.
     * @var string
     */
    public $description;

    /** @inheritdoc */
    public static $_types = [
        'url' => 'string',
        'description' => 'string',
    ];

    /** @inheritdoc */
    public static $_required = ['url'];
}