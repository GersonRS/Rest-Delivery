<?php

namespace Delivery\Http\Controllers\Api\v1;

use Delivery\Http\Resources\CompanyResource;
use Delivery\Models\Company;
use Illuminate\Http\Request;
use Delivery\Http\Controllers\Controller;

class ApiCompanyController extends Controller
{
    public function index()
    {
        $companies = Company::where('active',true)->get();
        $result = CompanyResource::collection($companies);
        return $result;
    }

    public function show($id)
    {
        $companies = Company::find($id);
        $result = new CompanyResource($companies);
        return $result;
    }
}
