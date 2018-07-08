<?php
/**
 * Created by PhpStorm.
 * User: inhere
 * Date: 2018-06-05
 * Time: 10:41
 */

namespace SwagPhp;

use SwagPhp\Parser\DoctrineParser;
use SwagPhp\Parser\PhpDocParser;
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
final class SwagPhp
{
    // Doc comment format
    // simple   `@tag val`
    // detailed `@Tag(name="val")`
    public const SIMPLE = 'simple';
    public const DETAILED = 'detailed';

    // analysis mode:
    // 'class' - ClassAnalyser,
    // 'file' - TokenAnalyser
    public const MODE_FILE = 'file';
    public const MODE_CLASS = 'class';

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
     * @var Swagger
     */
    public $swagger;

    /**
     * Class definitions
     * @var array
     */
    public $classes = [];

    /**
     * @var \SplObjectStorage
     */
    public $annotations;

    /**
     * @var array|string
     */
    private $scanDirs;

    /**
     * @var bool
     */
    private $analyzed = false;

    /**
     * @var array
     * [name => value]
     */
    private $contentVars = [];

    /**
     * @var array
     */
    private $options = [
        // enable var replace
        'enableVar' => false,

        // annotation tag mode:
        //  simple   `@tag val`
        //  detailed `@Tag(name="val")`
        'docBlockMode' => self::SIMPLE,

        // analysis mode: 'class', 'file'
        'analysisMode' => self::MODE_CLASS,

        // exclude dirs
        'excludes' => [],

        // exclude filename
        // 'notNames' => [],

        // manual add some classes.
        'classes' => [],
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
     * namespaces scan
     * @param array $nsMap please {@see \SwagPhp\ClassAnalyser::$namespaces}
     * @param array $options
     * @return SwagPhp
     */
    public static function nsScan(array $nsMap, array $options = []): self
    {
        $options = \array_merge($options, [
            'analysisMode' => self::MODE_CLASS,
        ]);

        return new self($nsMap, $options);
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

        // parse mode, it is by annotation type `@Tag()` or `@tag`
        if ($opts['docBlockMode'] === self::SIMPLE) {
            $parser = new PhpDocParser();
        } else {
            $parser = new DoctrineParser();
        }

        // analysis mode
        if ($opts['analysisMode'] === self::MODE_CLASS) {
            $analyser = new ClassAnalyser($parser);
        } else {
            $analyser = new TokenAnalyser($parser);
        }

        $analyser->analysis($this->scanDirs, $this, $opts);
        $this->analyzed = true;

        return $this;
    }

    public function collect(Collection $collection)
    {
        foreach ($collection->annotations as $annotation) {
            $this->addAnnotation($annotation, $collection->annotations->offsetGet($annotation));
        }

        $this->classes = array_merge($this->classes, $collection->classes);
        if ($this->swagger === null && $collection->swagger) {
            $this->swagger = $collection->swagger;
            $collection->target->_context->analysis = $this;
        }
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

        // if enable var
        if ($this->options['enableVar']) {
            $content = \strtr($content, $this->expandVars());
        }

        if (\file_put_contents($to, $content) === false) {
            throw new \RuntimeException('Failed to saveAs("' . $to . '")');
        }
    }

    /**
     * @return array
     */
    private function expandVars(): array
    {
        $vars = [];

        foreach ($this->contentVars as $var => $val) {
            $key = \sprintf(self::VAR_TPL, $var);
            $vars[$key] = $val;
        }

        return $vars;
    }

    /**
     * @return Swagger
     */
    public function getSwagger(): Swagger
    {
        return $this->swagger;
    }

    /**
     * @return array|string
     */
    public function getScanDirs()
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