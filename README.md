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
 * @APIVersion 1.0.0
 * @Title user service center
 * @Description api for user service center
 * @Contact contact@me.com
 * @TermsOfServiceUrl http://github.com/inhere
 * @License Apache 2.0
 * @LicenseUrl http://www.apache.org/licenses/LICENSE-2.0.html
 */
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

### Detailed mode

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
 *     description="## user service center, `env: {dev}`
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
