<?php

declare(strict_types=1);

namespace Xaddax\WebonyxMiddleware\Factory;

use GraphQL\Middleware\Config\SchemaConfig;
use Psr\Container\ContainerInterface;

class SchemaConfigFactory
{
    public function __invoke(ContainerInterface $container): SchemaConfig
    {
        $config = $container->get('config')['graphql']['schema'] ?? [];

        return new SchemaConfig(
            $config['schemaDirectories'],
            $config['isCacheEnabled'],
            $config['cacheDirectory'],
            $config['directoryChangeFilename'],
            $config['schemaFilename'],
            $config['parserOptions'],
            $config['resolverConfig'],
            $config['typeConfigDecorator'],
            $config['schemaOptions'],
            $config['fieldConfigDecorator']
        );
    }
}
