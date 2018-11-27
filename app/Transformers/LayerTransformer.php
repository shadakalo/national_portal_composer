<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Entities\Layer;

/**
 * Class LayerTransformer.
 *
 * @package namespace App\Transformers;
 */
class LayerTransformer extends TransformerAbstract
{
    /**
     * Transform the Layer entity.
     *
     * @param \App\Entities\Layer $model
     *
     * @return array
     */
    public function transform(Layer $model)
    {
        return [
            'id'         => (int) $model->id,

            /* place your other model properties here */

            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at
        ];
    }
}
