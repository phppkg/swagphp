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
 * Class GenerateCommand
 * @package App\Console\Commands
 */
class GenerateCommand extends Command
{
    protected static $name = 'generate';
    protected static $description = 'generate swaager.json/swaager.yml to markdown file(s)';

    public static function aliases(): array
    {
        return ['gen'];
    }

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