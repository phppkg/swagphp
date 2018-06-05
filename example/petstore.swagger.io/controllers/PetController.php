<?php

namespace PetstoreIO;

final class PetController
{

    /**
     * @ApiGet(
     *     path="/pet/findByTags",
     *     summary="Finds Pets by tags",
     *     tags={"pet"},
     *     description="Muliple tags can be provided with comma separated strings. Use tag1, tag2, tag3 for testing.",
     *     operationId="findPetsByTags",
     *     produces={"application/xml", "application/json"},
     *     @ApiParameter(
     *         name="tags",
     *         in="query",
     *         description="Tags to filter by",
     *         required=true,
     *         type="array",
     *         @ApiItems(type="string"),
     *         collectionFormat="multi"
     *     ),
     *     @ApiResponse(
     *         response=200,
     *         description="successful operation",
     *         @ApiSchema(
     *             type="array",
     *             @ApiItems(ref="#/definitions/Pet")
     *         ),
     *     ),
     *     @ApiResponse(
     *         response="400",
     *         description="Invalid tag value",
     *     ),
     *     security={
     *         {
     *             "petstore_auth": {"write:pets", "read:pets"}
     *         }
     *     },
     *     deprecated=true
     * )
     */
    public function findByTags()
    {
    }

    /**
     * @ApiGet(
     *     path="/pet/findByStatus",
     *     summary="Finds Pets by status",
     *     description="Multiple status values can be provided with comma separated strings",
     *     operationId="findPetsByStatus",
     *     produces={"application/xml", "application/json"},
     *     tags={"pet"},
     *     @ApiParameter(
     *         name="status",
     *         in="query",
     *         description="Status values that need to be considered for filter",
     *         required=true,
     *         type="array",
     *         @ApiItems(
     *             type="string",
     *             enum={"available", "pending", "sold"},
     *             default="available"
     *         ),
     *         collectionFormat="multi"
     *     ),
     *     @ApiResponse(
     *         response=200,
     *         description="successful operation",
     *         @ApiSchema(
     *             type="array",
     *             @ApiItems(ref="#/definitions/Pet")
     *         ),
     *     ),
     *     @ApiResponse(
     *         response="400",
     *         description="Invalid status value",
     *     ),
     *     security={
     *       {"petstore_auth": {"write:pets", "read:pets"}}
     *     }
     * )
     */
    public function findByStatus()
    {
    }

    /**
     * @ApiGet(
     *     path="/pet/{petId}",
     *     summary="Find pet by ID",
     *     description="Returns a single pet",
     *     operationId="getPetById",
     *     tags={"pet"},
     *     produces={"application/xml", "application/json"},
     *     @ApiParameter(
     *         description="ID of pet to return",
     *         in="path",
     *         name="petId",
     *         required=true,
     *         type="integer",
     *         format="int64"
     *     ),
     *     @ApiResponse(
     *         response=200,
     *         description="successful operation",
     *         @ApiSchema(ref="#/definitions/Pet")
     *     ),
     *     @ApiResponse(
     *         response="400",
     *         description="Invalid ID supplied"
     *     ),
     *     @ApiResponse(
     *         response="404",
     *         description="Pet not found"
     *     ),
     *     security={
     *       {"api_key": {}}
     *     }
     * )
     */
    public function getPetById()
    {
    }

    /**
     * @ApiPost(
     *     path="/pet",
     *     tags={"pet"},
     *     operationId="addPet",
     *     summary="Add a new pet to the store",
     *     description="",
     *     consumes={"application/json", "application/xml"},
     *     produces={"application/xml", "application/json"},
     *     @ApiParameter(
     *         name="body",
     *         in="body",
     *         description="Pet object that needs to be added to the store",
     *         required=true,
     *         @ApiSchema(ref="#/definitions/Pet"),
     *     ),
     *     @ApiResponse(
     *         response=405,
     *         description="Invalid input",
     *     ),
     *     security={{"petstore_auth":{"write:pets", "read:pets"}}}
     * )
     */
    public function addPet()
    {
    }

    /**
     * @ApiPut(
     *     path="/pet",
     *     tags={"pet"},
     *     operationId="updatePet",
     *     summary="Update an existing pet",
     *     description="",
     *     consumes={"application/json", "application/xml"},
     *     produces={"application/xml", "application/json"},
     *     @ApiParameter(
     *         name="body",
     *         in="body",
     *         description="Pet object that needs to be added to the store",
     *         required=true,
     *         @ApiSchema(ref="#/definitions/Pet"),
     *     ),
     *     @ApiResponse(
     *         response=400,
     *         description="Invalid ID supplied",
     *     ),
     *     @ApiResponse(
     *         response=404,
     *         description="Pet not found",
     *     ),
     *     @ApiResponse(
     *         response=405,
     *         description="Validation exception",
     *     ),
     *     security={{"petstore_auth":{"write:pets", "read:pets"}}}
     * )
     */
    public function updatePet()
    {
    }

    /**
     * @ApiDelete(
     *     path="/pet/{petId}",
     *     summary="Deletes a pet",
     *     description="",
     *     operationId="deletePet",
     *     produces={"application/xml", "application/json"},
     *     tags={"pet"},
     *     @ApiParameter(
     *         description="Pet id to delete",
     *         in="path",
     *         name="petId",
     *         required=true,
     *         type="integer",
     *         format="int64"
     *     ),
     *     @ApiParameter(
     *         name="api_key",
     *         in="header",
     *         required=false,
     *         type="string"
     *     ),
     *     @ApiResponse(
     *         response=400,
     *         description="Invalid ID supplied"
     *     ),
     *     @ApiResponse(
     *         response=404,
     *         description="Pet not found"
     *     ),
     *     security={{"petstore_auth":{"write:pets", "read:pets"}}}
     * )
     */
    public function deletePet()
    {
    }

    /**
     * @ApiPost(
     *   path="/pet/{petId}",
     *   tags={"pet"},
     *   summary="Updates a pet in the store with form data",
     *   description="",
     *   operationId="updatePetWithForm",
     *   consumes={"application/x-www-form-urlencoded"},
     *   produces={"application/xml", "application/json"},
     *   @ApiParameter(
     *     name="petId",
     *     in="path",
     *     description="ID of pet that needs to be updated",
     *     required=true,
     *     type="integer",
     *     format="int64"
     *   ),
     *   @ApiParameter(
     *     name="name",
     *     in="formData",
     *     description="Updated name of the pet",
     *     required=false,
     *     type="string"
     *   ),
     *   @ApiParameter(
     *     name="status",
     *     in="formData",
     *     description="Updated status of the pet",
     *     required=false,
     *     type="string"
     *   ),
     *   @ApiResponse(response="405",description="Invalid input"),
     *   security={{
     *     "petstore_auth": {"write:pets", "read:pets"}
     *   }}
     * )
     */
    public function updatePetWithForm()
    {
    }

    /**
     * @ApiPost(
     *     path="/pet/{petId}/uploadImage",
     *     consumes={"multipart/form-data"},
     *     description="",
     *     operationId="uploadFile",
     *     @ApiParameter(
     *         description="Additional data to pass to server",
     *         in="formData",
     *         name="additionalMetadata",
     *         required=false,
     *         type="string"
     *     ),
     *     @ApiParameter(
     *         description="file to upload",
     *         in="formData",
     *         name="file",
     *         required=false,
     *         type="file"
     *     ),
     *     @ApiParameter(
     *         description="ID of pet to update",
     *         format="int64",
     *         in="path",
     *         name="petId",
     *         required=true,
     *         type="integer"
     *     ),
     *     produces={"application/json"},
     *     @ApiResponse(
     *         response="200",
     *         description="successful operation",
     *         @ApiSchema(ref="#/definitions/ApiResponse")
     *     ),
     *     security={
     *         {
     *             "petstore_auth": {
     *                  "read:pets",
     *                  "write:pets"
     *             }
     *         }
     *     },
     *     summary="uploads an image",
     *     tags={
     *         "pet"
     *     }
     * )
     * */
    public function uploadFile()
    {
    }
}
