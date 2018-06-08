<?php
/**
 * Created by PhpStorm.
 * User: inhere
 * Date: 2018-06-05
 * Time: 10:41
 */

namespace SwagPhp\Schema;

/**
 * Class Parameter
 * @package SwagPhp\Schema
 */
class Parameter extends AbstractSchema
{
    use JsonSchemaTrait;
    use QuicklyCreateTrait;

    /**
     * $ref See http://json-schema.org/latest/json-schema-core.html#rfc.section.7
     * @var string
     */
    public $ref;

    /**
     * The key into Swagger->parameters or Path->parameters array.
     * @var string
     */
    public $parameter;

    /**
     * The name of the parameter. Parameter names are case sensitive. If in is "path", the name field MUST correspond to the associated path segment from the path field in the Paths Object. See Path Templating for further information. For all other cases, the name corresponds to the parameter name used based on the in property.
     * @var string
     */
    public $name;

    /**
     * The location of the parameter. Possible values are "query", "header", "path", "formData" or "body".
     * @var string
     */
    public $in;

    /**
     * A brief description of the parameter. This could contain examples of use. GFM syntax can be used for rich text representation.
     * @var string
     */
    public $description;

    /**
     * Determines whether this parameter is mandatory. If the parameter is in "path", this property is required and its value MUST be true. Otherwise, the property MAY be included and its default value is false.
     * @var boolean
     */
    public $required;

    /**
     * The schema defining the type used for the body parameter.
     * @var Schema
     */
    public $schema;

    /**
     * The type of the parameter. Since the parameter is not located at the request body, it is limited to simple types (that is, not an object). The value MUST be one of "string", "number", "integer", "boolean", "array" or "file". If type is "file", the consumes MUST be either "multipart/form-data" or " application/x-www-form-urlencoded" and the parameter MUST be in "formData".
     * @var string
     */
    public $type;

    /**
     * The extending format for the previously mentioned type. See Data Type Formats for further details.
     * @var string
     */
    public $format;

    /**
     * Sets the ability to pass empty-valued parameters. This is valid only for either query or formData parameters and allows you to send a parameter with a name only or an empty value. Default value is false.
     * @var boolean
     */
    public $allowEmptyValue;

    /**
     * Required if type is "array". Describes the type of items in the array.
     * @var Items
     */
    public $items;

    /**
     * Determines the format of the array if type array is used. Possible values are: csv - comma separated values foo,bar. ssv - space separated values foo bar. tsv - tab separated values foo\tbar. pipes - pipe separated values foo|bar. multi - corresponds to multiple parameter instances instead of multiple values for a single instance foo=bar&foo=baz. This is valid only for parameters in "query" or "formData". Default value is csv.
     * @var string
     */
    public $collectionFormat;

    /**
     * Sets a default value to the parameter. The type of the value depends on the defined type. See http://json-schema.org/latest/json-schema-validation.html#anchor101.
     * @var mixed
     */
    public $default = UNDEFINED;

    /** @inheritdoc */
    public static $_required = ['name', 'in'];

    /** @inheritdoc */
    public static $_types = [
        'name' => 'string',
        'in' => ['query', 'header', 'path', 'formData', 'body'],
        'description' => 'string',
        'required' => 'boolean',
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
        'Swagger\Annotations\Items' => 'items',
        'Swagger\Annotations\Schema' => 'schema'
    ];
}