<?php

namespace Sid\Acl\Traits;

trait ProviderTrait
{
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
