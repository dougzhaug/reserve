<?php

namespace App\Models;


class Reserve extends Model
{
    //
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'company_id','shop_id','manager_id','name', 'type', 'min_ahead_days' , 'max_ahead_days', 'config', 'status'
    ];

    /**
     * status 修改器
     *
     * @param $value
     */
    public function setStatusAttribute($value)
    {
        $this->attributes['status'] = $value == 'off' || !$value ? 0 : 1;
    }

    public function getConfigAttribute($value)
    {
        return json_decode($value,true);
    }
}
