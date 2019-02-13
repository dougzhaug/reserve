<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Chapter extends Model
{
    //
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'goods_id','name', 'summary', 'charge' , 'files', 'file_format', 'sort',
    ];

    /**
     * files 修改器
     *
     * @param $value
     */
    public function setFilesAttribute($value)
    {
        $this->attributes['files'] = json_encode($value);
    }

    /**
     * files 获取器
     *
     * @param $value
     * @return mixed
     */
    public function getFilesAttribute($value)
    {
        return json_decode($value,true);
    }
}
