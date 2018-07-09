<?php
/**
 * Created by PhpStorm.
 * User: inhere
 * Date: 2018/6/8
 * Time: 上午10:14
 */

namespace SwagPhp\Schema;

use Toolkit\ObjUtil\Obj;

/**
 * Trait QuicklyCreateTrait
 * @package SwagPhp\Schema
 */
trait QuicklyCreateTrait
{
    /**
     * @param array $data
     * @return $this
     */
    public static function create(array $data = []): self
    {
        $self = new self();
        return Obj::init($self, $data);
    }
}