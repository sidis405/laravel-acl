# WORKING ON THIS

add to composer.json 

"sid/laravel-acl":"dev-master" 

Sid\Acl\Providers\AclServiceProvider::class

composer-dump autoload

php artisan vendor:publish

php artisan migrate

config/acl.php : enabled -true

use Sid\Acl\Traits\HasRoles; to App\User

use HasRoles;