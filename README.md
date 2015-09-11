# WORKING ON THIS

add to composer.json 

"sid/laravel-acl":"dev-master" 

php artisan vendor:publish --provider="Sid\Acl\AclServiceProvider" --tag="migrations"

Sid\Acl\Providers\AclServiceProvider::class

composer-dump autoload

use Sid\Acl\Traits\HasRoles; to App\User

use HasRoles;