<?php
/**
 * @ApiDefinition(
 *   name="product_status",
 *   type="string",
 *   description="The status of a product",
 *   enum={"available", "discontinued"},
 *   default="available"
 * )
 */

namespace SwagPhp\Example;

use SwagPhp\Logger as Log;
use SwagPhp\Context;

/**
 * @param $arg0
 * @param int $arg1
 * @return int
 */
function _test($arg0, $arg1 = 1)
{
    return $arg0 + $arg1;
}

/**
 * Class _test_class
 * @package test
 */
class _test_class
{
    /**
     * @var string
     */
    private $pri;

    /**
     * @var string
     */
    private $pro;

    /**
     * @var Context
     */
    public $pub;

    public function pub($arg0, $arg1 = 1)
    {
        // inline comment
        return $arg0 + $arg1;
    }

    public function pro($arg0, $arg1 = 1)
    {
        Log::notice('test');

        return $arg0 + $arg1;
    }

    public function pri($arg0, $arg1 = 1)
    {
        $this->pub = new Context;

        return $arg0 + $arg1;
    }
}
?>

<?php

/**
 * @ApiInfo(
 *   version="1.0.0",
 *   title="Example of using references in swagger-php",
 * )
 */
?>
  You can define top-level parameters which can be references with $ref="#/parameters/$parameter"
<?php
/**
 * @ApiParam(
 *   parameter="product_id_in_path_required",
 *   name="product_id",
 *   description="The ID of the product",
 *   type="integer",
 *   format="int64",
 *   in="path",
 *   required=true
 * )
 *
 * @ApiParam(
 *   parameter="product_in_body",
 *   in="body",
 *   name="product",
 *   @ApiSchema(ref="#/definitions/Product")
 * )
 */
?>
  You can define top-level responses which can be references with $ref="#/responses/$response"

  I find it usefull to add @ApiResponse(ref="#/responses/todo") to the operations when i'm starting out with writting the swagger documentation.
  As it bypasses the "@ApiGet() requires at least one @ApiResponse()" error and you'll get a nice list of the available api calls in swagger-ui.

  Then later, a search for '#/responses/todo' will reveal the operations I haven't documented yet.
<?php
/**
 * @ApiResponse(
 *   response="product",
 *   description="All information about a product",
 *   @ApiSchema(ref="#/definitions/Product")
 * )
 *
 * @ApiResponse(
 *   response="todo",
 *   description="This API call has no documentated response (yet)",
 * )
 */
?>

  And although definitions are generally used for model-level schema's' they can be used for smaller things as well.
  Like a @ApiSchema, @ApiProperty or @ApiItems that is uses multiple times.
