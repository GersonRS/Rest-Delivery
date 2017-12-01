<?php

namespace Delivery\Http\Controllers;

use Illuminate\Http\Request;

use Delivery\Http\Requests;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use Delivery\Http\Requests\OrderItemCreateRequest;
use Delivery\Http\Requests\OrderItemUpdateRequest;
use Delivery\Repositories\OrderItemRepository;
use Delivery\Validators\OrderItemValidator;


class OrderItemsController extends Controller
{

    /**
     * @var OrderItemRepository
     */
    protected $repository;

    /**
     * @var OrderItemValidator
     */
    protected $validator;

    public function __construct(OrderItemRepository $repository, OrderItemValidator $validator)
    {
        $this->repository = $repository;
        $this->validator  = $validator;
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->repository->pushCriteria(app('Prettus\Repository\Criteria\RequestCriteria'));
        $orderItems = $this->repository->all();

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $orderItems,
            ]);
        }

        return view('orderItems.index', compact('orderItems'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  OrderItemCreateRequest $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(OrderItemCreateRequest $request)
    {

        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_CREATE);

            $orderItem = $this->repository->create($request->all());

            $response = [
                'message' => 'OrderItem created.',
                'data'    => $orderItem->toArray(),
            ];

            if ($request->wantsJson()) {

                return response()->json($response);
            }

            return redirect()->back()->with('message', $response['message']);
        } catch (ValidatorException $e) {
            if ($request->wantsJson()) {
                return response()->json([
                    'error'   => true,
                    'message' => $e->getMessageBag()
                ]);
            }

            return redirect()->back()->withErrors($e->getMessageBag())->withInput();
        }
    }


    /**
     * Display the specified resource.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $orderItem = $this->repository->find($id);

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $orderItem,
            ]);
        }

        return view('orderItems.show', compact('orderItem'));
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        $orderItem = $this->repository->find($id);

        return view('orderItems.edit', compact('orderItem'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  OrderItemUpdateRequest $request
     * @param  string            $id
     *
     * @return Response
     */
    public function update(OrderItemUpdateRequest $request, $id)
    {

        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_UPDATE);

            $orderItem = $this->repository->update($request->all(), $id);

            $response = [
                'message' => 'OrderItem updated.',
                'data'    => $orderItem->toArray(),
            ];

            if ($request->wantsJson()) {

                return response()->json($response);
            }

            return redirect()->back()->with('message', $response['message']);
        } catch (ValidatorException $e) {

            if ($request->wantsJson()) {

                return response()->json([
                    'error'   => true,
                    'message' => $e->getMessageBag()
                ]);
            }

            return redirect()->back()->withErrors($e->getMessageBag())->withInput();
        }
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $deleted = $this->repository->delete($id);

        if (request()->wantsJson()) {

            return response()->json([
                'message' => 'OrderItem deleted.',
                'deleted' => $deleted,
            ]);
        }

        return redirect()->back()->with('message', 'OrderItem deleted.');
    }
}
