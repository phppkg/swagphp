<?php

namespace PetstoreIO;

/**
 * @ApiDefinition(type="object", @ApiXml(name="User"))
 */
class User
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
    public $username;

    /**
     * @ApiProperty()
     * @var string
     */
    public $firstName;

    /**
     * @ApiProperty()
     * @var string
     */
    public $lastName;

    /**
     * @var string
     * @ApiProperty()
     */
    public $email;

    /**
     * @var string
     * @ApiProperty()
     */
    public $password;

    /**
     * @var string
     * @ApiProperty()
     */
    public $phone;

    /**
     * User Status
     * @var int
     * @ApiProperty(format="int32")
     */
    public $userStatus;
}
