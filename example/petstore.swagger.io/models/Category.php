<?php

namespace PetstoreIO;

/**
 * @ApiDefinition(
 *   type="object",
 *   @ApiXml(name="Category")
 * )
 */
class Category
{

    /**
     * @ApiProperty(format="int64")
     * @var int
     */
    public $id;

    /**
     * @ApiProperty()
     * @var string
     */
    public $name;
}
