<?php

/**
 * @ApiDefinition(required={"code", "message"}, type="object")
 */
class ErrorModel extends Exception
{
    /**
     * @ApiProperty(format="int32");
     * @var int
     */
    public $code;
    /**
     * @ApiProperty();
     * @var string
     */
    public $message;
}
