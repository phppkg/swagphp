<?php

namespace UsingRefs;

/**
 * @ApiPath(
 *   path="/products/{product_id}",
 *   @ApiParameter(ref="#/parameters/product_id_in_path_required")
 * )
 */

class ProductController
{
    /**
     * @ApiGet(
     *   tags={"Products"},
     *   path="/products/{product_id}",
     *   @ApiResponse(response="default", ref="#/responses/product")
     * )
     */
    public function getProduct($id)
    {
    }

    /**
     * @ApiPatch(
     *   tags={"Products"},
     *   path="/products/{product_id}",
     *   @ApiParameter(ref="#/parameters/product_in_body"),
     *   @ApiResponse(response="default", ref="#/responses/product")
     * )
     */
    public function updateProduct($id)
    {

    }

    /**
     * @ApiPost(
     *   tags={"Products"},
     *   path="/products",
     *   @ApiParameter(ref="#/parameters/product_in_body"),
     *   @ApiResponse(response="default", ref="#/responses/product")
     * )
     */
    public function addProduct($id)
    {

    }
}