<?php

namespace Modules\Store\Http\Controllers;

use App\Grids\OrdersGrid;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Modules\Store\Entities\Order;

class OrdersController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index(Request $request)
    {
        $query = Order::query()->orderBy('id', 'DESC');
        $data['grid'] = (new OrdersGrid())->create([
            'query' => $query,
            'request' => $request
        ]);
        return view('store::orders.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        return view('store::orders.create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Response
     */
    public function edit(Order $order)
    {
        if ($order->status == 'new') {
            $order->update([
                'status' => 'processing',
                'processedByUserId' => auth()->id()
            ]);
        }
        $data['order'] = $order;

        return view('store::orders.edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function update(Request $request, Order $order)
    {
        if ($order->update($request->all())) {
            return back()->with('success', __('success-update-order'));
        }
        return back()->with('error', __('error-update-order'));
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }
}
