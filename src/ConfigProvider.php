<?php

declare(strict_types=1);

namespace Xaddax\WebonyxMiddleware;

use GraphQL\Middleware\GraphQLMiddleware;
use GraphQL\Middleware\Contract\ErrorHandlerInterface;
use GraphQL\Middleware\Contract\ResponseFactoryInterface;
use GraphQL\Middleware\Contract\SchemaConfigurationInterface;
use GraphQL\Middleware\Contract\TemplateEngineInterface;
use GraphQL\Middleware\Error\DefaultErrorHandler;
use GraphQL\Middleware\Generator\SimpleTemplateEngine;
use GraphQL\Middleware\Resolver\ResolverManager;
use GraphQL\Server\ServerConfig;
use GraphQL\Type\Schema;
use Xaddax\WebonyxMiddleware\Factory\DefaultResponseFactoryFactory;
use Xaddax\WebonyxMiddleware\Factory\GeneratedSchemaFactoryFactory as GeneratedSchemaFactory;
use Xaddax\WebonyxMiddleware\Factory\GraphQLMiddlewareFactory;
use Xaddax\WebonyxMiddleware\Factory\ResolverManagerFactory;
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
                GeneratorConfig::class => GeneratorConfigFactory::class,
                ResolverManager::class => ResolverManagerFactory::class,
                ResponseFactoryInterface::class => DefaultResponseFactoryFactory::class,
                Schema::class => GeneratedSchemaFactory::class,
                ServerConfig::class => ServerConfigFactory::class,
                SchemaConfiguration::class => SchemaConfigurationFactory::class,
                SchemaConfigurationInterface::class => SchemaConfigurationFactory::class,
            ],
        ];
    }

    public function getGraphQLConfig(): array
    {
        $srcDir = getcwd() . '/src';
        $templatesDir = __DIR__ . '/../../../webonyx-middleware-component/templates';
        $templatesDir = realpath($templatesDir);
        $typeConfigDecorator = $resolverManager->createTypeConfigDecorator();

        return [
            'generator' => [
                'entityConfig' => [
                    'namespace' => 'Domain\\Entity',
                    'fileLocation' => $srcDir . '/Domain/Entity',
                    'templatePath' => $templatesDir . '/entity.php.template',
                ],
                'requestConfig' => [
                    'namespace' => 'Application\\GraphQL\\Request',
                    'fileLocation' => $srcDir . '/Application/GraphQL/Request',
                    'templatePath' => $templatesDir . '/request.php.template',
                ],
                'resolverConfig' => [
                    'namespace' => 'Application\\GraphQL\\Resolver',
                    'fileLocation' => $srcDir . '/Application/GraphQL/Resolver',
                    'templatePath' => $templatesDir . '/resolver.php.template',
                ],
                'typeMappings' => [],
                'customTypes' => [],
                'isImmutable' => false,
                'hasStrictTypes' => false,
            ],
            'middleware' => [
                'fallbackResolver' => function ($source, $args, $context, $info) {
                    return $source[$info->fieldName] ?? null;
                },
            ],
            'schema' => [
                'schemaDirectories' => [],
                'isCacheEnabled' => false,
                'cacheDirectory' => sys_get_temp_dir(),
                'directoryChangeFilename' => 'graphql-directory-changes.php',
                'schemaFilename' => 'graphql-schema.php',
                'parserOptions' => [],
                'resolverConfig' => [],
                'typeConfigDecorator' => $typeConfigDecorator,
                'schemaOptions' => [],
                'fieldConfigDecorator' => null,
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
