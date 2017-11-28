<?php

namespace Delivery\Http\Controllers\Api\v1;

use Delivery\Http\Requests\CheckoutRequest;
use Delivery\Http\Resources\OrderResource;
use Delivery\Models\Order;
use Delivery\Services\OrderService;
use Delivery\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ApiOrderController extends Controller
{

    private $service;

    public function __construct(
        OrderService $service
    )
    {
        $this->service = $service;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user_id = Auth::user()->id;
        $orders = Order::where('user_id',$user_id)->get();
        $result = OrderResource::collection($orders);
        return $result;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CheckoutRequest $request)
    {
        $data = $request->all();
        $data['user_id'] = Auth::user()->id;
        $o = $this->service->create($data);
        $result = new OrderResource($o);
        return $result;
    }

    /**
     * Display the specified resource.
     *
     * @param  \Delivery\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $order = Order::find($id);
        $result = new OrderResource($order);
        return $result;
    }
}
