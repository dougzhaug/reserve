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

    /**
     * 获取-商品类型
     *
     * @return array
     */
    public static function getCategory()
    {
        return [
            [
                'id'=>1,
                'name'=>'图集',
                'value'=>1,
            ],
            [
                'id'=>10,
                'name'=>'漫画',
                'value'=>10,
            ],
            [
                'id'=>20,
                'name'=>'小说',
                'value'=>20,
            ],
            [
                'id'=>30,
                'name'=>'声音',
                'value'=>30,
            ],
            [
                'id'=>40,
                'name'=>'影视',
                'value'=>40,
            ],
        ];
    }

    /**
     * 获取商品类型下拉
     * @param bool $id
     * @return array
     */
    public static function getCategorySelect($id=false)
    {
        $category = self::getCategory();
        array_unshift($category, ['name'=>'请选择','value'=>'']);

        if($id){
            foreach ($category as $key=>$val){
                if($val['value'] == $id) $category[$key]['selected'] = true;
            }
        }

        return $category;
    }

    public function tags()
    {
        return $this->belongsToMany('App\Models\Tag');
    }
}
