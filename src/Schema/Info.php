<?php
/**
 * Created by PhpStorm.
 * User: inhere
 * Date: 2018-06-05
 * Time: 10:41
 */

namespace SwagPhp\Schema;

/**
 * Class Info
 * @package SwagPhp\Schema
 */
class Info extends AbstractSchema
{
    use QuicklyCreateTrait;

    /**
     * Required. The title of the application.
     * @var string
     */
    public $title = '';

    /**
     *  Required Provides the version of the application API (not to be confused with the specification version)
     * @var string
     */
    public $version = '';

    /**
     * A short description of the application. GFM syntax can be used for rich text representation
     * @var string
     */
    public $description = '';

    /**
     * The Terms of Service for the API.
     * @var string
     */
    public $termsOfService;

    /**
     * The contact information for the exposed API.
     * @var Contact
     */
    public $contact;

    /**
     * The license information for the exposed API.
     * @var License
     */
    public $license;

    /** @inheritdoc */
    public static $_required = ['title', 'version'];

    /** @inheritdoc */
    public static $_types = [
        'title' => 'string',
        'description' => 'string',
        'termsOfService' => 'string'
    ];

    /** @inheritdoc */
    public static $_nested = [
        Contact::class => 'contact',
        License::class => 'license'
    ];

    /** @inheritdoc */
    public static $_parents = [
        Swagger::class
    ];
}