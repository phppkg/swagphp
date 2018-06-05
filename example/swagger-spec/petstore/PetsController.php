<?php

namespace petstore;

class PetsController
{

    /**
     * @ApiGet(
     *     path="/pets",
     *     summary="List all pets",
     *     operationId="listPets",
     *     tags={"pets"},
     *     @ApiParameter(
     *         name="limit",
     *         in="query",
     *         description="How many items to return at one time (max 100)",
     *         required=false,
     *         type="integer",
     *         format="int32"
     *     ),
     *     @ApiResponse(
     *         response=200,
     *         description="An paged array of pets",
     *         @ApiSchema(ref="#/definitions/Pets"),
     *         @ApiHeader(header="x-next", type="string", description="A link to the next page of responses")
     *     ),
     *     @ApiResponse(
     *         response="default",
     *         description="unexpected error",
     *         @ApiSchema(
     *             ref="#/definitions/Error"
     *         )
     *     )
     * )
     */
    public function listPets()
    {
    }

    /**
     * @ApiPost(
     *    path="/pets",
     *    summary="Create a pet",
     *    operationId="createPets",
     *    tags={"pets"},
     *    @ApiResponse(response=201, description="Null response"),
     *    @ApiResponse(
     *        response="default",
     *        description="unexpected error",
     *        @ApiSchema(ref="#/definitions/Error")
     *    )
     * )
     */
    public function createPets()
    {
    }

    /**
     * @ApiGet(
     *     path="/pets/{petId}",
     *     summary="Info for a specific pet",
     *     operationId="showPetById",
     *     tags={"pets"},
     *     @ApiParameter(
     *         name="petId",
     *         in="path",
     *         required=true,
     *         description="The id of the pet to retrieve",
     *         type="string"
     *     ),
     *     @ApiResponse(
     *         response=200,
     *         description="Expected response to a valid request",
     *         @ApiSchema(ref="#/definitions/Pets")
     *     ),
     *     @ApiResponse(
     *         response="default",
     *         description="unexpected error",
     *         @ApiSchema(ref="#/definitions/Error")
     *     )
     * )
     */
    public function showPetById($id)
    {
    }
}
