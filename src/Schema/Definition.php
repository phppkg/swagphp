<?php
/**
 * Created by PhpStorm.
 * User: inhere
 * Date: 2018-06-05
 * Time: 10:41
 */

namespace SwagPhp\Schema;

/**
 * Class Definition
 * @package SwagPhp\Schema
 */
class Definition extends AbstractSchema
{
   /**
     * The key into Swagger->definitions array.
     * @var string
     */
    public $name;

    /** @inheritdoc */
    public static $_types = [
        'name' => 'string'
    ];

    /** @inheritdoc */
    public static $_parents = [
        Swagger::class,
    ];

    public function __get($property)
    {
        if (\property_exists($this, $property)) {
            return $this->$property;
        }

        // $properties = \get_object_vars($this);
        // Logger::notice('Property "' . $property . '" doesn\'t exist in a ' . $this->identity() . ', existing properties: "' . implode('", "', array_keys($properties)) . '" in ' . $this->_context);
    }

    public function __set($property, $value)
    {
        if (\property_exists($this, $property)) {
            $this->$property = $value;
        }
    }

    public function __isset($property)
    {
        return \property_exists($this, $property);
    }
}