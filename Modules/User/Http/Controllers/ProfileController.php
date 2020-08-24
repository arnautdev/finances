<?php

namespace Modules\User\Http\Controllers;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    /**
     * Disable breadcrumbs
     * @var bool
     */
    public $includeBreadcrumbBar = false;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = User::findOrFail(auth()->id());
        $data['user'] = $user;
        $data['userAddress'] = $user->getUserAddress();
//        $data['socialPages'] = $user->getUserSocialPages();
        return view('user::profile.index', compact('data'));
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
        if (auth()->id() == $id) {
            $request->user()->update($this->validateUser());

            // add media
            if (!is_null($request->avatar)) {
                $request->validate([
                    'avatar' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                ]);
                $request->user()
                    ->addMedia($request->avatar)
                    ->toMediaCollection();
            }

            // validate address
            if (isset($request->address)) {
                $UserAddress = $request->user()->getUserAddress();
                $data = $request->validate([
                    'address' => 'required|min:5|max:500'
                ]);
                $data['userId'] = $id;
                if (!$UserAddress->exists()) {
                    $UserAddress->fill($data);
                    $UserAddress->save();
                } else {
                    $UserAddress->update($data);
                }
            }

            return back()->with('success', 'The profile has been successfully updated.');
        }
        return back()->with('warning', 'Ooops. Bad request.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (User::get($id)->delete()) {
            // @TODO logick for redirect after delete profile
        }
    }

    /**
     * Validate user-data
     * @return mixed
     */
    protected function validateUser()
    {
        return request()->validate([
            'firstname' => 'required|string|min:2|max:255',
            'lastname' => 'required|string|min:2|max:255',
            'company' => 'required|string|min:2|max:255',
            'language' => 'string',
            'timezone' => 'string',
            'phone' => '',
        ]);
    }
}
