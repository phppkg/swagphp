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
 * Class MarkdownCommand
 * @package App\Console\Commands
 */
class MarkdownCommand extends Command
{
    protected static $name = 'markdown';
    protected static $description = 'convert swaager.json/swaager.yml to markdown file(s), equals <cyan>convert markdown</cyan>';

    public static function aliases(): array
    {
        return ['md'];
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