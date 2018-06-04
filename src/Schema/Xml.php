<?php
/**
 * Created by PhpStorm.
 * User: inhere
 * Date: 2018-06-05
 * Time: 10:41
 */

namespace SwagPhp\Schema;

/**
 * Class Items
 * @package SwagPhp\Schema
 * A Swagger "XML Object": https://github.com/swagger-api/swagger-spec/blob/master/versions/2.0.md#xmlObject
 */
class Xml extends AbstractSchema
{
    /**
     * Replaces the name of the element/attribute used for the described schema property. When defined within the Items Object (items), it will affect the name of the individual XML elements within the list. When defined alongside type being array (outside the items), it will affect the wrapping element and only if wrapped is true. If wrapped is false, it will be ignored.
     * @var string
     */
    public $name;

    /**
     * The URL of the namespace definition. Value SHOULD be in the form of a URL.
     * @var string
     */
    public $namespace;

    /**
     * The prefix to be used for the name.
     * @var string
     */
    public $prefix;

    /**
     * Declares whether the property definition translates to an attribute instead of an element. Default value is false.
     * @var boolean
     */
    public $attribute;

    /**
     * MAY be used only for an array definition. Signifies whether the array is wrapped (for example, <books><book/><book/></books>) or unwrapped (<book/><book/>). Default value is false. The definition takes effect only when defined alongside type being array (outside the items).
     * @var boolean
     */
    public $wrapped;

    /** @inheritdoc */
    public static $_types = [
        'name' => 'string',
        'namespace' => 'string',
        'prefix' => 'string',
        'attribute' => 'boolean',
        'wrapped' => 'boolean'
    ];

    /** @inheritdoc */
    public static $_parents = [
        Schema::class,
        Property::class,
        Definition::class,
        Items::class,
    ];
}