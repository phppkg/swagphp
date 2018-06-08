<?php
/**
 * Created by PhpStorm.
 * User: inhere
 * Date: 2018-06-05
 * Time: 10:41
 */

namespace SwagPhp\Schema;

/**
 * Class Contact
 * @package SwagPhp\Schema
 */
class Contact extends AbstractSchema
{
    use QuicklyCreateTrait;

    /**
     * The identifying name of the contact person/organization.
     * @var string
     */
    public $name;

    /**
     * The URL pointing to the contact information. MUST be in the format of a URL.
     * @var string
     */
    public $url;

    /**
     * The email address of the contact person/organization. MUST be in the format of an email address.
     * @var string
     */
    public $email;

    /** @inheritdoc */
    public static $_types = [
        'name' => 'string',
        'url' => 'string',
        'email' => 'string'
    ];

    /** @inheritdoc */
    public static $_parents = [
        Info::class
    ];
}