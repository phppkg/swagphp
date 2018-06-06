<?php
/**
 * Created by PhpStorm.
 * User: inhere
 * Date: 2018/6/6
 * Time: 上午10:59
 */

namespace SwagPhp\Analyser;

/**
 * Class AbstractAnalyser
 * @package SwagPhp\Analyser
 */
abstract class AbstractAnalyser
{
    /**
     * @var string base namespace for find model class. eg 'App'
     */
    protected $baseNamespace;
}