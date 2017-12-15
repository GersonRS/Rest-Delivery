<?php

namespace Delivery\Http\Controllers\Api\v1;

use Delivery\Http\Controllers\Controller;
use Delivery\Repositories\CupomRepository;
use Delivery\Validators\CupomValidator;


class ApiCupomsController extends Controller
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
     * Display the specified resource.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function show($code)
    {
        $cupom = $this->repository
            ->skipPresenter(false)
            ->scopeQuery(function($query) use($code) {
                return $query->where('code',$code);
            })->firstOrNew();

        return $cupom;
    }

}
