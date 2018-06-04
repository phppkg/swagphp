<?php
/**
 * Created by PhpStorm.
 * User: inhere
 * Date: 2018-06-05
 * Time: 10:41
 */

namespace SwagPhp\Schema;

/**
 * Class License
 * @package SwagPhp\Schema
 */
class License extends AbstractSchema
{
    /**
     * The license name used for the API.
     * @var string
     */
    public $name;

    /**
     * A URL to the license used for the API.
     * @var string
     */
    public $url;

    /** @inheritdoc */
    public static $_types = [
        'name' => 'string',
        'url' => 'string',
    ];

    /** @inheritdoc */
    public static $_required = ['name'];

    /** @inheritdoc */
    public static $_parents = [
        Info::class
    ];
}