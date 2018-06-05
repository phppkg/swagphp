<?php

/**
 * @ApiSwagger(
 *     @ApiInfo(
 *         version="1.0.0",
 *         title="Swagger Petstore",
 *         @ApiLicense(name="MIT")
 *     ),
 *     host="petstore.swagger.io",
 *     basePath="/v1",
 *     schemes={"http"},
 *     consumes={"application/json"},
 *     produces={"application/json"},
 *     @ApiDefinition(
 *         definition="Error",
 *         required={"code", "message"},
 *         @ApiProperty(
 *             property="code",
 *             type="integer",
 *             format="int32"
 *         ),
 *         @ApiProperty(
 *             property="message",
 *             type="string"
 *         )
 *     ),
 *     @ApiDefinition(definition="Pets",
 *         type="array",
 *         @ApiItems(ref="#/definitions/Pet")
 *     )
 * )
 */
