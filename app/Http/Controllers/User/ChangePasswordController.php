<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ChangePasswordController extends Controller
{
    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $change_password)
    {
        $data = $this->validateData($request);

        $data['password'] = Hash::make($data['password']);
        if ($change_password->update($data)) {
            return back()->with('success', __('success-update-password'));
        }
        return back()->with('error', __('error-update-password'));
    }

    public function validateData(Request $request): array
    {

        return $request->validate([
            'current_password' => ['required', function ($attribute, $value, $fail) {
                if (!\Hash::check($value, Auth::user()->password)) {
                    return $fail(__('The current password is incorrect.'));
                }
            }],
            'password' => 'required|min:4|confirmed',
            'password_confirmation' => 'required|min:4'
        ]);
    }
}
