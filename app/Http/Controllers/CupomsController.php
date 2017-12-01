<?php

namespace Delivery\Http\Controllers;

use Illuminate\Http\Request;

use Delivery\Http\Requests;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use Delivery\Http\Requests\CupomCreateRequest;
use Delivery\Http\Requests\CupomUpdateRequest;
use Delivery\Repositories\CupomRepository;
use Delivery\Validators\CupomValidator;


class CupomsController extends Controller
{

    /**
     * @var CupomRepository
     */
    protected $repository;

    /**
     * @var CupomValidator
     */
    protected $validator;

    public function __construct(CupomRepository $repository, CupomValidator $validator)
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
        $cupoms = $this->repository->all();

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $cupoms,
            ]);
        }

        return view('cupoms.index', compact('cupoms'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  CupomCreateRequest $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(CupomCreateRequest $request)
    {

        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_CREATE);

            $cupom = $this->repository->create($request->all());

            $response = [
                'message' => 'Cupom created.',
                'data'    => $cupom->toArray(),
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
        $cupom = $this->repository->find($id);

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $cupom,
            ]);
        }

        return view('cupoms.show', compact('cupom'));
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

        $cupom = $this->repository->find($id);

        return view('cupoms.edit', compact('cupom'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  CupomUpdateRequest $request
     * @param  string            $id
     *
     * @return Response
     */
    public function update(CupomUpdateRequest $request, $id)
    {

        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_UPDATE);

            $cupom = $this->repository->update($request->all(), $id);

            $response = [
                'message' => 'Cupom updated.',
                'data'    => $cupom->toArray(),
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
                'message' => 'Cupom deleted.',
                'deleted' => $deleted,
            ]);
        }

        return redirect()->back()->with('message', 'Cupom deleted.');
    }
}
