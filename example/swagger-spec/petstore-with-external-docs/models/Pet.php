<?php

/**
 * @ApiDefinition(
 *   definition="NewPet",
 *   type="object",
 *   required={"name"}
 * )
 */
class Pet
{

    public $id;
    /**
     * @ApiProperty(type="string")
     */
    public $name;

    /**
     * @ApiProperty(type="string")
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
