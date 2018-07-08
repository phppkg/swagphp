<?php
/**
 * Created by PhpStorm.
 * User: inhere
 * Date: 2018/7/7
 * Time: 下午4:50
 */

namespace SwagPhp;

use SwagPhp\Schema;

/**
 * Class DocTags
 * @package SwagPhp
 */
class DocTags
{
    const PATH = 'Path';
    const TAG = 'Tag';
    const CONTACT = 'Contact';
    const SUMMARY = 'Summary';
    const DEFINITION = 'Definition';
    const EXTERNAL_DOCS = 'ExternalDocs';
    const HEADER = 'Header';
    const INFO = 'Info';
    const ITEMS = 'Items';
    const LICENSE = 'License';
    const OPERATION = 'Operation';
    const PARAMETER = 'ApiParam';
    const PROPERTY = 'Property';
    const RESPONSE = 'Response';
    const SCHEMA = 'Schema';
    const SECURITY_SCHEME = 'SecurityScheme';
    const SWAGGER = 'Swagger';
    const XML = 'Xml';

    // no schema
    const DESCRIPTION = 'Description';

    // tag to schema
    const TAG2SCHEMA = [
        self::CONTACT => Schema\Contact::class,
        self::DEFINITION => Schema\Definition::class,
        self::EXTERNAL_DOCS => Schema\ExternalDocs::class,
        self::HEADER => Schema\Header::class,
        self::INFO => Schema\Info::class,
        self::ITEMS => Schema\Items::class,
        self::LICENSE => Schema\License::class,
        self::OPERATION => Schema\Operation::class,
        self::PARAMETER => Schema\Parameter::class,
        self::PATH => Schema\Path::class,
        self::PROPERTY => Schema\Property::class,
        self::RESPONSE => Schema\Response::class,
        self::SCHEMA => Schema\Schema::class,
        self::SECURITY_SCHEME => Schema\SecurityScheme::class,
        self::SWAGGER => Schema\Swagger::class,
        self::TAG => Schema\Tag::class,
        self::XML => Schema\Xml::class,
    ];
}