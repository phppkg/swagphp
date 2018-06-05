<?php

namespace Petstore;

class SimplePetsController
{

    /**
     * @ApiGet(
     *     path="/pets",
     *     description="Returns all pets from the system that the user has access to",
     *     operationId="findPets",
     *     produces={"application/json", "application/xml", "text/xml", "text/html"},
     *     @ApiParameter(
     *         name="tags",
     *         in="query",
     *         description="tags to filter by",
     *         required=false,
     *         type="array",
     *         @ApiItems(type="string"),
     *         collectionFormat="csv"
     *     ),
     *     @ApiParameter(
     *         name="limit",
     *         in="query",
     *         description="maximum number of results to return",
     *         required=false,
     *         type="integer",
     *         format="int32"
     *     ),
     *     @ApiResponse(
     *         response=200,
     *         description="pet response",
     *         @ApiSchema(
     *             type="array",
     *             @ApiItems(ref="#/definitions/Pet")
     *         ),
     *     ),
     *     @ApiResponse(
     *         response="default",
     *         description="unexpected error",
     *         @ApiSchema(
     *             ref="#/definitions/ErrorModel"
     *         )
     *     )
     * )
     */
    public function findPets()
    {
    }

    /**
     * @ApiGet(
     *     path="/pets/{id}",
     *     description="Returns a user based on a single ID, if the user does not have access to the pet",
     *     operationId="findPetById",
     *     @ApiParameter(
     *         description="ID of pet to fetch",
     *         format="int64",
     *         in="path",
     *         name="id",
     *         required=true,
     *         type="integer"
     *     ),
     *     produces={
     *         "application/json",
     *         "application/xml",
     *         "text/html",
     *         "text/xml"
     *     },
     *     @ApiResponse(
     *         response=200,
     *         description="pet response",
     *         @ApiSchema(ref="#/definitions/Pet")
     *     ),
     *     @ApiResponse(
     *         response="default",
     *         description="unexpected error",
     *         @ApiSchema(ref="#/definitions/ErrorModel")
     *     )
     * )
     */
    public function findPetById()
    {
    }

    /**
     * @ApiPost(
     *     path="/pets",
     *     operationId="addPet",
     *     description="Creates a new pet in the store.  Duplicates are allowed",
     *     produces={"application/json"},
     *     @ApiParameter(
     *         name="pet",
     *         in="body",
     *         description="Pet to add to the store",
     *         required=true,
     *         @ApiSchema(ref="#/definitions/NewPet")
     *     ),
     *     @ApiResponse(
     *         response=200,
     *         description="pet response",
     *         @ApiSchema(ref="#/definitions/Pet")
     *     ),
     *     @ApiResponse(
     *         response="default",
     *         description="unexpected error",
     *         @ApiSchema(ref="#/definitions/ErrorModel")
     *     )
     * )
     */
    public function addPet()
    {
    }

    /**
     * @ApiDelete(
     *     path="/pets/{id}",
     *     description="deletes a single pet based on the ID supplied",
     *     operationId="deletePet",
     *     @ApiParameter(
     *         description="ID of pet to delete",
     *         format="int64",
     *         in="path",
     *         name="id",
     *         required=true,
     *         type="integer"
     *     ),
     *     @ApiResponse(
     *         response=204,
     *         description="pet deleted"
     *     ),
     *     @ApiResponse(
     *         response="default",
     *         description="unexpected error",
     *         @ApiSchema(ref="#/definitions/ErrorModel")
     *     )
     * )
     */
    public function deletePet()
    {
    }
}
