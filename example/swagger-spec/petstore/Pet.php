<?php

namespace petstore;

/**
 * @ApiDefinition(required={"id", "name"})
 */
class Pet
{

    /**
     * @ApiProperty(type="integer", format="int64")
     */
    public $id;

    /**
     * @ApiProperty()
     * @var string
     */
    public $name;

    /**
     * @ApiProperty()
     * @var string
     */
    public $tag;
}
