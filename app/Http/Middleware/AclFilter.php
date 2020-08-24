<?php

namespace App\Http\Middleware;

use Closure;

class AclFilter
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $defaultPermissions = config('acl.defaultPermissions');
        $superAdmins = config('acl.superAdminEmails');

        $permission = $this->getPermission();
        $user = auth()->user();

        // if in default list permissions
        if (in_array($permission, $defaultPermissions)) {
            return $next($request);
        }

        // check if is super-admin
        if (in_array($user->email, $superAdmins)) {
            return $next($request);
        }

        // check if have permission
        if (!$user->can($permission)) {
            return redirect('/dashboard')->with('warning', 'you-dont-have-permissions-for-this-page');
        }

        return $next($request);
    }

    /**
     * Get permission for current route
     * @return array|mixed|string
     */
    private function getPermission()
    {
        $permission = request()->route()->getAction('as');
        $permission = explode('.', $permission);
        $permission = array_reverse($permission);
        $permission = implode(' ', $permission);
        return $permission;
    }
}
