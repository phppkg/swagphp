<?php
/**
 * Created by PhpStorm.
 * User: inhere
 * Date: 2018-06-05
 * Time: 10:41
 */

namespace SwagPhp;

use SwagPhp\Schema\Swagger;

/**
 * Class SwagPhp
 * @package SwagPhp
 */
class SwagPhp
{
    // doc comment format
    public const SIMPLE = 'simple';
    public const DETAILED = 'detailed';

    /**
     * @var array
     */
    private $scanDirs;

    /**
     * @var Swagger
     */
    public $swagger;

    /**
     * @var \SplObjectStorage
     */
    public $annotations;

    /**
     * @param string|array $scanDirs
     * @param array $options
     * @return SwagPhp
     */
    public static function scan($scanDirs, array $options = []): self
    {
        return new self($scanDirs, $options);
    }

    /**
     * SwagPhp constructor.
     * @param string|array $scanDirs
     * @param array $options
     */
    public function __construct($scanDirs, array $options = [])
    {
        $this->scanDirs = (array)$scanDirs;

        $this->collectAndParse($options);
    }

    /**
     * @param array $options
     * @return Swagger
     */
    protected function collectAndParse(array $options = []): Swagger
    {
        $options = \array_merge([
            'mode' => self::DETAILED,
        ], $options);

        if ($options['mode'] === self::SIMPLE) {
            $parser = new SimpleModeParser();
        } else {
            $parser = new DetailedModeParser();
        }

    }

    /**
     * @return Swagger
     */
    public function getSwagger(): Swagger
    {
        return $this->swagger;
    }

    /**
     * @return array
     */
    public function getScanDirs(): array
    {
        return $this->scanDirs;
    }
}