<?php

namespace PetstoreIO;

/**
 * @ApiDefinition(type="object")
 */
class ApiResponse
{

    /**
     * @ApiProperty(format="int32")
     * @var int
     */
    public $code;

    /**
     * @ApiProperty
     * @var string
     */
    public $type;

    /**
     * @ApiProperty
     * @var string
     */
    public $message;
}
