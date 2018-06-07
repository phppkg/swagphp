<?php
/**
 * Created by PhpStorm.
 * User: inhere
 * Date: 2018/6/7
 * Time: 上午9:39
 */

namespace SwagPhp;

use SwagPhp\Schema\AbstractSchema;
use SwagPhp\Schema\Swagger;

/**
 * Class Collection
 * @package SwagPhp
 */
class Collection
{
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
     * @param array $annotations
     * @param Context $context
     */
    public function addAnnotations(array $annotations, Context $context)
    {
        foreach ($annotations as $annotation) {
            $this->addAnnotation($annotation, $context);
        }
    }

    /**
     * @param AbstractSchema $annotation
     * @param Context $context
     */
    public function addAnnotation($annotation, $context)
    {
        if ($this->annotations->contains($annotation)) {
            return;
        }

        $this->annotations->attach($annotation, $context);
    }
}