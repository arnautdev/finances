<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['user'] = auth()->user();

        return view('user.profile', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $profile)
    {
        $data = $this->validateData($request);
        if ($profile->update($data)) {
            return back()->with('success', __('success-update-profile-data'));
        }
        return back()->with('error', __('error-update-profile-data'));
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

    /**
     * @param Request $request
     * @return array
     */
    private function validateData(Request $request): array
    {
        return $request->validate([
            'name' => 'required|min:3|max:100',
            'email' => 'required|email',
        ]);
    }
}
