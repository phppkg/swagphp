<?php
/**
 * Created by PhpStorm.
 * User: inhere
 * Date: 2018-06-05
 * Time: 10:41
 */

namespace SwagPhp\Schema;

/**
 * Class AbstractSchema
 * @package SwagPhp\Schema
 */
class AbstractSchema implements \JsonSerializable, \IteratorAggregate
{
    /**
     * @var array there are required properties
     */
    public static $_required = [];

    /**
     * Specify the type of the property.
     * Examples:
     *   'name' => 'string' // a string
     *   'required' => 'boolean', // true or false
     *   'tags' => '[string]', // array containing strings
     *   'in' => ["query", "header", "path", "formData", "body"] // must be one on these
     * @var array
     */
    public static $_types = [];

    /**
     * Reverse mapping of $_nested with the allowed parent annotations.
     * @var string[]
     */
    public static $_parents = [];

    /**
     * List of properties are blacklisted from the JSON output.
     * @var array
     */
    public static $_blacklist = ['_context', '_unmerged'];

    /**
     * @return string Analyser
     */
    public function __toString()
    {
        return \json_encode($this, \JSON_PRETTY_PRINT | \JSON_UNESCAPED_SLASHES);
    }

    /**
     * @return array
     */
    public function __debugInfo(): array
    {
        $properties = [];

        foreach (\get_object_vars($this) as $property => $value) {
            if ($value !== UNDEFINED) {
                $properties[$property] = $value;
            }
        }
        return $properties;
    }

    /**
     * @return array
     */
    public function all(): array
    {
        $properties = [];

        foreach (\get_object_vars($this) as $property => $value) {
            if (!\in_array($property, static::$_blacklist, true)) {
                $properties[$property] = $value;
            }
        }

        return $properties;
    }

    /**
     * Customize the way json_encode() renders the annotations.
     * @return array
     */
    public function jsonSerialize(): array
    {
        return $this->all();
    }

    /**
     * Retrieve an external iterator
     * @link http://php.net/manual/en/iteratoraggregate.getiterator.php
     * @return \Traversable An instance of an object implementing <b>Iterator</b> or
     * <b>Traversable</b>
     * @since 5.0.0
     */
    public function getIterator(): \Traversable
    {
        return new \ArrayIterator($this->all());
        // return new \ArrayObject();
    }

    /**
     * @param string $type
     * @param mixed $value
     * @return bool|null
     */
    private function validateType($type, $value): ?bool
    {
        if ($type[0] === '[' && substr($type, -1) === ']') { // Array of a specified type?
            if ($this->validateType('array', $value) === false) {
                return false;
            }

            $itemType = substr($type, 1, -1);

            foreach ($value as $i => $item) {
                if ($this->validateType($itemType, $item) === false) {
                    return false;
                }
            }
            return true;
        }

        switch ($type) {
            case 'string':
                return \is_string($value);
            case 'boolean':
                return \is_bool($value);
            case 'integer':
                return \is_int($value);
            case 'number':
                return \is_numeric($value);
            case 'array':
                if (\is_array($value) === false) {
                    return false;
                }
                $count = 0;
                foreach ($value as $i => $item) {
                    if ($count !== $i) { // not a array, but a hash/map
                        return false;
                    }
                    $count++;
                }
                return true;
            case 'scheme':
                return \in_array($value, ['http', 'https', 'ws', 'wss']);
            default:
                throw new \InvalidArgumentException('Invalid type "' . $type . '"');
        }
    }

}