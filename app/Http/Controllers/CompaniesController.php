<?php

namespace Delivery\Http\Controllers;

use Illuminate\Http\Request;

use Delivery\Http\Requests;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use Delivery\Http\Requests\CompanyCreateRequest;
use Delivery\Http\Requests\CompanyUpdateRequest;
use Delivery\Repositories\CompanyRepository;
use Delivery\Validators\CompanyValidator;


class CompaniesController extends Controller
{

    /**
     * @var CompanyRepository
     */
    protected $repository;

    /**
     * @var CompanyValidator
     */
    protected $validator;

    public function __construct(CompanyRepository $repository, CompanyValidator $validator)
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
        $companies = $this->repository->all();

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $companies,
            ]);
        }

        return view('companies.index', compact('companies'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  CompanyCreateRequest $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(CompanyCreateRequest $request)
    {

        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_CREATE);

            $company = $this->repository->create($request->all());

            $response = [
                'message' => 'Company created.',
                'data'    => $company->toArray(),
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
        $company = $this->repository->find($id);

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $company,
            ]);
        }

        return view('companies.show', compact('company'));
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

        $company = $this->repository->find($id);

        return view('companies.edit', compact('company'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  CompanyUpdateRequest $request
     * @param  string            $id
     *
     * @return Response
     */
    public function update(CompanyUpdateRequest $request, $id)
    {

        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_UPDATE);

            $company = $this->repository->update($request->all(), $id);

            $response = [
                'message' => 'Company updated.',
                'data'    => $company->toArray(),
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
                'message' => 'Company deleted.',
                'deleted' => $deleted,
            ]);
        }

        return redirect()->back()->with('message', 'Company deleted.');
    }
}
