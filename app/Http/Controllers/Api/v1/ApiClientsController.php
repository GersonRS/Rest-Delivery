<?php

namespace Delivery\Http\Controllers\Api\v1;

use Delivery\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Delivery\Http\Requests;
use Illuminate\Support\Facades\Auth;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use Delivery\Http\Requests\ClientCreateRequest;
use Delivery\Repositories\ClientRepository;
use Delivery\Validators\ClientValidator;


class ApiClientsController extends Controller
{

    /**
     * @var ClientRepository
     */
    protected $repository;

    /**
     * @var ClientValidator
     */
    protected $validator;

    public function __construct(ClientRepository $repository, ClientValidator $validator)
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
        $clients = $this->repository->all();

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $clients,
            ]);
        }

        return view('clients.index', compact('clients'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  ClientCreateRequest $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(ClientCreateRequest $request)
    {

        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_CREATE);

            $data = $request->all();
            $data['user_id'] = Auth::user()->id;

            $client = $this->repository->create($data);

            return $this->repository
                ->skipPresenter(false)
                ->find($client->id);

        } catch (ValidatorException $e) {
            if ($request->wantsJson()) {
                return response()->json([
                    'error'   => true,
                    'message' => $e->getMessageBag()
                ]);
            }
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
        $client = $this->repository->find($id);

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $client,
            ]);
        }

        return view('clients.show', compact('client'));
    }
}
