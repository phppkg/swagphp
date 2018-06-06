<?php
/**
 * Created by PhpStorm.
 * User: inhere
 * Date: 2018-06-05
 * Time: 10:41
 */

namespace SwagPhp;

use SwagPhp\Analyser\DoctrineAnalyser;
use SwagPhp\Analyser\PhpDocAnalyser;
use SwagPhp\Schema\Swagger;
use Symfony\Component\Yaml\Dumper;
use Symfony\Component\Yaml\Parser;
use Toolkit\File\Directory;

/**
 * Class SwagPhp
 * @package SwagPhp
 */
class SwagPhp
{
    // doc comment format
    public const SIMPLE = 'simple';
    public const DETAILED = 'detailed';

    // supported output format
    public const FORMAT_YML = 'yml';
    public const FORMAT_YAML = 'yaml';
    public const FORMAT_JSON = 'json';
    // extended formats
    public const FORMAT_MD = 'md';
    public const FORMAT_PDF = 'pdf';
    public const FORMAT_HTML = 'html';

    // {{var}}
    private const VAR_TPL = '{{%s}}';

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
     * @var array
     * [name => value]
     */
    protected $contentVars = [];

    /**
     * @var array
     */
    protected $options = [
        // enable var replace
        'enableVar' => false,
    ];

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
     * @return self
     */
    protected function collectAndParse(array $options = []): self
    {
        $options = \array_merge([
            'mode' => self::DETAILED,
        ], $options);

        if ($options['mode'] === self::SIMPLE) {
            $parser = new PhpDocAnalyser();
        } else {
            $parser = new DoctrineAnalyser();
        }

        return $this;
    }

    /**
     * @param string $json
     * @return self
     */
    public function loadFromJson(string $json): self
    {
        return $this;
    }

    /**
     * @param string $yaml
     * @return self
     */
    public function loadFromYaml(string $yaml): self
    {
        $parser = new Parser();

        /** @var array $array */
        $array = $parser->parse(\trim($yaml));

        return $this;
    }

    /**
     * @param string $file Will dump file name. eg 'swagger.json' 'swagger.yml'
     * @param string $format
     * @return void
     */
    public function saveAs(string $file, string $format = self::FORMAT_JSON): void
    {
        switch ($format) {
            case self::FORMAT_YML:
            case self::FORMAT_YAML:
                $dumper = new Dumper(2);
                $string = $dumper->dump($this->swagger);
                break;
            case self::FORMAT_MD:

                break;
            case self::FORMAT_PDF:

                break;
            case self::FORMAT_HTML:

                break;
            case self::FORMAT_JSON:
            default:
                $string = \json_encode($this->swagger);
                break;
        }

        if (!$string) {
            throw new \RuntimeException('No content can be write to file.');
        }

        // ensure dir is created
        Directory::create(\dirname($file));

        if (\file_put_contents($file, $string) === false) {
            throw new \RuntimeException('Failed to saveAs("' . $file . '")');
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

    /**
     * @return array
     */
    public function getContentVars(): array
    {
        return $this->contentVars;
    }

    /**
     * @param array $contentVars
     */
    public function setContentVars(array $contentVars): void
    {
        $this->contentVars = \array_merge($this->contentVars, $contentVars);
    }
}