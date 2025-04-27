<?php

declare(strict_types=1);

namespace Xaddax\WebonyxMiddleware\Factory;

use Psr\Container\ContainerInterface;
use GraphQL\Type\Schema;
use GraphQL\Middleware\Factory\GeneratedSchemaFactory;
use Xaddax\WebonyxMiddleware\SchemaConfiguration;

class GeneratedSchemaFactoryFactory
{
    public function __invoke(ContainerInterface $container): Schema
    {
        $factory = new GeneratedSchemaFactory($container->get(SchemaConfiguration::class));

        return $factory->createSchema();
    }
}
