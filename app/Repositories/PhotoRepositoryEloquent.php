<?php

namespace Delivery\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use Delivery\Repositories\PhotoRepository;
use Delivery\Models\Photo;
use Delivery\Validators\PhotoValidator;

/**
 * Class PhotoRepositoryEloquent
 * @package namespace Delivery\Repositories;
 */
class PhotoRepositoryEloquent extends BaseRepository implements PhotoRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Photo::class;
    }

    /**
    * Specify Validator class name
    *
    * @return mixed
    */
    public function validator()
    {

        return PhotoValidator::class;
    }


    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
}
