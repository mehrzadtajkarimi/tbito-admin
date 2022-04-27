<?php

namespace App\Providers;

use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use Illuminate\Database\Eloquent\Relations\Relation;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('path.public', function () {
            return base_path('public_html');
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // View::composer('user.*',UserComposer::class);
        Relation::morphMap([
            'Admin' => 'App\Models\Admin',
            'AdminLoginLog' => 'App\Models\AdminLoginLog',
            'AdminRole' => 'App\Models\AdminRole',
            'BankAccount' => 'App\Models\BankAccount',
            'City' => 'App\Models\City',
            'Commission' => 'App\Models\Commission',
            'Country' => 'App\Models\Country',
            'CurrencyNetwork' => 'App\Models\CurrencyNetwork',
            'Gateway' => 'App\Models\Gateway',
            'Market' => 'App\Models\Market',
            'Permission' => 'App\Models\Permission',
            'PermissionRole' => 'App\Models\PermissionRole',
            'Role' => 'App\Models\Role',
            'SiteContent' => 'App\Models\SiteContent',
            'SiteSetting' => 'App\Models\SiteSetting',
            'User' => 'App\Models\User',
            'UserLevel' => 'App\Models\UserLevel',
        ]);

        Paginator::useBootstrap();
    }
}
