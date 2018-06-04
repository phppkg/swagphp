<?php
/**
 * Created by PhpStorm.
 * User: inhere
 * Date: 2018-06-05
 * Time: 10:41
 */

namespace SwagPhp;

/**
 * Class SwagPhp
 * @package SwagPhp
 */
class SwagPhp
{
    public static function create(array $config = [])
    {
        return new self($config);
    }

    public function __construct(array $config = [])
    {
        # code...
    }
}