<?php

namespace App\Providers;

use App\Models\AdminPermission;
use App\Models\AdminRole;
use App\Models\Permission;
use App\Models\PermissionRole;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Log;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        foreach (Permission::all() as $permission) {
            Gate::define($permission->name, function ($admin) use ($permission) {
                $adminRoleIds = AdminRole::where('admin_id', $admin->id)->pluck('role_id')->toArray();
                $adminPermissionIds = PermissionRole::whereIn('role_id', $adminRoleIds)->pluck('permission_id')->toArray();
                return in_array($permission->id, $adminPermissionIds) || $admin->is_super_admin;
            });
        }
    }
}
