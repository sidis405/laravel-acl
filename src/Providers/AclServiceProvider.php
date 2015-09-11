<?php

namespace Sid\Acl\Providers;

use Illuminate\Contracts\Auth\Access\Gate as GateContract;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Config;
use Sid\Acl\Models\Permission;

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
        $this->exportConfigAndMigrations();
        
        if($this->enabled()){
        // Dynamically register permissions with Laravel's Gate.
            foreach ($this->getPermissions() as $permission) {
                $gate->define($permission->name, function ($user) use ($permission) {
                    return $user->hasPermission($permission);
                });
            }
        }
        
    }

    public function enabled()
    {
        $config = Config::get('acl');

        return $config['enabled'];

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

    public function exportConfigAndMigrations()
    {
        $timestamp = date('Y_m_d_His', time());

        $this->publishes([
                __DIR__.'/../../resources/migrations/create_acl_tables.stub' => $this->app->basePath().'/'.'database/migrations/'.$timestamp.'_create_acl_tables.php',
            ], 'migrations');        

        $this->publishes([
        __DIR__.'/../../resources/config/acl.php' => config_path('acl.php'),
        ]);
    }
}
