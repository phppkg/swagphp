<?php

namespace PetstoreIO;

/**
 * @ApiDefinition(type="object", @ApiXml(name="Order"))
 */
class Order
{

    /**
     * @ApiProperty(format="int64")
     * @var int
     */
    public $id;

    /**
     * @ApiProperty(format="int64")
     * @var int
     */
    public $petId;

    /**
     * @ApiProperty(default=false)
     * @var bool
     */
    public $complete;

    /**
     * @ApiProperty(format="int32")
     * @var int
     */
    public $quantity;

    /**
     * @var \DateTime
     * @ApiProperty()
     */
    public $shipDate;

    /**
     * Order Status
     * @var string
     * @ApiProperty(enum={"placed", "approved", "delivered"})
     */
    public $status;
}
