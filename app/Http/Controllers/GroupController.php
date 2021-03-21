<?php

namespace App\Http\Controllers;

use App\Traits\UtilsTrait;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class GroupController extends Controller
{
    use UtilsTrait;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['roles'] = Role::orderBy('id', 'DESC')->get();

        return view('group.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Role $group)
    {
        $this->registerNewPermissions();

        $data['role'] = $group;
        $data['permissions'] = $this->getControllersList();

        return view('group.edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Role $group)
    {
        // revoke all permissions
        foreach ($group->getAllPermissions() as $permission) {
            $group->revokePermissionTo($permission);
        }

        $data = $request->all('permissions');
        if (isset($data['permissions'])) {

            foreach ($data['permissions'] as $controller => $permissions) {
                foreach ($permissions as $permission) {
                    $permission = Permission::findOrCreate($permission);
                    $group->givePermissionTo($permission);
                }
            }
        }

        return back()->with('success', 'success-update-message');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
