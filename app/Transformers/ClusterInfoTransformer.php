<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Entities\ClusterInfo;

/**
 * Class ClusterInfoTransformer.
 *
 * @package namespace App\Transformers;
 */
class ClusterInfoTransformer extends TransformerAbstract
{
    /**
     * Transform the ClusterInfo entity.
     *
     * @param \App\Entities\ClusterInfo $model
     *
     * @return array
     */
    public function transform(ClusterInfo $model)
    {
        return [
            'id'         => (int) $model->id,

            /* place your other model properties here */

            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at
        ];
    }
}
