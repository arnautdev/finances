<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * @var bool
     */
    public $checkAuth = false;

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $client = client();
        if ($client) {
            $client = $client->user();
//            $address = $client->getAddress()->create([
//                'status' => 'active',
//                'country' => 'Bulgaria',
//                'city' => 'Sofia',
//                'address' => 'ul Boris Dimovski 12A',
//            ]);

//            $order = $client->getOrders()->create([
//                'userAddressId' => 2,
//                'processedByUserId' => 1,
//                'status' => 'new',
//                'price' => 1000,
//                'currency' => 'BGN',
//                'paymentMethod' => 'cart',
//                'additionalOrderInfo' => 'Additional info',
//            ]);
//
//            $orderProducts = $order->getProducts()->createMany([
//                [
//                    'productId' => 1,
//                    'qty' => 3,
//                    'price' => 9900,
//                    'promoPrice' => 7800,
//                    'attributes' => json_encode([
//                        'color' => 'black',
//                        'size' => 'xs',
//                    ]),
//                ],
//                [
//                    'productId' => 1,
//                    'price' => 9900,
//                    'qty' => 1,
//                    'promoPrice' => 7800,
//                    'attributes' => json_encode([
//                        'color' => 'white',
//                        'size' => 'xs',
//                    ]),
//                ]
//            ]);
//
//            dd($order, $orderProducts);
        }

        return view('home.index');
    }
}
