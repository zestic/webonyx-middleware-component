<?php

declare(strict_types=1);

namespace Xaddax\WebonyxMiddleware\Factory;

use Xaddax\WebonyxMiddleware\SchemaConfiguration;
use Psr\Container\ContainerInterface;

class SchemaConfigurationFactory
{
    public function __invoke(ContainerInterface $container): SchemaConfiguration
    {
        $config = $container->get('config')['graphql']['schema'] ?? [];

        $defaults = [
            'isCacheEnabled' => false,
            'cacheDirectory' => sys_get_temp_dir(),
            'schemaDirectories' => [],
            'parserOptions' => [],
            'directoryChangeFilename' => 'graphql-directory-changes.php',
            'schemaFilename' => 'graphql-schema.php',
            'resolverConfig' => []
        ];

        $mergedConfigs = array_merge($defaults, $config);

        return new SchemaConfiguration($mergedConfigs);
    }
}
