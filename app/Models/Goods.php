<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;

class Goods extends Model
{
    use SoftDeletes;
    protected $dates = ['deleted_at'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'agent_id','name', 'category', 'price' , 'images', 'author', 'summary',
    ];

    /**
     * images 修改器
     *
     * @param $value
     */
    public function setImagesAttribute($value)
    {
        $this->attributes['images'] = json_encode($value);
    }

    /**
     * images 获取器
     *
     * @param $value
     * @return mixed
     */
    public function getImagesAttribute($value)
    {
        return json_decode($value,true);
    }
}
