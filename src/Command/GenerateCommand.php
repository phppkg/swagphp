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
    protected static $description = 'parse project\' php files to generate swagger document file.';

    public static function aliases(): array
    {
        return ['gen'];
    }

    /**
     * @usage {fullCommand} [--dir DIR] [--output FILE] [...]
     * @options
     *  -o, --output STRING     Setting the output file name(<cyan>swagger.json</cyan>)
     *  -d, --dir STRING        Setting the parse directory(s). default is current dir.
     *                          eg: --dir app,lib
     *  -e, --exclude STRING    Exclude directory(s).
     *                          eg: --exclude vendor,library/Zend
     *  --stdout BOOL           Write to the standard output.
     * @example {fullCommand} -o public/swagger.json --exclude vendor
     *  {fullCommand} -o public/swagger.json
     * @param  Input $input
     * @param  Output $output
     * @return int
     */
    protected function execute($input, $output): int
    {
        $output->write('hello');

        $exclude = $input->sameOpt(['e', 'exclude']);
        $exclude = $exclude ? \explode(',', $exclude) : null;

        return 0;
    }
}