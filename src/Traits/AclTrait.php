<?php

namespace Sid\Acl\Traits;

use Illuminate\Support\Facades\Config;
use Sid\Acl\Models\Permission;

trait AclTrait
{
    protected function enabled()
    {
        $config = Config::get('acl');

        return $config['enabled'];
    }

    protected function getPermissions()
    {
        return Permission::with('roles')->get();
    }

    public function registerAcl()
    {
        if($this->enabled()){
        // Dynamically register permissions with Laravel's Gate.
            foreach ($this->getPermissions() as $permission) {
                $gate->define($permission->name, function ($user) use ($permission) {
                    return $user->hasPermission($permission);
                });
            }
        }
        
    }
}
