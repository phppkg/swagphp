<?php
/**
 * Created by PhpStorm.
 * User: inhere
 * Date: 2018-06-05
 * Time: 10:41
 */

namespace SwagPhp\Schema;

/**
 * Class Schema
 * @package SwagPhp\Schema
 */
class Schema extends AbstractSchema
{
    use JsonSchemaTrait;

    /**
     * $ref See http://json-schema.org/latest/json-schema-core.html#rfc.section.7
     * @var string
     */
    public $ref;

    /**
     * Can be used to decorate a user interface with information about the data produced by this user interface. preferrably be short.
     * @var string
     */
    public $title;

    /**
     * A description will provide explanation about the purpose of the instance described by this schema.
     * @var string
     */
    public $description;

    /**
     * An object instance is valid against "maxProperties" if its number of properties is less than, or equal to, the value of this property.
     * @var integer
     */
    public $maxProperties;

    /**
     * An object instance is valid against "minProperties" if its number of properties is greater than, or equal to, the value of this property.
     * @var integer
     */
    public $minProperties;

    /**
     * An object instance is valid against this property if its property set contains all elements in this property's array value.
     * @var string[]
     */
    public $required;

    /**
     * @var Property[]
     */
    public $properties;

    /**
     * The type of the schema/property. The value MUST be one of "string", "number", "integer", "boolean", "array" or "object".
     * @var string
     */
    public $type;

    /**
     * The extending format for the previously mentioned type. See Data Type Formats for further details.
     * @var string
     */
    public $format;

    /**
     * Required if type is "array". Describes the type of items in the array.
     * @var Items
     */
    public $items;

    /**
     * @var string Determines the format of the array if type array is used. Possible values are: csv - comma separated values foo,bar. ssv - space separated values foo bar. tsv - tab separated values foo\tbar. pipes - pipe separated values foo|bar. multi - corresponds to multiple parameter instances instead of multiple values for a single instance foo=bar&foo=baz. This is valid only for parameters in "query" or "formData". Default value is csv.
     */
    public $collectionFormat;

    /**
     * Sets a default value to the parameter. The type of the value depends on the defined type. See http://json-schema.org/latest/json-schema-validation.html#anchor101.
     * @var mixed
     */
    public $default = UNDEFINED;

    /**
     * Adds support for polymorphism. The discriminator is the schema property name that is used to differentiate between other schemas that inherit this schema. The property name used MUST be defined at this schema and it MUST be in the required property list. When used, the value MUST be the name of this schema or any schema that inherits it.
     * @var string
     */
    public $discriminator;

    /**
     * Relevant only for Schema "properties" definitions. Declares the property as "read only". This means that it MAY be sent as part of a response but MUST NOT be sent as part of the request. Properties marked as readOnly being true SHOULD NOT be in the required list of the defined schema. Default value is false.
     * @var boolean
     */
    public $readOnly;

    /**
     * This MAY be used only on properties schemas. It has no effect on root schemas. Adds Additional metadata to describe the XML representation format of this property.
     * @var Xml
     */
    public $xml;

    /**
     * Additional external documentation for this schema.
     * @var ExternalDoc
     */
    public $externalDocs;

    /**
     * A free-form property to include a an example of an instance for this schema.
     * @var array
     */
    public $example;

    /**
     * An instance validates successfully against this property if it validates successfully against all schemas defined by this property's value.
     * @var Schema[]
     */
    public $allOf;

    /**
     * http://json-schema.org/latest/json-schema-validation.html#anchor64
     * @var bool|object
     */
    public $additionalProperties;

    /** @inheritdoc */
    public static $_types = [
        'description' => 'string',
        'required' => '[string]',
        'format' => 'string',
        'collectionFormat' => ['csv', 'ssv', 'tsv', 'pipes', 'multi'],
        'maximum' => 'number',
        'exclusiveMaximum' => 'boolean',
        'minimum' => 'number',
        'exclusiveMinimum' => 'boolean',
        'maxLength' => 'integer',
        'minLength' => 'integer',
        'pattern' => 'string',
        'maxItems' => 'integer',
        'minItems' => 'integer',
        'uniqueItems' => 'boolean',
        'multipleOf' => 'integer',
    ];

    /** @inheritdoc */
    public static $_nested = [
        Items::class => 'items',
        Property::class => ['properties', 'property'],
        ExternalDoc::class => 'externalDocs',
        Xml::class => 'xml'
    ];

    /** @inheritdoc */
    public static $_parents = [
        Response::class,
        Parameter::class,
    ];
}