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

    /**
     * 一对多 获取预约项目
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function reserveEvents()
    {
        return $this->hasMany('App\Models\ReserveEvent');
    }
}
