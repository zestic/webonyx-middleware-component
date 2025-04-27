<?php

declare(strict_types=1);

namespace Xaddax\WebonyxMiddleware;

use GraphQL\Middleware\Contract\SchemaConfigurationInterface;

class SchemaConfiguration implements SchemaConfigurationInterface
{
    public function __construct(
        private array $config,
    ) {}

    public function isCacheEnabled(): bool
    {
        return $this->config['isCacheEnabled'];
    }

    public function getCacheDirectory(): string
    {
        return $this->config['cacheDirectory'];
    }

    public function getSchemaDirectories(): array
    {
        return $this->config['schemaDirectories'];
    }

    public function getParserOptions(): array
    {
        return $this->config['parserOptions'];
    }

    public function getDirectoryChangeFilename(): string
    {
        return $this->config['directoryChangeFilename'];
    }

    public function getSchemaFilename(): string
    {
        return $this->config['schemaFilename'];
    }

    public function getResolverConfig(): array
    {
        return $this->config['resolverConfig'];
    }
}
