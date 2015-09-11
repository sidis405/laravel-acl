<?php

namespace Sid\Acl\Providers;

use Sid\Acl\Models\Permission;
use Illuminate\Contracts\Auth\Access\Gate as GateContract;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AclServiceProvider extends ServiceProvider
{

    protected $defer = false;

    /**
     * Register any application authentication / authorization services.
     *
     * @param  \Illuminate\Contracts\Auth\Access\Gate  $gate
     * @return void
     */
    public function boot(GateContract $gate)
    {
        $this->exportMigration();
        
        // Dynamically register permissions with Laravel's Gate.
        foreach ($this->getPermissions() as $permission) {
            $gate->define($permission->name, function ($user) use ($permission) {
                return $user->hasPermission($permission);
            });
        }
    }

    /**
     * Fetch the collection of site permissions.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    protected function getPermissions()
    {
        return Permission::with('roles')->get();
    }

    public function exportMigration()
    {
        $timestamp = date('Y_m_d_His', time());

        $this->publishes([
                __DIR__.'/../resources/migrations/create_acl_tables.php.stub' => $this->app->basePath().'/'.'database/migrations/'.$timestamp.'_create_acl_tables.php',
            ], 'migrations');
    }
}
