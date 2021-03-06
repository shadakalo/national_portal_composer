<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class Profile.
 *
 * @package namespace App\Entities;
 */
class Profile extends Model implements Transformable
{
    use TransformableTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['user_id','first_name','last_name','details','image'];

    public function User(){
        return $this->belongsTo('App\User');
    }

}
