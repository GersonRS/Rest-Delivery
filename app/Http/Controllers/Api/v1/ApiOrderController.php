<?php

namespace Delivery\Http\Controllers\Api\v1;

use Delivery\Http\Requests\CheckoutRequest;
use Delivery\Http\Requests\OrderCreateRequest;
use Delivery\Repositories\OrderRepository;
use Delivery\Repositories\UserRepository;
use Delivery\Services\OrderService;
use Delivery\Http\Controllers\Controller;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use Delivery\Validators\OrderValidator;
use Illuminate\Support\Facades\Auth;

class ApiOrderController extends Controller
{

    /**
     * @var OrderRepository
     */
    protected $repository;
    /**
     * @var UserRepository
     */
    private $userRepository;
    /**
     * @var OrderService
     */
    private $service;
    /**
     * with
     */
    private $with = ['user','items','cupom'];

    /**
     * @var OrderValidator
     */
    protected $validator;

    public function __construct(
        OrderRepository $repository,
        OrderValidator $validator,
        UserRepository $userRepository,
        OrderService $service
    )
    {
        $this->repository = $repository;
        $this->validator  = $validator;
        $this->userRepository = $userRepository;
        $this->service = $service;
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->repository->pushCriteria(app('Prettus\Repository\Criteria\RequestCriteria'));

        $clientId = Auth::user()->id;

        $orders = $this->repository
            ->skipPresenter(false)
            ->with($this->with)
            ->scopeQuery(function($query) use($clientId){
                return $query->where('user_id',$clientId);
            })->all();

        return $orders;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  OrderCreateRequest $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(OrderCreateRequest $request)
    {

        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_CREATE);

            $data = $request->all();

            $o = $this->service->create($data);

            return $this->repository
                ->skipPresenter(false)
                ->with($this->with)
                ->find($o->id);

        } catch (ValidatorException $e) {
            return response()->json([
                'error'   => true,
                'message' => $e->getMessageBag()
            ]);
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
        $o = $this->repository
            ->skipPresenter(false)
            ->with($this->with)
            ->find($id);
        return $o;
    }
}