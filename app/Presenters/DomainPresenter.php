<?php

namespace App\Presenters;

use App\Transformers\DomainTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class DomainPresenter.
 *
 * @package namespace App\Presenters;
 */
class DomainPresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new DomainTransformer();
    }
}
