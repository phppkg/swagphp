<?php
/**
 * Created by PhpStorm.
 * User: inhere
 * Date: 2018-06-05
 * Time: 10:41
 */

namespace SwagPhp\Schema;

/**
 * Class Swagger
 * @package SwagPhp\Schema
 */
class Swagger extends AbstractSchema
{
    /**
     * Specifies the Swagger Specification version being used. It can be used by the Swagger UI and other clients to interpret the API listing.
     * @var string
     */
    public $version = '2.0';

    /**
     * Provides metadata about the API. The metadata can be used by the clients if needed.
     * @var Info
     */
    public $info;

    /**
     * The host (name or ip) serving the API. This MUST be the host only and does not include the scheme nor sub-paths. It MAY include a port. If the host is not included, the host serving the documentation is to be used (including the port). The host does not support path templating.
     * @var string
     */
    public $host = 'localhost';

    /**
     * The base path on which the API is served, which is relative to the host. If it is not included, the API is served directly under the host. The value MUST start with a leading slash (/). The basePath does not support path templating.
     * @var string
     */
    public $basePath = '/';

    /**
     * The transfer protocol of the API. Values MUST be from the list: "http", "https", "ws", "wss". If the schemes is not included, the default scheme to be used is the one used to access the specification.
     * @var array
     */
    public $schemes = ['http'];

    /**
     * A list of MIME types the APIs can consume. This is global to all APIs but can be overridden on specific API calls. Value MUST be as described under Mime Types.
     * @var array
     */
    public $consumes = ['application/json'];

    /**
     * A list of MIME types the APIs can produce. This is global to all APIs but can be overridden on specific API calls. Value MUST be as described under Mime Types.
     * @var array
     */
    public $produces = ['application/json'];

    /**
     * The available paths and operations for the API.
     * @var Path[]
     */
    public $paths = [];

    /**
     * An object to hold data types produced and consumed by operations.
     * @var Definition[]
     */
    public $definitions = [];

    /**
     * An object to hold parameters that can be used across operations. This property does not define global parameters for all operations.
     * @var Parameter[]
     */
    public $parameters;

    /**
     * An object to hold responses that can be used across operations. This property does not define global responses for all operations.
     * @var Response[]
     */
    public $responses;

    /**
     * Security scheme definitions that can be used across the specification.
     * @var SecurityScheme[]
     */
    public $securityDefinitions;

    /**
     * A declaration of which security schemes are applied for the API as a whole. The list of values describes alternative security schemes that can be used (that is, there is a logical OR between the security requirements). Individual operations can override this definition.
     * @var array
     */
    public $security;

    /**
     * A list of tags used by the specification with additional metadata. The order of the tags can be used to reflect on their order by the parsing tools. Not all tags that are used by the Operation Object must be declared. The tags that are not declared may be organized randomly or based on the tools' logic. Each tag name in the list MUST be unique.
     * @var Tag[]
     */
    public $tags;

    /**
     * Additional external documentation.
     * @var ExternalDocs
     */
    public $externalDocs;

    /** @inheritdoc */
    public static $_required = ['version', 'info', 'paths'];

    /**
     * Save the swagger documentation to a file.
     * @param string $filename
     * @throws \RuntimeException
     */
    public function saveAs(string $filename): void
    {
        if (\file_put_contents($filename, $this) === false) {
            throw new \RuntimeException('Failed to saveAs("' . $filename . '")');
        }
    }
}