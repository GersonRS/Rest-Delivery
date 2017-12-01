<?php

namespace Delivery\Repositories;

use Delivery\Presenters\RolePresenter;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use Delivery\Repositories\RoleRepository;
use Delivery\Models\Role;
use Delivery\Validators\RoleValidator;

/**
 * Class RoleRepositoryEloquent
 * @package namespace Delivery\Repositories;
 */
class RoleRepositoryEloquent extends BaseRepository implements RoleRepository
{

    protected $skipPresenter = true;

    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Role::class;
    }

    /**
    * Specify Validator class name
    *
    * @return mixed
    */
    public function validator()
    {

        return RoleValidator::class;
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
        return RolePresenter::class;
    }
}
