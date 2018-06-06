# swagphp

a lite swagger tool, for parse and generate swagger api docs json,yml

- simple parse annotation to swagger 2.0 api docs
- support convert swagger.json to markdown/html/pdf files
  - ref https://github.com/Swagger2Markup/swagger2markup

## Usage

### Use composer

- global install

```bash
composer global require toolkit/swagphp 
```

```bash
swagphp --help
swagphp gen -o swagger.json
```

- for current project

```bash
composer require toolkit/swagphp --dev
```

### Use phar package

```bash
wget https://github.com/php-toolkit/swagphp/releases/download/1.0.1/swagphp.phar
mv swagphp.phar /usr/local/bin/swagphp
swagphp --help
```

### Usage from [docker](https://docker.com)

Generate the swagger documentation to a static json file.

```bash
docker run -v "$PWD":/app -it sawgphp/box swagphp --help
```

## Annotations

### Simple mode

#### basic info

```php
/**
 * @Version 1.0.0
 * @Title user service center
 * @Description api for user service center
 * @Host localhost:8080
 * @BasePath /v1
 * @ContactName username
 * @ContactEmail contact@me.com
 * @ContactUrl http://github.com/inhere
 * @TermsOfService http://github.com/inhere
 * @License Apache 2.0
 * @LicenseUrl http://www.apache.org/licenses/LICENSE-2.0.html
 */
```

#### Security

```php
/**
 * 
 */
```

#### api operations

```php

/**
 * some api for user
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
     * @Parameter  bodyData  body  UserModel  true  "the submit form data"
     * @Response   200  {array}   []UserModel
     * @Response   200  {object}   UserModel
     * @Response   403   no content
     * @Route /users [get]
     */
    public function getUsers() 
    {}
     
    /**
     * summary message
     * description message
     * @Parameter  FIELD  POSITION  TYPE  REQUIRED  DESCRIPTION  EXTRA...
     * @Parameter  status  query  int  true  "the user id"  
     * @Response   200  {object}   []UserModel
     * @Response   403   no content
     * @Route /users/{id} [get]
     */
    public function get() 
    {}
}
```

### Detailed mode

#### basic info

```php
/**
 * // https://github.com/OAI/OpenAPI-Specification/blob/master/versions/2.0.md#swaggerObject
 * @Project(
 *     host="api.dev",
 *     basePath="/",
 *     schemes={"http", "https"},
 *     consumes={"application/json"},
 *     produces={"application/json"}
 * )
 * @Info(
 *     version="1.0.0",
 *     title="user service center",
 *     description="## user service center, `env: {dev}`
 * test"
 * )
 */
```

#### api operations

```php
/**
 * @ApiTag("users", description="some api for user") // is optional
 */
class UserController 
{
    /**
     * @Summary("Post to URL")
     * @Description("description message")
     * @Route(path="/users", method="GET")
     * @Parameter("username", type="string", description="The username", in="header")
     * @Parameter(name="userId", type="int", description="The user ID", in="path", required=true)
     * @Parameter(name="field1", type="int", description="The field message", in="query")
     * @Response(200, type="object", ref="\App\Models\UserModel")
     * @Response(200, type="array", ref="[]\App\Models\UserModel")
     * @Response(403, description="no content")
     */
    public function getUsers() 
    {}
}
```

## Some helper methods

- setting some info 

```php
$swag->swagger->info->version = '1.2.0';
```

- pre-add tags

```php
$swag->addTag('users', 'some operation for user');
$swag->addTags([
  'users' => 'some operation for user', 
  'users.follow' => 'tag description', 
  'common' => 'tag description'
]);
```

## Development

generate phar package:

```bash
php -d phar.readonly=0 genphar pack -o swagphp.phar
```

## Reference

### open api

- github https://github.com/OAI/OpenAPI-Specification
- V2 https://github.com/OAI/OpenAPI-Specification/blob/master/versions/2.0.md
- V3 https://github.com/OAI/OpenAPI-Specification/blob/v3.0.1/versions/3.0.1.md

### swagger

- example-site http://petstore.swagger.io/
- example-json http://petstore.swagger.io/v2/swagger.json
- swagger-ui https://github.com/swagger-api/swagger-ui

### other implement

- swaggo/swag https://github.com/swaggo/swag
- swagger-php https://github.com/zircote/swagger-php
- caoym/phpboot https://github.com/caoym/phpboot/tree/master/src/Docgen/Swagger
- go-swagger https://github.com/go-swagger/go-swagger
- beego-bee https://github.com/beego/bee

### swagger-explained

- https://bfanger.nl/swagger-explained/

### doc-block parse

- `phpdocumentor/reflection-docblock` https://github.com/phpDocumentor/ReflectionDocBlock
  - support simple mode parse
- `doctrine/annotations` https://github.com/doctrine/annotations
  - support detailed mode parse

## LICENSE

**MIT**