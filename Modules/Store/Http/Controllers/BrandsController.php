<?php

namespace Modules\Store\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Store\Entities\Brands;

class BrandsController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        $data['brands'] = (new Brands())->rows();

        return view('store::brands.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        return view('store::brands.create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        $data = $this->validateData($request);

        $brand = Brands::create($data);
        if ($brand->exists()) {

            if ($request->get('referer')) {
                return back()->with('success', __('success-add-brand'));
            }

            return redirect(route('brands.edit', $brand->id))->with('success', __('success-create-message'));
        }
        return back()->with('error', __('error-create-message'));
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Response
     */
    public function edit(Brands $brand)
    {
        $data['brand'] = $brand;
        return view('store::brands.edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function update(Request $request, Brands $brand)
    {
        $data = $this->validateData($request);

        if ($brand->update($data)) {
            return back()->with('success', __('success-update-message'));
        }
        return back()->with('error', __('error-update-message'));
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Response
     */
    public function destroy(Brands $brand)
    {
        if ($brand->exists() && $brand->delete()) {
            return back()->with('success', __('success-delete-message'));
        }
        return back()->with('error', __('error-delete-message'));
    }


    /**
     * Validate data
     * @param Request $request
     * @return mixed
     */
    public function validateData(Request $request)
    {
        return $request->validate([
            'title' => 'required|min:3|max:100',
            'isActive' => 'nullable',
            'attachments' => 'nullable|image|mimes:jpeg,png,jpg|max:5048',
        ]);
    }
}
