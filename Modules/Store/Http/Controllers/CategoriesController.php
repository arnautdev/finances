<?php

namespace Modules\Store\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Store\Entities\ProductCategory;

class CategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        $data['categories'] = (new ProductCategory())->rows([
            'parentCategoryId' => 0
        ]);


        return view('store::categories.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        return view('store::categories.create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        $data = $this->validateData($request);

        $productCategory = ProductCategory::create($data);
        if ($productCategory->exists()) {
            if ($request->exists('subcategory')) {
                return back()->with('success', __('success-add-subcategory'));
            }

            if ($request->get('referer')) {
                return back()->with('success', __('success-add-category'));
            }

            return redirect(route('categories.edit', $productCategory->id))->with('success', __('success-create-message'));
        }
        return back()->with('error', __('error-create-message'));
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Response
     */
    public function edit(ProductCategory $category)
    {
        $data['category'] = $category;
        $data['childCategories'] = $category->getChildCategories();
        $data['categories'] = (new ProductCategory)->rows(['parentCategoryId' => 0])->pluck('title', 'id');
        return view('store::categories.edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function update(Request $request, ProductCategory $category)
    {
        $data = $this->validateData($request);
        if ($category->update($data)) {
            return back()->with('success', __('success-update-message'));
        }
        return back()->with('error', __('error-update-message'));
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Response
     */
    public function destroy(ProductCategory $category)
    {
        if ($category->exists() && $category->delete()) {
            return back()->with('success', __('success-delete-message'));
        }
        return back()->with('error', __('error-delete-message'));
    }


    /**
     * @param $request
     * @return mixed
     */
    public function validateData($request)
    {
        return $request->validate([
            'title' => 'required|min:3|max:500',
            'isActive' => 'nullable',
            'description' => 'nullable|min:5',
            'content' => 'nullable|min:10',
            'parentCategoryId' => 'nullable|integer',
            'attachments' => 'nullable|image|mimes:png.jpg,jpeg|max:5048',
        ]);
    }
}
