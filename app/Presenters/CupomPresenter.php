<?php

namespace Delivery\Presenters;

use Delivery\Transformers\CupomTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class CupomPresenter
 *
 * @package namespace Delivery\Presenters;
 */
class CupomPresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new CupomTransformer();
    }
}
