<?php

namespace Delivery\Http\Controllers\Api\v1;

use Delivery\Repositories\CategoryRepository;
use Delivery\Http\Controllers\Controller;

class ApiCategoryController extends Controller
{
    private $repository;

    public function __construct(CategoryRepository $repository)
    {
        $this->repository = $repository;
    }
    public function listByCompany($id)
    {
        $categories = $this->repository
            ->skipPresenter(false)
            ->scopeQuery(function($query) use($id) {
                return $query->where('company_id',$id);
            })->all();

        return $categories;
    }
}
