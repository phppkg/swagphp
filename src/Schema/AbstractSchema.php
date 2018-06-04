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
class AbstractSchema implements \JsonSerializable
{

    public function __toString()
    {
        return json_encode($this, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);
    }

    /**
     * Customize the way json_encode() renders the annotations.
     * @return array
     */
    public function jsonSerialize()
    {}

    private function validateType($type, $value)
    {
        if (substr($type, 0, 1) === '[' && substr($type, -1) === ']') { // Array of a specified type?
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
                return is_string($value);
            case 'boolean':
                return is_bool($value);
            case 'integer':
                return is_int($value);
            case 'number':
                return is_numeric($value);
            case 'array':
                if (is_array($value) === false) {
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
                return in_array($value, ['http', 'https', 'ws', 'wss']);
            default:
                throw new Exception('Invalid type "' . $type . '"');
        }
    }

}