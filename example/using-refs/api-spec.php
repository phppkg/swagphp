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
