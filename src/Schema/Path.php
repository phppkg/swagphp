<?php
/**
 * Created by PhpStorm.
 * User: inhere
 * Date: 2018-06-05
 * Time: 10:41
 */

namespace SwagPhp\Schema;

/**
 * Class Path - Path Item Object
 * @link https://github.com/OAI/OpenAPI-Specification/blob/master/versions/2.0.md#path-item-object
 * @package SwagPhp\Schema
 */
class Path extends AbstractSchema
{
    /**
     * $ref See http://json-schema.org/latest/json-schema-core.html#rfc.section.7
     * @var string
     */
    public $ref;

    /**
     * key in the Swagger "Paths Object" for this path.
     * @var string
     */
    public $path;

    /**
     * A definition of a GET operation on this path.
     * @var Operation|Get
     */
    public $get;

    /**
     * A definition of a PUT operation on this path.
     * @var Operation|Put
     */
    public $put;

    /**
     * A definition of a POST operation on this path.
     * @var Operation|Post
     */
    public $post;

    /**
     * A definition of a DELETE operation on this path.
     * @var Operation|Delete
     */
    public $delete;

    /**
     * A definition of a OPTIONS operation on this path.
     * @var Operation|Options
     */
    public $options;

    /**
     * A definition of a HEAD operation on this path.
     * @var Operation|Head
     */
    public $head;

    /**
     * A definition of a PATCH operation on this path.
     * @var Operation|Patch
     */
    public $patch;

    /**
     * A list of parameters that are applicable for all the operations described under this path. These parameters can be overridden at the operation level, but cannot be removed there. The list MUST NOT include duplicated parameters. A unique parameter is defined by a combination of a name and location. The list can use the Reference Object to link to parameters that are defined at the Swagger Object's parameters. There can be one "body" parameter at most.
     * @var Parameter[]
     */
    public $parameters;

    /** @inheritdoc */
    public static $_types = [
        'path' => 'string'
    ];

    /** @inheritdoc */
    public static $_nested = [
        // 'Swagger\Annotations\Get' => 'get',
        // 'Swagger\Annotations\Post' => 'post',
        // 'Swagger\Annotations\Put' => 'put',
        // 'Swagger\Annotations\Delete' => 'delete',
        // 'Swagger\Annotations\Patch' => 'patch',
        // 'Swagger\Annotations\Head' => 'head',
        // 'Swagger\Annotations\Options' => 'options',
        // 'Swagger\Annotations\Parameter' => ['parameters'],
    ];

    /** @inheritdoc */
    public static $_parents = [
        Swagger::class,
    ];
}