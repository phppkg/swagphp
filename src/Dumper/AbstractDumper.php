<?php
/**
 * Created by PhpStorm.
 * User: inhere
 * Date: 2018/6/6
 * Time: 上午9:39
 */

namespace SwagPhp\Dumper;

use SwagPhp\Schema\Swagger;

/**
 * Class AbstractDumper
 * @package SwagPhp\Dumper
 */
abstract class AbstractDumper
{
    /**
     * @return AbstractDumper
     */
    public static function create(): self
    {
        return new static();
    }

    abstract public function dump(Swagger $swagger);
}