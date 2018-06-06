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
     * @var array
     */
    protected $options = [
        // Export single file. only use for 'md', 'html'
        'single' => true
    ];

    /**
     * @param array $options
     * @return AbstractDumper
     */
    public static function create(array $options = []): self
    {
        return new static($options);
    }

    /**
     * AbstractDumper constructor.
     * @param array $options
     */
    public function __construct(array $options = [])
    {
        $this->options = \array_merge($this->options, $options);
    }

    /**
     * @param Swagger $swagger
     * @param string $to Directory or file path
     * @return mixed
     */
    abstract public function dump(Swagger $swagger, string $to);
}