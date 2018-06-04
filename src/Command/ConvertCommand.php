<?php
/**
 * Created by PhpStorm.
 * User: inhere
 * Date: 2017-12-18
 * Time: 10:54
 */

namespace SwagPhp\Command;

use Inhere\Console\Command;
use Inhere\Console\IO\Input;
use Inhere\Console\IO\Output;

/**
 * Class ConvertCommand
 * @package App\Console\Commands
 */
class ConvertCommand extends Command
{
    protected static $name = 'convert';
    protected static $description = 'convert swaager.json/swaager.yml to markdown/html/PDF file(s)';

    /**
     * do execute
     * @param  Input $input
     * @param  Output $output
     * @return int
     */
    protected function execute($input, $output): int
    {
        $output->write('hello');

        return 0;
    }
}