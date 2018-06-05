<?php

namespace Petstore;

/**
 * @ApiDefinition(definition="NewPet", type="object", required={"name"})
 */
class SimplePet
{

    public $id;

    /**
     * @ApiProperty()
     * @var string
     */
    public $name;

    /**
     * @var string
     * @ApiProperty()
     */
    public $tag;
}

/**
 * @ApiDefinition(
 *   definition="Pet",
 *   type="object",
 *   allOf={
 *       @ApiSchema(ref="#/definitions/NewPet"),
 *       @ApiSchema(
 *           required={"id"},
 *           @ApiProperty(property="id", format="int64", type="integer")
 *       )
 *   }
 * )
 */
