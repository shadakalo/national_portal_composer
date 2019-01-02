<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class Domain.
 *
 * @package namespace App\Entities;
 */
class Domain extends Model implements Transformable
{
    use TransformableTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['site_id','domain_url','domain_alias_bn','domain_alias_en'];



    public function site()
    {
        return $this->belongsTo('App\Entities\Site');
    }

}
