<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Entities\Domain;

/**
 * Class DomainTransformer.
 *
 * @package namespace App\Transformers;
 */
class DomainTransformer extends TransformerAbstract
{
    /**
     * Transform the Domain entity.
     *
     * @param \App\Entities\Domain $model
     *
     * @return array
     */
    public function transform(Domain $model)
    {
        return [
            'id'         => (int) $model->id,

            /* place your other model properties here */

            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at
        ];
    }
}
