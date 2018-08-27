<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'App\Model' => 'App\Policies\ModelPolicy',
        'App\User' => 'App\Policies\CheckData',
        //'model name'=>'policy namespace'
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();
        // Gate class work only if user logged in
          /*
              Gate::define('show data',function($user){
              if($user->mobile=="0124248793"){// $user->column name
                return true;
              }else{
                return false;
              }
            });
          */
          // another way by policy class
          Gate::define('show data','App\Policies\CheckData@show_data');
          /*
          write this if you not register policy in array $policies above
          Gate::define('show data','App\Policies\CheckData@show_data');
          */

    }
}
