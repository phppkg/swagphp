Dynamic References import all attributes from the reference object to the specified object.
It works similar to the `#ref` however allows for customization of properties and attributes.
The dynamic reference uses a `$` instead of `#` for the `ref` attribute.

<?php

/**
 * @ApiInfo(
 *   version="1.0.0",
 *   title="Example of using references in swagger-php",
 * )
 *
 * @ApiDefinition(
 *   definition="ExampleDefinition",
 *   @ApiProperty(
 *      property="status",
 *      type="string",
 *      description="The status of a product",
 *      enum={"available", "discontinued"},
 *      default="available"
 *   )
 * )
 */

?>

Define a default object which be our base structure.
In this case it is a response, which will contain a variable `data` property.
We are also showing how it is possible to extend Definitions on sub Schemas by extending the 'ExampleDefinition'.
<?php
/**
 * @ApiResponse(
 *      response="Json",
 *      description="the basic response",
 *      @ApiSchema(
 *          ref="$/definitions/ExampleDefinition",
 *          @ApiProperty(
 *              type="boolean",
 *              property="success"
 *          ),
 *          @ApiProperty(
 *              property="data"
 *          ),
 *          @ApiProperty(
 *              property="errors",
 *              type="object"
 *          ),
 *          @ApiProperty(
 *              property="token",
 *              type="string"
 *          )
 *      )
 * )
 *
 */
?>

Then you can extend the response in this example POST request by using the '$' ref.
As you can see `ref="$/responses/Json` is telling it to extend the base `Json` response.
We follow the reference with a `Schema` layout which specifies that the `data` property will actually be a `Product`.
<?php
/**
 * @ApiPost(
 *     path="/api/path",
 *     summary="Post to URL",
 *     @ApiParameter(
 *          name="body",
 *          in="body",
 *          required=true,
 *          @ApiSchema(
 *              @ApiProperty(
 *                  property="name",
 *                  type="string",
 *                  maximum=64
 *              ),
 *              @ApiProperty(
 *                  property="description",
 *                  type="string"
 *              )
 *          )
 *     ),
 *     @ApiResponse(
 *          response=200,
 *          description="Example extended response",
 *          ref="$/responses/Json",
 *          @ApiSchema(
 *              @ApiProperty(
 *                  property="data",
 *                  ref="#/definitions/Product"
 *              )
 *          )
 *     ),
 *     security={{"Bearer":{}}}
 * )
 */
?>