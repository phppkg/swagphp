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
use SwagPhp\Dumper\HtmlDumper;
use SwagPhp\Dumper\MarkdownDumper;
use SwagPhp\Dumper\PDFDumper;
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
     * @var bool
     */
    private $analyzed = false;

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
        'mode' => self::DETAILED,
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
     * @param bool $doScan
     */
    public function __construct($scanDirs, array $options = [], $doScan = true)
    {
        $this->scanDirs = (array)$scanDirs;
        $this->options = \array_merge($this->options, $options);

        if ($doScan) {
            $this->analysis();
        }
    }

    /**
     * collect php files and analysis them in the {@see self::$scanDirs}
     * @return self
     */
    public function analysis(): self
    {
        if ($this->analyzed) {
            return $this;
        }

        $opts = $this->options;

        if ($opts['mode'] === self::SIMPLE) {
            $analyser = new PhpDocAnalyser();
        } else {
            $analyser = new DoctrineAnalyser();
        }

        $this->analyzed = true;
        return $this;
    }

    /**
     * load a swagger.json
     * @param string $json
     * @return self
     */
    public function loadFromJson(string $json): self
    {
        return $this;
    }

    /**
     * load a swagger.yml
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
     * @param string $to Will dump dir/file path. eg 'swagger.json' 'swagger.yml'
     * @param string $format Export file format
     * @param array $options
     *  - single   Export single file. only use for 'md', 'html'
     * @return void
     */
    public function saveTo(string $to, string $format = self::FORMAT_JSON, array $options = []): void
    {
        if (!$this->swagger) {
            throw new \RuntimeException(
                'No content can be write to file. Please run analysis or load* method before call the method.'
            );
        }

        $content = '';

        switch ($format) {
            case self::FORMAT_YML:
            case self::FORMAT_YAML:
                $dumper = new Dumper(2);
                $content = $dumper->dump($this->swagger);
                break;
            case self::FORMAT_MD:
                MarkdownDumper::create($options)->dump($this->swagger, $to);
                return;
                break;
            case self::FORMAT_PDF:
                PDFDumper::create()->dump($this->swagger, $to);
                break;
            case self::FORMAT_HTML:
                HtmlDumper::create($options)->dump($this->swagger, $to);
                return;
                break;
            case self::FORMAT_JSON:
                $content = (string)$this->swagger;
                break;
            default:
                throw new \InvalidArgumentException('Invalid export format: ' . $format);
                break;
        }

        // ensure dir is created
        Directory::create(\dirname($to));

        if (\file_put_contents($to, $content) === false) {
            throw new \RuntimeException('Failed to saveAs("' . $to . '")');
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