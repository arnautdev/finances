<?php

namespace Modules\Store\Observers;

use Modules\Store\Entities\Product;
use Modules\Store\Entities\ProductCategoryRel;
use Modules\Store\Entities\RelatedProducts;

class ProductObserver
{
    /**
     * @param Product $product
     */
    public function creating(Product $product)
    {
        $product->slug = str_slug($product->title);
        $product->addedByUserId = auth()->id();

        $nextNumber = ((new Product())->rows()->count() + 1);
        $product->catalogNumber = $product->getNumber($nextNumber);

//        $product->price = $product->floatToInt($product->price);
//        $product->promoPrice = $product->price;
//        $product->gettingPrice = intval($product->gettingPrice);

    }

    /**
     * Handle the product "created" event.
     *
     * @param \App\Product $product
     * @return void
     */
    public function created(Product $product)
    {
        //
    }

    /**
     * @param Product $product
     */
    public function saving(Product $product)
    {
        $product->price = $product->floatToInt($product->price);
        $product->promoPrice = $product->floatToInt($product->promoPrice);
        $product->gettingPrice = $product->floatToInt($product->gettingPrice);
    }

    /**
     * @param Product $product
     */
    public function saved(Product $product)
    {
        /// set category-rels
        $this->setCategoryIds($product);

        /// save related products
        $this->saveRelatedProducts($product);

        /// initialize meta data
        $this->initMetaData($product);
    }

    /**
     * Handle the product "updated" event.
     *
     * @param \App\Product $product
     * @return void
     */
    public function updated(Product $product)
    {
        //
    }

    /**
     * Handle the product "deleted" event.
     *
     * @param \App\Product $product
     * @return void
     */
    public function deleted(Product $product)
    {
        //
    }

    /**
     * Handle the product "restored" event.
     *
     * @param \App\Product $product
     * @return void
     */
    public function restored(Product $product)
    {
        //
    }

    /**
     * Handle the product "force deleted" event.
     *
     * @param \App\Product $product
     * @return void
     */
    public function forceDeleted(Product $product)
    {
        //
    }

    /**
     * @param Product $product
     */
    public function initMetaData(Product $product)
    {
        if (!$product->getSeo()->exists) {
            $data['model'] = Product::class;
            $data['itemId'] = $product->id;
            if (!request('meta_title', false)) {
                $data['meta_title'] = $product->title;
            }

            $product->getSeo()->create($data);
        }
    }


    /**
     * Create product categories rel
     * @param Product $product
     */
    public function setCategoryIds(Product $product)
    {
        /// delete if exists
        if ($product->getCategories()->get()->count()) {
            ProductCategoryRel::where('productId', '=', $product->id)->delete();
        }
        $categoryIds = request('categoryIds', false);
        if ($categoryIds !== false) {
            foreach ($categoryIds as $categoryId) {
                $data[]['categoryId'] = $categoryId;
            }
            $product->getCategories()->createMany($data);
        }
    }


    /**
     * @param Product $product
     * @return bool|int
     */
    public function saveRelatedProducts(Product $product)
    {
        if ($product->getRelatedProducts()->get()->count()) {
            RelatedProducts::where('productId', '=', $product->id)->delete();
        }
        $relatedProductIds = request('relatedProducts', false);
        if ($relatedProductIds !== false) {
            foreach ($relatedProductIds as $relatedProductId) {
                $data[]['relatedProductId'] = $relatedProductId;
            }
            $resp = $product->getRelatedProducts()->createMany($data);
            return $resp->count();
        }
        return true;
    }
}
