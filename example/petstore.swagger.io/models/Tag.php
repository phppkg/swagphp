<?php

namespace PetstoreIO;

/**
 * @ApiDefinition(
 *   type="object",
 *   @ApiXml(name="Tag")
 * )
 */
class Tag
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
