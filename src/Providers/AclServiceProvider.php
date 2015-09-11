<?php

namespace Sid\Acl\Providers;

use Illuminate\Contracts\Auth\Access\Gate as GateContract;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Sid\Acl\Traits\AclTrait;
use Sid\Acl\Traits\ProviderTrait;

class AclServiceProvider extends ServiceProvider
{

    use AclTrait, ProviderTrait;

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
        
        $this->registerAcl($gate);
        
    }

}
