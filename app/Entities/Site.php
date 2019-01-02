<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class Site.
 *
 * @package namespace App\Entities;
 */
class Site extends Model implements Transformable
{
    use TransformableTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['sitename_bn','sitename_en','site_email','site_slogan_bn','site_slogan_en','cluster_id'];



    public function users()
    {
        //return $this->belongsToMany('App\User');
        return $this->belongsToMany('App\User','user_site', 'site_id', 'user_id');
    }


    public function domains()
    {
        return $this->hasMany('App\Entities\Domain');
    }


    public function clusterInfo()
    {
        return $this->belongsTo('App\Entities\ClusterInfo','cluster_id', 'id');
    }

}
