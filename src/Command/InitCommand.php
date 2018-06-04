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
 * Class InitCommand
 * @package App\Console\Commands
 */
class InitCommand extends Command
{
    protected static $name = 'init';
    protected static $description = 'init a swaager.json or swaager.yml to current directory';

    /**
     * do execute
     * @param  Input $input
     * @param  Output $output
     * @return int
     */
    protected function execute($input, $output)
    {
        $output->write('hello');

        return 0;
    }
}