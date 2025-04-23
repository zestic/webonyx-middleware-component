<?php

declare(strict_types=1);

namespace Xaddax\WebonyxMiddlewareComponent\Application;

use GraphQL\Middleware\GraphQLMiddleware;
use Psr\Container\ContainerInterface;

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
            'factories' => [
                GraphQLMiddleware::class => static function (ContainerInterface $container) {
                    return $container->get(GraphQLMiddleware::class);
                },
            ],
        ];
    }

    public function getGraphQLConfig(): array
    {
        return [
            'schema' => [
                'query' => [],
                'mutation' => [],
                'types' => [],
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
