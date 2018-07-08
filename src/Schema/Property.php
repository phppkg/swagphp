<?php
/**
 * Created by PhpStorm.
 * User: inhere
 * Date: 2018/7/7
 * Time: 下午4:57
 */

namespace SwagPhp\Schema;

/**
 * Class Property - property of a Schema
 * @package SwagPhp\Schema
 */
class Property extends AbstractSchema
{
    /**
     * @var string
     */
    public $name;

    /**
     * The type of the property.
     * @var string
     */
    public $type;

    /**
     * The extending format for the previously mentioned type. See Data Type Formats for further details.
     * @var string
     */
    public $format;

}