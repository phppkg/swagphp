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
 */
class UserController
{
    /**
     * @Summary  summary message
     * @Description description message
     * @Parameter  FIELD  POSITION  TYPE  REQUIRED  DESCRIPTION  EXTRA...
     * @Parameter  status  query  int  true  "the user id"  enums(1, 2, 3)
     * @Parameter  userId  path  int  false  "the user id" min(1) max(10)
     * @Parameter  name  query  string  false  "the user name" minLength(5) maxLength(10)
     * @Parameter  bodyData  body  User  true  "the submit form data"
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