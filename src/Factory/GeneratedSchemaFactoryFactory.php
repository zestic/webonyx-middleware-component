<?php

declare(strict_types=1);

namespace Xaddax\WebonyxMiddleware\Factory;

use Psr\Container\ContainerInterface;
use GraphQL\Middleware\Config\SchemaConfig;
use GraphQL\Middleware\Factory\GeneratedSchemaFactory;

class GeneratedSchemaFactoryFactory
{
    public function __invoke(ContainerInterface $container): GeneratedSchemaFactory
    {
        return new GeneratedSchemaFactory($container->get(SchemaConfig::class));
    }
}
