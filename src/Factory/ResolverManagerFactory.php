<?php

declare(strict_types=1);

namespace GraphQL\Middleware\Factory;

use GraphQL\Middleware\Resolver\ResolverManager;

final class ResolverManagerFactory
{
    public function __invoke(ContainerInterface $container): ResolverManager
    {
        return new ResolverManager(
            $container->get(ResolverFactory::class),
            $container->get('config')['graphql']['middleware']['fallbackResolver'],
        );
    }
}
