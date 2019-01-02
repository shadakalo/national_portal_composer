<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class ClusterInfo.
 *
 * @package namespace App\Entities;
 */
class ClusterInfo extends Model implements Transformable
{
    use TransformableTrait;

    //protected $table = 'cluster_infos';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['cluster_ip','cluster_username','cluster_password'];



    public function sites()
    {
        return $this->hasMany('App\Entities\Site','cluster_id', 'id');
    }

}
