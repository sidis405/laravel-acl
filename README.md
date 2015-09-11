### WORKING ON THIS

This laravel package add structured ACL (roles and permissions) to Laravel >= 5.1.11

-- Very alpha stages. Not unstable but i need to write tests for it.
-- If you think it's a good staring point for you, take it.


###Installation
Add to composer.json 

```php
"sid/laravel-acl":"dev-master" 
```

Register the service provider by adding in the provider section in config/app.php

'providers' => [
    ...
    Sid\Acl\Providers\AclServiceProvider::class
    ...

Just in case
composer dump-autoload

Publish the migration and the config file
php artisan vendor:publish

Migrate the ACL tables
php artisan migrate

Enable IT!
config/acl.php : enabled -true

In you User model, import the trait
use Sid\Acl\Traits\HasRoles; to App\User

... and use it. Like so.

...
use Authenticatable, Authorizable, CanResetPassword, HasRoles;
...

###Credits
Deliberately inspired by Jeffrey Way's [lesson](https://laracasts.com/series/whats-new-in-laravel-5-1/episodes/16) at Laracasts.

###Todo
- Test. Tests. Tests.
- Expanded documentation on adding roles and permissions
- Management controllers and views

# Contributing

Contributions are **welcome** and will be fully **credited**.
