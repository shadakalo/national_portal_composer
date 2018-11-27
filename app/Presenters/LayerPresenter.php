<?php

namespace App\Presenters;

use App\Transformers\LayerTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class LayerPresenter.
 *
 * @package namespace App\Presenters;
 */
class LayerPresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new LayerTransformer();
    }
}
