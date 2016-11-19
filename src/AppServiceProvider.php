<?php 

namespace EchoWine\Laravel\ORM;

use Illuminate\Support\ServiceProvider;
use File;
use Cfg;

class AppServiceProvider extends ServiceProvider{

    /**
     * The application instance.
     *
     * @var \Illuminate\Contracts\Foundation\Application
     */
    public $app;

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register(){

        try{
            
            $fields = config('laravel-orm.fields');
            Model::setAliases($fields);

        }catch(\Exception $e){

        }
    }
    

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot(){
        
        $this -> publishes([
            __DIR__.'/config/laravel-orm.php' => config_path('laravel-orm.php'),
        ]);



    }
}
