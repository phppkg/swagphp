<?php
/**
 * Created by PhpStorm.
 * User: inhere
 * Date: 2018/6/6
 * Time: 上午9:35
 */

namespace SwagPhp\Dumper;

use SwagPhp\Schema\Swagger;

/**
 * Class PDFDumper
 * @package SwagPhp\Dumper
 */
class PDFDumper extends AbstractDumper
{
    /**
     * {@inheritDoc}
     */
    public function dump(Swagger $swagger, string $to)
    {
        throw new \InvalidArgumentException('This is un-completed for export to PDF');
    }
}