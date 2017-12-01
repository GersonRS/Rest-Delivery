<?php

namespace Delivery\Repositories;

use Delivery\Presenters\CompanyPresenter;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use Delivery\Repositories\CompanyRepository;
use Delivery\Models\Company;
use Delivery\Validators\CompanyValidator;

/**
 * Class CompanyRepositoryEloquent
 * @package namespace Delivery\Repositories;
 */
class CompanyRepositoryEloquent extends BaseRepository implements CompanyRepository
{

    protected $skipPresenter = true;

    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Company::class;
    }

    /**
    * Specify Validator class name
    *
    * @return mixed
    */
    public function validator()
    {

        return CompanyValidator::class;
    }


    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

    public function presenter()
    {
        return CompanyPresenter::class;
    }
}
