<?php
/**
 * Created by PhpStorm.
 * User: inhere
 * Date: 2018/6/5
 * Time: 下午10:10
 */

namespace SwagPhp\Example\SimpleMode;

use SwagPhp\SwagUtil;

/**
 * Class UserController some api for user
 *
 * description message
 * @package SwagPhp\Example\SimpleMode
 * @Tag  users  "some api for user"
 * @AnnTag("users", des="des message")
 * @AnnTag1(
 *     "users",
 *     des="des message"
 * )
 * @AnnTag2(
 *     "users",
 *     des="des message(hi)"
 * )
 */
class UserController
{
    /**
     * @Tags user
     * @Summary  summary message
     * @Description description message
     * @ApiParam  FIELD  POSITION  TYPE  REQUIRED  DESCRIPTION  EXTRA...
     * @ApiParam  status  query  int  true  "the user id"  enums(1, 2, 3)
     * @ApiParam  userId  path  int  false  "the user id" min(1) max(10)
     * @ApiParam  name  query  string  false  "the user name" minLength(5) maxLength(10)
     * @ApiParam  bodyData  body  User  true  "the submit form data"
     * @ApiParam  bodyData  body  Blog(title,userId)  true  "the submit form data"
     * @ApiParam  ref("#/parameters/api_version_in_query")
     * @Response   200  {array}   []User
     * @Response   200  {object}   User
     * @Response   403   no content
     * @Route /users [get]
     */
    public function getUsers(): void
    {}

    /**
     * summary message
     * description message
     * @Parameter  FIELD  POSITION  TYPE  REQUIRED  DESCRIPTION  EXTRA...
     * @Parameter  status  query  int  true  "the user id"
     * @Response   200  {object}   []User
     * @Response   403   no content
     * @Route /users/{id} [get]
     */
    public function get(): void
    {
        SwagUtil::jsonToMarkdown('');
    }
}