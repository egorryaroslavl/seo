## Seo

Installation
------------
 
```
 composer require egorryaroslavl/seo  
```
Then, add serviceProvider:

```
'providers' => [
    // ...
        Egorryaroslavl\Seo\SeoServiceProvider::class,
    // ...
  ],
```

run this command
```
php artisan vendor:publish 
```
and run this command too
```
php artisan migrate
```