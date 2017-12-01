<?php

namespace Delivery\Http\Controllers\Api\v1;

use Delivery\Repositories\CompanyRepository;
use Delivery\Http\Controllers\Controller;

class ApiCompanyController extends Controller
{
    private $repository;
    private $with = ['category','order','user'];

    public function __construct(CompanyRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $companies = $this->repository
            ->skipPresenter(false)
            ->with($this->with)
            ->scopeQuery(function($query){
                return $query->where('active',true);
            })->all();

        return $companies;
    }

    /**
     * Display the specified resource.
     *
     * @param  \Delivery\Models\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $company = $this->repository
            ->skipPresenter(false)
            ->with($this->with)
            ->find($id);
        return $company;
    }
}
