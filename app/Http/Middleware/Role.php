<?php

namespace App\Http\Middleware;

use App\Service\Role as RoleService;
use App\Service\User;
use Illuminate\Support\Facades\Gate;
use Closure;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\View;

class Role
{
    /**
     * @var RoleService
     */
    private $role;
    /**
     * @var User
     */
    private $user;

    /**
     * Role constructor.
     */
    public function __construct(RoleService $role, User $user)
    {
        $this->role = $role;
        $this->user = $user;
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $availablePermissions = $this->role->getAvailablePermissions();
        $currentRouteName = Route::currentRouteName();

        $permissions = session('userAttributes')['permissions'];

        if (! is_null($currentRouteName)) {
            $allowed = false;
            $permissionName = $availablePermissions[$currentRouteName];
            if (in_array($currentRouteName, $permissions)) {
                $allowed = true;
            }

            if(! $allowed) {
                return [true, redirect('home')->withErrors(['error' => 'You dont have ' . $permissionName . ' access.'])];
            }
        }

        return $next($request);
    }
}
