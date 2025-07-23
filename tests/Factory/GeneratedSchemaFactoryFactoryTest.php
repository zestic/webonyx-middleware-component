<?php

declare(strict_types=1);

namespace Xaddax\WebonyxMiddleware\Test\Factory;

use GraphQL\Middleware\Config\SchemaConfig;
use GraphQL\Middleware\Factory\GeneratedSchemaFactory;
use PHPUnit\Framework\TestCase;
use Psr\Container\ContainerInterface;
use Xaddax\WebonyxMiddleware\Factory\GeneratedSchemaFactoryFactory;

class GeneratedSchemaFactoryFactoryTest extends TestCase
{
    private GeneratedSchemaFactoryFactory $factory;
    private ContainerInterface $container;

    protected function setUp(): void
    {
        $this->factory = new GeneratedSchemaFactoryFactory();
        $this->container = $this->createMock(ContainerInterface::class);
    }

    public function testInvokeReturnsGeneratedSchemaFactory(): void
    {
        $this->container
            ->expects($this->never())
            ->method('get');

        $result = ($this->factory)($this->container);

        $this->assertInstanceOf(GeneratedSchemaFactory::class, $result);
    }
}
