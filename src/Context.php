<?php
/**
 * Created by PhpStorm.
 * User: inhere
 * Date: 2018/6/5
 * Time: 上午11:11
 */

namespace SwagPhp;

/**
 * Class Context
 * @package SwagPhp
 *
 * @property string $comment  The PHP DocComment
 * @property string $filename
 * @property int $line
 * @property int $character
 *
 * @property string $namespace
 * @property array $uses
 * @property string $class
 * @property string $extends
 * @property string $method
 * @property string $property
 *
 * @property Schema\AbstractSchema[] $annotations
 */
class Context
{
    /**
     * @var Context
     */
    private $parent;

    /**
     * @param array $properties new properties for this context.
     * @param Context $parent The parent context
     */
    public function __construct(array $properties = [], $parent = null)
    {
        foreach ($properties as $property => $value) {
            $this->$property = $value;
        }

        $this->parent = $parent;
    }

    /**
     * @return Context
     */
    public function getRootContext(): self
    {
        if ($this->parent) {
            return $this->parent->getRootContext();
        }

        return $this;
    }

    /**
     * Traverse the context tree to get the property value.
     *
     * @param string $property
     * @return mixed
     */
    public function __get($property)
    {
        if ($this->parent) {
            return $this->parent->$property;
        }

        return null;
    }

    /**
     * @param string $property
     * @param $value
     */
    public function __set($property, $value)
    {
    }

    /**
     * @param string $property
     * @return bool
     */
    public function __isset(string $property)
    {
        return $this->is($property);
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return $this->getDebugLocation();
    }

    /**
     * @param string $property
     * @return bool
     */
    public function is(string $property): bool
    {
        return \property_exists($this, $property);
    }

    /**
     * @param string $property
     * @return bool
     */
    public function not(string $property): bool
    {
        return !\property_exists($this, $property);
    }

    /**
     * @return string
     */
    protected function getDebugLocation(): string
    {
        return \sprintf('file %s on line %d', $this->filename, $this->line);
    }
}