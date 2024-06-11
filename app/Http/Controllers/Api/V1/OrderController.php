<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\V1\StoreOrderRequest;
use App\Http\Requests\V1\UpdateOrderRequest;
use App\Http\Resources\V1\OrderResource;
use App\Models\Order;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return OrderResource::collection(Order::query()->paginate());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreOrderRequest $request)
    {
//        $order = Order::create($request->validated());
//
//        return new OrderResource($order);

        $user_id = $request->input('user_id');
        $status = $request->input('status');

        $order = new Order();
        $order->user_id = $user_id;
        $order->status = Order::ORDER_COMPLETED;
        $order->save();

        $itemIds = $request->input('items_ids');
        $order->items()->attach($itemIds);

        return response()->json(['message' => 'Заказ успешно оформлен'], 201);
    }




    /**
     * Display the specified resource.
     */
    public function show(Order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateOrderRequest $request, Order $order)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Order $order)
    {
        //
    }
}
