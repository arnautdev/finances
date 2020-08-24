<?php

namespace Modules\Store\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use \Cart;
use Modules\Store\Entities\Product;

class ShoppingCartController extends Controller
{
    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        if (!$request->exists('productId')) {
            return $this->cartResponse('error', 'Invalid product');
        }

        $productId = $request->get('productId');
//        $Product = (new Product())->row($productId);
        $Product = (new Product())->row();
        if (!$Product->exists) {
            return $this->cartResponse('error', 'This product is not exists');
        }
        $cartId = $this->getCartId($productId);


        Cart::add([
            'id' => $cartId,
            'name' => $Product->title,
            'price' => $Product->getPrice(),
            'quantity' => 1,
            'attributes' => $request->get('attributes', []),
            'associatedModel' => $Product
        ]);

        return $this->cartResponse('success', 'Success add to cart');
    }

    /**
     * @param Request $request
     * @return array|\Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector|string[]
     */
    public function increment(Request $request)
    {
        if (!$request->exists('id')) {
            return $this->cartResponse('error', 'Invalid cart item');
        }

        $itemId = $request->get('id');
        $item = Cart::get($itemId);
        if (Cart::update($itemId, ['quantity' => +1])) {
            return $this->cartResponse('success', 'Success remove item');
        }
        return $this->cartResponse('error', 'General error');
    }

    /**
     * @param Request $request
     * @return array|\Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector|string[]
     */
    public function unIncrement(Request $request)
    {
        if (!$request->exists('id')) {
            return $this->cartResponse('error', 'Invalid cart item');
        }

        $itemId = $request->get('id');
        if (Cart::update($itemId, ['quantity' => -1])) {
            return $this->cartResponse('success', 'Success remove item');
        }
        return $this->cartResponse('error', 'General error');
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Response
     */
    public function remove(Request $request)
    {
        if (!$request->exists('id')) {
            return $this->cartResponse('error', 'Invalid cart item');
        }

        if (Cart::remove($request->get('id'))) {
            return $this->cartResponse('success', 'Success remove item');
        }
        return $this->cartResponse('error', 'General error');
    }


    /**
     * @param int $productId
     * @return int|mixed|string
     */
    public function getCartId($productId = 0)
    {
        if (!\request()->exists('attributes')) {
            return $productId;
        }
        $attributes = \request()->get('attributes');
        $attributes['productId'] = $productId;
        return implode(':', $attributes);
    }

    /**
     * @param string $message
     * @param string $type
     * @param null $redirectUri
     * @return array|\Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector|string[]
     */
    public function cartResponse($type = 'success', $message = '', $redirectUri = null)
    {
        if (\request()->ajax()) {
            return [
                'type' => $type,
                'message' => $message,
            ];
        }

        if (!is_null($redirectUri)) {
            return redirect($redirectUri)->with($type, __($message));
        }

        return back()->with($type, __($message));
    }
}
