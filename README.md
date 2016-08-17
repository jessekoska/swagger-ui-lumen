SwaggerUILumen
==========

Swagger UI for Lumen 5

Martin Abelson Sahlen style of swagger-ui implemented.

Installation
============

```php
    composer require "jessekoska/swagger-ui-lumen dev-master"
```

- Open your `bootstrap/app.php` file and: 

uncomment this line (around line 26) in `Create The Application` section:
```php
     $app->withFacades();
```

add this line before `Register Container Bindings` section:
```php
     $app->configure('swagger-ui-lumen');
```

add this line in `Register Service Providers` section:
```php
    $app->register(SwaggerUILumen\ServiceProvider::class);
```

Configuration
============

- Run `php artisan swagger-ui-lumen:publish-config` to publish configs (`config/swagger-ui-lumen.php`)
- Make configuration changes if needed 
- Run `php artisan swagger-ui-lumen:publish` to publish
