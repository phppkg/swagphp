<?php

/**
 * @ApiSwagger(
 *     basePath="/api",
 *     host="petstore.swagger.io",
 *     schemes={"http"},
 *     produces={"application/json"},
 *     consumes={"application/json"},
 *     @ApiInfo(
 *         version="1.0.0",
 *         title="Swagger Petstore",
 *         description="A sample API that uses a petstore as an example to demonstrate features in the swagger-2.0 specification",
 *         termsOfService="http://swagger.io/terms/",
 *         @ApiContact(name="Swagger API Team"),
 *         @ApiLicense(name="MIT")
 *     ),
 *     @ApiDefinition(
 *         definition="ErrorModel",
 *         type="object",
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
 *     )
 * )
 */
