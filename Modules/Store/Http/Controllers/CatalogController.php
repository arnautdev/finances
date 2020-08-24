<?php

namespace Modules\Store\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Modules\Store\Entities\Brands;
use Modules\Store\Entities\Product;
use Modules\Store\Entities\ProductCategory;
use Modules\Store\Entities\ProductParams;

class CatalogController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        $data['products'] = (new Product())->rows([
            'order' => ['id' => 'DESC']
        ]);

        return view('store::catalog.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        $data = [];
        $this->setViewVars($data);

        return view('store::catalog.create', compact('data'));
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        $data = $this->validateData($request);
        $product = Product::create($data);
        if ($product->exists()) {
            return redirect(route('catalog.edit', $product->id))->with('success', __('success-create-message'));
        }
        return back()->with('error', __('error-create-message'));
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Response
     */
    public function edit(Product $catalog)
    {
        $catalog->generateProductOptions();

        $data['product'] = $catalog;
        $this->setViewVars($data, $catalog);

        return view('store::catalog.edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function update(Request $request, Product $catalog)
    {
        $data = $this->validateData($request);
        if ($catalog->update($data)) {
            /// update seo details
            $catalog->getSeo()->update($data);

            return back()->with('success', __('success-update-message'));
        }
        return back()->with('error', __('error-update-message'));
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Response
     */
    public function destroy(Product $catalog)
    {
        if ($catalog->exists() && $catalog->delete()) {
            return back()->with('success', __('success-delete-message'));
        }
        return back()->with('error', __('error-delete-message'));
    }

    /**
     * @param $data
     * @return mixed
     */
    public function setViewVars(&$data, Product $product = null)
    {
        $data['categories'] = (new ProductCategory())->getSelectedOptions();
        $data['parentCategories'] = (new ProductCategory())->getAllParentCategories();
        $data['brands'] = (new Brands())->rows(['isActive' => 'yes'])->pluck('title', 'id');
        $data['relProducts'] = (new Product())->rows(['isActive' => 'yes'])->pluck('title', 'id');


        $data['relProductIds'] = [];
        if (!is_null($product)) {
            $data['productParams'] = (new ProductParams())->rows([
                'productId = ' => $product->id,
                'order' => ['id' => 'DESC']
            ]);

            $data['seo'] = $product->getSeo();

            $data['relProducts'] = (new Product())->rows(['isActive' => 'yes', 'id != ' => $product->id])->pluck('title', 'id');
            $data['relProductCategories'] = $product->getCategories()
                ->get()
                ->pluck('categoryId', 'id')
                ->toArray();
            $data['relProductIds'] = $product->getRelatedProducts()
                ->get()
                ->pluck('relatedProductId', 'id')
                ->toArray();
        }

        return $data;
    }

    /**
     * Validate product data
     * @param Request $request
     * @return mixed
     */
    private function validateData(Request $request)
    {
        return $request->validate([
            'isActive' => 'nullable',
            'title' => 'required|min:5|max:150',
            'price' => 'required|numeric',
            'promoPrice' => 'required|numeric',
            'gettingPrice' => 'nullable|numeric',
            'description' => 'nullable',
            'content' => 'nullable',
            'categoryId' => 'nullable',
            'categoryIds' => 'nullable',
            'catalogNumber' => 'nullable',
            'brandId' => 'nullable',
            'relatedProducts' => 'nullable',
            'attachments.*' => 'nullable|image|mimes:jpeg,png,jpg|max:5048',

            'meta_title' => 'nullable',
            'meta_keywords' => 'nullable',
            'meta_description' => 'nullable',
            'ogimage' => 'nullable|image|mimes:jpeg,png,jpg|max:5048',
        ]);
    }
}
