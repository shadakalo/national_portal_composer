<?php

namespace App\Presenters;

use App\Transformers\ClusterInfoTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class ClusterInfoPresenter.
 *
 * @package namespace App\Presenters;
 */
class ClusterInfoPresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new ClusterInfoTransformer();
    }
}
