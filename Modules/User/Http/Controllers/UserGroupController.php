<?php

namespace Modules\User\Http\Controllers;

use App\Traits\UtilsTrait;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class UserGroupController extends Controller
{
    use UtilsTrait;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['roles'] = Role::all()->sortByDesc('id');
        return view('user::user-group.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['permissions'] = $this->getControllersList();
        return view('user::user-group.create', compact('data'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $this->validateRole();
        $role = Role::create($data);

        $data = $request->all('permissions');
        if (isset($data['permissions']) && count($data['permissions']) > 0) {
            foreach ($data['permissions'] as $controller => $permissions) {
                foreach ($permissions as $permission) {
                    $permission = Permission::findOrCreate($permission);
                    $role->givePermissionTo($permission);
                }
            }
        }
        return redirect(route('user-group.index'))->with('success', __('success-create-message'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $this->registerNewPermissions();
        $data = Role::findById($id);
        $data['permissions'] = $this->getControllersList();
        return view('user::user-group.edit', compact('data'))->with('role', Role::findById($id));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $role = Role::find($id);
        $data = $this->validateRole();
        $role->update($data);

        // revoke all permissions
        foreach ($role->getAllPermissions() as $permission) {
            $role->revokePermissionTo($permission);
        }

        $data = $request->all('permissions');
        if (isset($data['permissions'])) {
            foreach ($data['permissions'] as $controller => $permissions) {
                foreach ($permissions as $permission) {
                    $permission = Permission::findOrCreate($permission);
                    $role->givePermissionTo($permission);
                }
            }
        }

        return back()->with('success', 'success-update-message');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $id = request()->all('id');
        if (Role::destroy($id)) {
            return back()->with('success', 'success-destroy-message');
        }
        return back()->with('error', 'error-destroy-message');
    }

    /**
     * Validate role form
     * @return array|Request|string
     */
    private function validateRole()
    {
        return request()->validate([
            'name' => 'required|min:3|max:50'
        ]);
    }
}
