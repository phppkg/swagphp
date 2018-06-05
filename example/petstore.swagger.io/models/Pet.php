<?php

namespace PetstoreIO;

/**
 * @ApiDefinition(required={"name", "photoUrls"}, type="object", @ApiXml(name="Pet"))
 */
class Pet
{

    /**
     * @ApiProperty(format="int64")
     * @var int
     */
    public $id;

    /**
     * @ApiProperty(example="doggie")
     * @var string
     */
    public $name;

    /**
     * @var Category
     * @ApiProperty()
     */
    public $category;

    /**
     * @var string[]
     * @ApiProperty(@ApiXml(name="photoUrl", wrapped=true))
     */
    public $photoUrls;

    /**
     * @var Tag[]
     * @ApiProperty(@ApiXml(name="tag", wrapped=true))
     */
    public $tags;

    /**
     * pet status in the store
     * @var string
     * @ApiProperty(enum={"available", "pending", "sold"})
     */
    public $status;
}
