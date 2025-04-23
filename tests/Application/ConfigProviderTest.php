<?php

declare(strict_types=1);

namespace Xaddax\WebonyxMiddlewareComponent\Test\Application;

use PHPUnit\Framework\TestCase;
use Xaddax\WebonyxMiddlewareComponent\Application\ConfigProvider;

class ConfigProviderTest extends TestCase
{
    private ConfigProvider $configProvider;

    protected function setUp(): void
    {
        $this->configProvider = new ConfigProvider();
    }

    public function testInvokeReturnsExpectedStructure(): void
    {
        $config = ($this->configProvider)();

        $this->assertArrayHasKey('dependencies', $config);
        $this->assertArrayHasKey('graphql', $config);
        $this->assertArrayHasKey('factories', $config['dependencies']);
        $this->assertArrayHasKey('schema', $config['graphql']);
    }

    public function testGetDependenciesReturnsExpectedStructure(): void
    {
        $dependencies = $this->configProvider->getDependencies();

        $this->assertArrayHasKey('factories', $dependencies);
    }

    public function testGetGraphQLConfigReturnsExpectedStructure(): void
    {
        $graphqlConfig = $this->configProvider->getGraphQLConfig();

        $this->assertArrayHasKey('schema', $graphqlConfig);
        $this->assertArrayHasKey('context', $graphqlConfig);
        $this->assertArrayHasKey('root_value', $graphqlConfig);
        $this->assertArrayHasKey('field_resolver', $graphqlConfig);
        $this->assertArrayHasKey('validation_rules', $graphqlConfig);
        $this->assertArrayHasKey('error_formatter', $graphqlConfig);
        $this->assertArrayHasKey('debug', $graphqlConfig);
    }
}
