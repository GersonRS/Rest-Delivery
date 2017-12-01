<?php

namespace Delivery\Presenters;

use Delivery\Transformers\OrderItemTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class OrderItemPresenter
 *
 * @package namespace Delivery\Presenters;
 */
class OrderItemPresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new OrderItemTransformer();
    }
}
