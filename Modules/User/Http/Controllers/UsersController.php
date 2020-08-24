<?php

namespace Modules\User\Http\Controllers;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Modules\User\Entities\RegisterInvitation;
use Spatie\Permission\Models\Role;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['users'] = User::all()->where('id', '!=', auth()->id());
        return view('user::user.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('user::user.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|min:3',
            'guardId' => 'required',
            'email' => 'required|unique:register_invitations,email,status' . 'new'
        ]);
        $data['userId'] = auth()->id();
        $data['hash'] = md5(time());

        $registerInvitation = (new RegisterInvitation());
        if ($registerInvitation->create($data)) {
            return redirect(route('users.index'))->with('success', __('success-send-invitation'));
        }
        return redirect(route('users.index'))->with('error', __('error-send-invitation'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        $data['user'] = $user;
        $data['roles'] = Role::all()->pluck('name', 'id');

        return view('user::user.edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $data = $request->validate([
            'firstname' => 'required|min:3|max:30',
            'lastname' => 'required|min:3|max:30'
        ]);
        $user->update($data);

        // when change user role
        if ($user->getRoleId() !== $request->get('groupId')) {
            $user->removeRole($user->getRoleId());
            $user->assignRole($request->get('groupId'));
        }

        return back()->with('success', __('success-update-message'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    /**
     * Force sign in
     * @param User $user
     */
    public function forceSignIn(User $user)
    {
        if (auth()->loginUsingId($user->id)) {
            return redirect('/dashboard')->with('success', __('Welcome back :name', ['name' => $user->fullname()]));
        }
        return back()->with('error', __('Ooops. Something wrong'));
    }
}
