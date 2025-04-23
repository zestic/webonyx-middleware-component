# Xaddax Webonyx Middleware Component

This library provides Laminas framework integration for the [webonyx-psr15-middleware](https://github.com/xaddax/webonyx-psr15-middleware) package.

## Requirements

- PHP 8.3 or higher
- Composer

## Installation

```bash
composer require xaddax/webonyx-middleware-component
```

## Usage

1. Register the module in your Laminas application:

```php
// config/modules.config.php
return [
    'Xaddax\\WebonyxMiddlewareComponent',
    // ... other modules
];
```

2. Configure your GraphQL schema and middleware:

```php
// config/autoload/graphql.global.php
return [
    'graphql' => [
        'schema' => [
             // Look in webonyx-psr15-middleware for configuration
        ],
        'context' => [
            // Your context factory
        ],
        'debug' => true, // Enable in development
    ],
];
```

## Testing

Run the test suite:

```bash
composer test
```

Run static analysis:

```bash
composer stan
```

Run code style checks:

```bash
composer cs-check
```

Fix code style issues:

```bash
composer cs-fix
```

## License

This project is licensed under the MIT License - see the LICENSE file for details. 