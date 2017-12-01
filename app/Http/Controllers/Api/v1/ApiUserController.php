<?php

namespace Delivery\Http\Controllers\Api\v1;

use Delivery\Http\Controllers\Controller;
use Delivery\Repositories\UserRepository;
use Illuminate\Support\Facades\Auth;

class ApiUserController extends Controller
{
    private $repository;

    public function __construct(UserRepository $repository)
    {
        $this->repository = $repository;
    }
    public function index()
    {
        $userId = Auth::user()->id;

        $user = $this->repository
            ->skipPresenter(false)
            ->find($userId);

        return $user;
    }
}
