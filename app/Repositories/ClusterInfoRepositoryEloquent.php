<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\ClusterInfoRepository;
use App\Entities\ClusterInfo;
use App\Validators\ClusterInfoValidator;

/**
 * Class ClusterInfoRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class ClusterInfoRepositoryEloquent extends BaseRepository implements ClusterInfoRepository
{
    

    public function selectBoxList(string $descricao = 'cluster_ip', string $chave = 'id')
    {
        return $this->model->pluck($descricao, $chave)->all();
    }

    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return ClusterInfo::class;
    }

    /**
    * Specify Validator class name
    *
    * @return mixed
    */
    public function validator()
    {

        return ClusterInfoValidator::class;
    }


    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
}
