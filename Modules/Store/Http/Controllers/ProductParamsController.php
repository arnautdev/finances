<?php

namespace Modules\Store\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Modules\Store\Entities\ProductOptions;
use Modules\Store\Entities\ProductParams;

class ProductParamsController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        $data['productParams'] = (new ProductParams())->rows([
            'productId = ' => 0,
            'order' => ['id' => 'DESC']
        ]);

        return view('store::product-params.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        return view('store::product-params.create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        $data = $this->validateData($request);

        $productParam = ProductParams::create($data);
        if ($productParam->exists) {
            $redirectRuote = route('product-params.edit', $productParam->id);
            if ($request->exists('referer')) {
                return back()->with('success', __('success-create-message'));
            }

            return redirect($redirectRuote)->with('success', __('success-create-message'));
        }
        return back()->with('error', __('error-create-message'));
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Response
     */
    public function edit(ProductParams $product_param)
    {
        $data['productParam'] = $product_param;

        return view('store::product-params.edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function update(Request $request, ProductParams $product_param)
    {
        $data = $this->validateData($request);

        if ($product_param->update($data)) {
            return back()->with('success', __('success-create-message'));
        }
        return back()->with('error', __('error-create-message'));
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Response
     */
    public function destroy(ProductParams $product_param)
    {
        /// before delete all product variants with this option
        $product_param->getOptions()->pluck('optionKey', 'id')->map(function ($optionKey) {
            ProductOptions::where('optionKey', 'LIKE', "%" . $optionKey . "%")->delete();
        });

        if ($product_param->exists && $product_param->delete()) {
            return back()->with('success', __('success-delete-message'));
        }
        return back()->with('error', __('error-delete-message'));
    }


    /**
     * @param Request $request
     * @return mixed
     */
    private function validateData(Request $request)
    {
        return $request->validate([
            'title' => 'required|min:3|max:500',
            'productId' => 'nullable',
            'options' => 'required',
        ]);
    }
}
