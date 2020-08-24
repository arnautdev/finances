<?php

namespace Modules\User\Http\Controllers;

use Modules\User\Entities\UserAddress;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserAddressController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->merge(['userId' => auth()->id()]);
        $address = $request->validate([
            'userId' => 'required|integer',
            'country' => 'required|min:3|max:100',
            'city' => 'required|min:3|max:100',
            'postcode' => 'required|min:2',
            'address' => 'required|min:5',
        ]);

        if (UserAddress::create($address)) {
            return back()->with('success', __('success-create-message'));
        }
        return back()->with('error', __('error-create-message'));
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
    public function edit($id)
    {
        //
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
        $userAddress = (new UserAddress())->find($id);
        if (!is_null($userAddress)) {
            $address = $request->validate([
                'country' => 'required|min:3|max:100',
                'city' => 'required|min:3|max:100',
                'postcode' => 'required|min:2',
                'address' => 'required|min:5',
            ]);
            if ($userAddress->update($address)) {
                return back()->with('success', __('success-update-message'));
            }
            return back()->with('error', __('error-update-message'));
        }
        return back()->with('error', __('row-not-found-message'));
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
}
