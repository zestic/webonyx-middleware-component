<?php

declare(strict_types=1);

namespace Xaddax\WebonyxMiddleware;

use GraphQL\Middleware\GraphQLMiddleware;
use GraphQL\Middleware\Contract\ErrorHandlerInterface;
use GraphQL\Middleware\Contract\ResponseFactoryInterface;
use GraphQL\Middleware\Contract\SchemaConfigurationInterface;
use GraphQL\Middleware\Contract\TemplateEngineInterface;
use GraphQL\Middleware\Error\DefaultErrorHandler;
use GraphQL\Middleware\Factory\ResolverFactory;
use GraphQL\Middleware\Generator\ResolverGenerator;
use GraphQL\Middleware\Generator\SimpleTemplateEngine;
use GraphQL\Server\ServerConfig;
use GraphQL\Type\Schema;
use Xaddax\WebonyxMiddleware\Factory\DefaultResponseFactoryFactory;
use Xaddax\WebonyxMiddleware\Factory\GeneratedSchemaFactoryFactory as GeneratedSchemaFactory;
use Xaddax\WebonyxMiddleware\Factory\GraphQLMiddlewareFactory;
use Xaddax\WebonyxMiddleware\Factory\ResolverFactoryFactory;
use Xaddax\WebonyxMiddleware\Factory\ResolverGeneratorFactory;
use Xaddax\WebonyxMiddleware\Factory\ServerConfigFactory;
use Xaddax\WebonyxMiddleware\Factory\SchemaConfigurationFactory;

class ConfigProvider
{
    public function __invoke(): array
    {
        return [
            'dependencies' => $this->getDependencies(),
            'graphql' => $this->getGraphQLConfig(),
        ];
    }

    public function getDependencies(): array
    {
        return [
            'aliases' => [
                ErrorHandlerInterface::class => DefaultErrorHandler::class,
                TemplateEngineInterface::class => SimpleTemplateEngine::class,
            ],
            'factories' => [
                GraphQLMiddleware::class => GraphQLMiddlewareFactory::class,
                ResolverFactory::class => ResolverFactoryFactory::class,
                ResponseFactoryInterface::class => DefaultResponseFactoryFactory::class,
                ResolverGenerator::class => ResolverGeneratorFactory::class,
                Schema::class => GeneratedSchemaFactory::class,
                ServerConfig::class => ServerConfigFactory::class,
                SchemaConfiguration::class => SchemaConfigurationFactory::class,
                SchemaConfigurationInterface::class => SchemaConfigurationFactory::class,
            ],
        ];
    }

    public function getGraphQLConfig(): array
    {
        return [
            'schema' => [
                'isCacheEnabled' => true,
                'cacheDirectory' => [],
                'schemaDirectories' => [],
                'parserOptions' => [],
            ],
            'context' => [],
            'root_value' => null,
            'field_resolver' => null,
            'validation_rules' => [],
            'error_formatter' => null,
            'debug' => false,
        ];
    }
}
