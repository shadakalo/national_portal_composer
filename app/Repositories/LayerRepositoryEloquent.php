<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\LayerRepository;
use App\Entities\Layer;
use App\Validators\LayerValidator;

/**
 * Class LayerRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class LayerRepositoryEloquent extends BaseRepository implements LayerRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Layer::class;
    }

    /**
    * Specify Validator class name
    *
    * @return mixed
    */
    public function validator()
    {

        return LayerValidator::class;
    }


    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
}
