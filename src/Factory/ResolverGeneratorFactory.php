<?php

declare(strict_types=1);

namespace Xaddax\WebonyxMiddleware\Factory;

use GraphQL\Middleware\Factory\GeneratedSchemaFactory;
use GraphQL\Middleware\Generator\ResolverGenerator;
use GraphQL\Middleware\Contract\TemplateEngineInterface;
use Psr\Container\ContainerInterface;

class ResolverGeneratorFactory
{
    public function __invoke(ContainerInterface $container): ResolverGenerator
    {
        xdebug_break();
        $config = $container->get('config')['graphql']['resolver'] ?? [];

        return new ResolverGenerator(
            $container->get(GeneratedSchemaFactory::class),
            $config['outputDirectory'],
            $config['namespace'],
            $container->get(TemplateEngineInterface::class),
            $config['templatePath'],
        );
    }
}
