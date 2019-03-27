<?php

namespace App\Models;


class Shop extends Model
{
    //

    /**
     * logo 修改器
     *
     * @param $value
     */
    public function setLogoAttribute($value)
    {
        $this->attributes['logo'] = json_encode($value);
    }

    /**
     * logo 获取器
     *
     * @param $value
     * @return mixed
     */
    public function getLogoAttribute($value)
    {
        return $this->getImageUrl($value,0);
    }

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
        return $this->getImageUrl($value);
    }

    /**
     * 多对多 获取商店下的所有用户
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function users()
    {
        return $this->belongsToMany('App\Models\User','user_company_shop')->withPivot('company_id','remark','status');
    }

    /**
     * 获取店铺下拉
     *
     * @param bool $id
     * @param array $where
     * @return mixed
     */
    public static function getShopSelect($id=false,$where=[])
    {
        $shops = self::where(array_merge($where,['status'=>1]))->select(['id','name','id as value'])->get()->toArray();

        array_unshift($shops, ['name'=>'请选择','value'=>'']);

        if($id){
            foreach ($shops as $key=>$val){
                if($val['value'] == $id) $shops[$key]['selected'] = true;
            }
        }

        return $shops;
    }
}
