<?php

namespace Delivery\Presenters;

use Delivery\Transformers\PhotoTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class PhotoPresenter
 *
 * @package namespace Delivery\Presenters;
 */
class PhotoPresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new PhotoTransformer();
    }
}
