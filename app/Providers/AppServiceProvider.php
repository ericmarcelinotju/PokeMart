<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Validator;
use DateTime;
use Carbon\Carbon;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Validator::extend('olderThan', function($attribute, $value, $parameters, $validator) {
            if(DateTime::createFromFormat($parameters[1], $value) !== false){
                $input = Carbon::createFromFormat($parameters[1], $value);
                $now = Carbon::now();
                return $input->diffInYears($now) > $parameters[0];
            }else{
                return false;
            }
        });

        Validator::replacer('olderThan', function($message, $attribute, $rule, $parameters){
             return str_replace([':year'], str_replace('_', ' ', $parameters[0]), $message);
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
