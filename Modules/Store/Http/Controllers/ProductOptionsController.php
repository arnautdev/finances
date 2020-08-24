<?php

namespace Modules\Store\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Arr;
use Modules\Store\Entities\Product;
use Modules\Store\Entities\ProductOptions;

class ProductOptionsController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        return view('store::index');
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        return view('store::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        $productId = $request->get('productId');
        $product = (new Product())->row($productId);

        $data = $this->validateData($request);

        collect($data['productOptions'])->map(function ($row) use ($productId) {
            if (isset($row['id'])) {
                $productOption = (new ProductOptions())->row($row['id']);
                return $productOption->update($row);
            } else {
                $row['productId'] = $productId;
                return ProductOptions::create($row);
            }
        });

        return back()->with('success', __('success-create-message'));
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Response
     */
    public function edit($id)
    {
        return view('store::edit');
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Response
     */
    public function destroy(ProductOptions $product_option)
    {
        if ($product_option->exists && $product_option->delete()) {
            return back()->with('success', __('success-delete-message'));
        }
        return back()->with('error', __('error-delete-message'));
    }

    private function validateData(Request $request)
    {
        return $request->validate([
            'productOptions.*.id' => 'nullable',
            'productOptions.*.optionKey' => 'required',
            'productOptions.*.optionLabel' => 'required',
            'productOptions.*.price' => 'required|numeric',
            'productOptions.*.availableCount' => 'required',
        ]);
    }
}
