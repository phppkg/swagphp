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
     * @var array Data storage
     */
    protected $data = [];

    /**
     * Class constructor.
     * @param array $data
     */
    public function __construct(array $data = [])
    {
        $this->data = $data;
    }

    /**
     * @return string Analyser
     */
    public function __toString()
    {
        return \json_encode($this, \JSON_PRETTY_PRINT | \JSON_UNESCAPED_SLASHES | \JSON_UNESCAPED_UNICODE);
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
     * Validate annotation tree, and log notices & warnings.
     * @param array $parents The path of annotations above this annotation in the tree.
     * @param array $skip (prevent stack overflow, when traversing an infinite dependency graph)
     * @param string $ref
     * @return boolean
     */
    public function validate(array $parents = [], array $skip = [], $ref = ''): bool
    {
        return true;
    }

    /**
     * Return a identity for easy debugging.
     * Example: "@SWG\Get(path="/pets")"
     * @return string
     */
    public function identity(): string
    {
        return $this->_identity([]);
    }

    /**
     * Helper for generating the identity()
     * @param array $properties
     * @return string
     */
    protected function _identity($properties): string
    {
        $fields = [];
        foreach ($properties as $property) {
            $value = $this->$property;
            if ($value !== null && $value !== UNDEFINED) {
                $fields[] = $property . '=' . (\is_string($value) ? '"' . $value . '"' : $value);
            }
        }
        return '@' . str_replace('SwagPhp\\Schema\\', 'Swg\\', \get_class($this)) . '(' . \implode(',', $fields) . ')';
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