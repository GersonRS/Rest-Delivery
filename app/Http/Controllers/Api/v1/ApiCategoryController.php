<?php

namespace Delivery\Http\Controllers\Api\v1;

use Delivery\Http\Resources\CategoryResource;
use Delivery\Models\Category;
use Illuminate\Http\Request;
use Delivery\Http\Controllers\Controller;

class ApiCategoryController extends Controller
{
    public function listByCompany($id)
    {
        $categories = Category::where('company_id',$id)->get();
        $result = CategoryResource::collection($categories);
        return $result;
    }
}
