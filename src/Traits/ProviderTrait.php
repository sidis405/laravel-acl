<?php

namespace Sid\Acl\Traits;

trait ProviderTrait
{
    public function exportConfigAndMigrations($provider)
    {
        $timestamp = date('Y_m_d_His', time());

        $provider->publishes([
                __DIR__.'/../../resources/migrations/create_acl_tables.stub' => $provider->app->basePath().'/'.'database/migrations/'.$timestamp.'_create_acl_tables.php',
            ], 'migrations');        

        $provider->publishes([
        __DIR__.'/../../resources/config/acl.php' => config_path('acl.php'),
        ]);
    }
}
