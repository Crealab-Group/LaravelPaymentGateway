<?php

namespace Crealab\PaymentGateway\Providers;

use Illuminate\Support\ServiceProvider;
use Crealab\PaymentGateway\Commands\MakePaymentCommand;


class GatewayPaymentServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->commands([
                MakePaymentCommand::class,
            ]);
        }

        $srcPath = $this->getSrcPath();
        $this->loadMigrationsFrom($srcPath.'/Migrations');
       

        $this->publishes([
            $srcPath.'/Migrations/' => database_path('migrations')
        ], 'migrations');
    }


    private function getSrcPath(){
        return dirname( dirname(__FILE__) );
    }

}
