<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VipCard extends Model
{
    //

    /**
     * 通过商店id获取会员卡信息
     *
     * @param $shop_id
     * @param array $select
     * @return mixed
     */
    public static function getVipCardToShopId($shop_id,$select=['*'])
    {
        $universal_vip_card_id = VipCardShop::where('shop_id',$shop_id)->pluck('vip_card_id');

        return self::where('shop_id',$shop_id)->orWhere(function ($query) use ($shop_id,$universal_vip_card_id){
            $query->where('universal',1)
                ->where('company_id',request()->user['company_id'])
                ->whereIn('vip_cards.id', $universal_vip_card_id);
        })->select($select)->get();
    }

    /**
     * 通过商店id获取会员卡Select数据
     *
     * @param $shop_id
     * @param bool $id
     * @return mixed
     */
    public static function getVipCardToShopIdSelect($shop_id,$id=false)
    {
        $vip_card = self::getVipCardToShopId($shop_id,['name','id as value'])->toArray();

        array_unshift($vip_card, ['name'=>'请选择','value'=>'']);

        if($id){
            foreach ($vip_card as $key=>$val){
                if($val['value'] == $id) $vip_card[$key]['selected'] = true;
            }
        }

        return $vip_card;
    }

    /**
     * 多对多 当会员卡为通用卡时所绑定的商店信息
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function shops()
    {
        return $this->belongsToMany('App\Models\Shop','vip_card_shop');
    }
}
