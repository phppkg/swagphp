<?php

namespace UsingRefs;
?>
  A common scenario is to let swagger-php generate a definition based on your model class.
  These definitions can then be referenced with `ref="#/definitions/$classname"
    <?php

/**
 * @ApiDefinition()
 */
class Product
{

    /**
     * The unique identifier of a product in our catalog.
     *
     * @var integer
     * @ApiProperty(format="int64")
     */
    public $id;

    /**
     * @ApiProperty(ref="#/definitions/product_status")
     */
    public $status;
}
