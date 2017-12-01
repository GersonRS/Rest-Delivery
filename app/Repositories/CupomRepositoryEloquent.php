<?php

namespace Delivery\Repositories;

use Delivery\Presenters\CupomPresenter;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use Delivery\Repositories\CupomRepository;
use Delivery\Models\Cupom;
use Delivery\Validators\CupomValidator;

/**
 * Class CupomRepositoryEloquent
 * @package namespace Delivery\Repositories;
 */
class CupomRepositoryEloquent extends BaseRepository implements CupomRepository
{

    protected $skipPresenter = true;
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Cupom::class;
    }

    /**
    * Specify Validator class name
    *
    * @return mixed
    */
    public function validator()
    {

        return CupomValidator::class;
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
        return CupomPresenter::class;
    }

    public function findByCode($code)
    {
        $result = $this->model
            ->where('code',$code)
            ->where('used',0)
            ->first();
        if ($result) {
            return $this->parserResult($result);
        }
        throw (new ModelNotFoundException())->setModel(get_class($this->model));
    }
}
