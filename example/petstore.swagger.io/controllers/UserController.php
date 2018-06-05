<?php

namespace PetstoreIO;

class UserController
{

    /**
     * @ApiPost(path="/user",
     *   tags={"user"},
     *   summary="Create user",
     *   description="This can only be done by the logged in user.",
     *   operationId="createUser",
     *   produces={"application/xml", "application/json"},
     *   @ApiParameter(
     *     in="body",
     *     name="body",
     *     description="Created user object",
     *     required=true,
     *     @ApiSchema(ref="#/definitions/User")
     *   ),
     *   @ApiResponse(response="default", description="successful operation")
     * )
     */
    public function createUser()
    {
    }

    /**
     * @ApiPost(path="/user/createWithArray",
     *   tags={"user"},
     *   summary="Creates list of users with given input array",
     *   description="",
     *   operationId="createUsersWithArrayInput",
     *   produces={"application/xml", "application/json"},
     *   @ApiParameter(
     *     in="body",
     *     name="body",
     *     description="List of user object",
     *     required=true,
     *     @ApiSchema(
     *       type="array",
     *       @ApiItems(ref="#/definitions/User")
     *     )
     *   ),
     *   @ApiResponse(response="default", description="successful operation")
     * )
     */
    public function createUsersWithArrayInput()
    {
    }

    /**
     * @ApiPost(path="/user/createWithList",
     *   tags={"user"},
     *   summary="Creates list of users with given input array",
     *   description="",
     *   operationId="createUsersWithListInput",
     *   produces={"application/xml", "application/json"},
     *   @ApiParameter(
     *     in="body",
     *     name="body",
     *     description="List of user object",
     *     required=true,
     *     @ApiSchema(
     *       type="array",
     *       @ApiItems(ref="#/definitions/User")
     *     )
     *   ),
     *   @ApiResponse(response="default", description="successful operation")
     * )
     */

    /**
     * @ApiGet(path="/user/login",
     *   tags={"user"},
     *   summary="Logs user into the system",
     *   description="",
     *   operationId="loginUser",
     *   produces={"application/xml", "application/json"},
     *   @ApiParameter(
     *     name="username",
     *     in="query",
     *     description="The user name for login",
     *     required=true,
     *     type="string"
     *   ),
     *   @ApiParameter(
     *     name="password",
     *     in="query",
     *     description="The password for login in clear text",
     *     required=true,
     *     type="string"
     *   ),
     *   @ApiResponse(
     *     response=200,
     *     description="successful operation",
     *     @ApiSchema(type="string"),
     *     @ApiHeader(
     *       header="X-Rate-Limit",
     *       type="integer",
     *       format="int32",
     *       description="calls per hour allowed by the user"
     *     ),
     *     @ApiHeader(
     *       header="X-Expires-After",
     *       type="string",
     *       format="date-time",
     *       description="date in UTC when token expires"
     *     )
     *   ),
     *   @ApiResponse(response=400, description="Invalid username/password supplied")
     * )
     */
    public function loginUser()
    {
    }

    /**
     * @ApiGet(path="/user/logout",
     *   tags={"user"},
     *   summary="Logs out current logged in user session",
     *   description="",
     *   operationId="logoutUser",
     *   produces={"application/xml", "application/json"},
     *   parameters={},
     *   @ApiResponse(response="default", description="successful operation")
     * )
     */
    public function logoutUser()
    {
    }

    /**
     * @ApiGet(path="/user/{username}",
     *   tags={"user"},
     *   summary="Get user by user name",
     *   description="",
     *   operationId="getUserByName",
     *   produces={"application/xml", "application/json"},
     *   @ApiParameter(
     *     name="username",
     *     in="path",
     *     description="The name that needs to be fetched. Use user1 for testing. ",
     *     required=true,
     *     type="string"
     *   ),
     *   @ApiResponse(response=200, description="successful operation", @ApiSchema(ref="#/definitions/User")),
     *   @ApiResponse(response=400, description="Invalid username supplied"),
     *   @ApiResponse(response=404, description="User not found")
     * )
     */
    public function getUserByName($username)
    {
    }

    /**
     * @ApiPut(path="/user/{username}",
     *   tags={"user"},
     *   summary="Updated user",
     *   description="This can only be done by the logged in user.",
     *   operationId="updateUser",
     *   produces={"application/xml", "application/json"},
     *   @ApiParameter(
     *     name="username",
     *     in="path",
     *     description="name that need to be updated",
     *     required=true,
     *     type="string"
     *   ),
     *   @ApiParameter(
     *     in="body",
     *     name="body",
     *     description="Updated user object",
     *     required=true,
     *     @ApiSchema(ref="#/definitions/User")
     *   ),
     *   @ApiResponse(response=400, description="Invalid user supplied"),
     *   @ApiResponse(response=404, description="User not found")
     * )
     */
    public function updateUser()
    {
    }

    /**
     * @ApiDelete(path="/user/{username}",
     *   tags={"user"},
     *   summary="Delete user",
     *   description="This can only be done by the logged in user.",
     *   operationId="deleteUser",
     *   produces={"application/xml", "application/json"},
     *   @ApiParameter(
     *     name="username",
     *     in="path",
     *     description="The name that needs to be deleted",
     *     required=true,
     *     type="string"
     *   ),
     *   @ApiResponse(response=400, description="Invalid username supplied"),
     *   @ApiResponse(response=404, description="User not found")
     * )
     */
    public function deleteUser()
    {
    }
}
