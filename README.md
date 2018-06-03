# swagphp

a lite swagger tool, for parse and generate swagger api docs json,yml

- simple parse annotation to api docs
- support convert swagger.json to markdown/html/pdf files
  - ref https://github.com/Swagger2Markup/swagger2markup

## annotations


### simple mode

#### basic info

```php
/**
 * @APIVersion 1.0.0
 * @Title user service center
 * @Description api for user service center
 * @Contact contact@me.com
 * @TermsOfServiceUrl http://github.com/inhere
 * @License Apache 2.0
 * @LicenseUrl http://www.apache.org/licenses/LICENSE-2.0.html
 */
```

```php
$swag->addTags('users', 'users.follow', "common");
```

#### api definition

```php

/**
 * some api for user
 * @ApiTag  users  "some api for user"
 */
class UserController 
{
  /**
   * @ApiParam  FIELD  POSITION  TYPE  REQUIRED  DESCRIPTION
   * @ApiParam  userId  path  int  true  "the uesr id"
   * @ApiParam  userId  query  int  false  "the uesr id"
   * @ApiParam  bodyData  body  UserModel  true  "the submit form data"
   * @ApiResponse   200  {object}   []UserModel
   * @ApiResponse   403   no content
   */
   public function indexAction() 
   {}
}
```

### detailed mode

#### basic info

```php
/**
 * @APIMeta(
 *     host="api.dev",
 *     basePath="/",
 *     schemes={"http", "https"},
 *     consumes={"application/json"},
 *     produces={"application/json"}
 * )
 * @APIInfo(
 *     version="1.0.0",
 *     title="user service center",
 *     description="## user service center(`env: {dev}`)
 * test"
 * )
 */
```

#### api definition

```php
/**
 * @ApiTag("users", description="some api for user") // is optional
 */
class UserController 
{
  /**
   * @ApiParam("username", type="string", description="The username", in="header")
   * @ApiParam(name="userId", type="int", description="The user ID", in="path", required=true)
   * @ApiParam(name="field1", type="int", description="The field message", in="query")
   * @ApiResponse(200, type="object", ref="App\Models\User")
   * @ApiResponse(403, description="no content")
   */
   public function indexAction() 
   {}
}
```
