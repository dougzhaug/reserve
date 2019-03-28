<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserVipCard extends Model
{
    //

    protected $table = 'user_vip_card';

    protected $fillable = [
        'card_number', 'user_id', 'vip_card_id' , 'balance', 'expired_at', 'status',
    ];

    /**
     * 生成会员卡
     *
     * @param $user_id
     * @param $vip_card_id
     * @param bool $balance
     * @param bool $status
     * @return mixed
     */
    public static function build($user_id,$vip_card_id,$balance=false,$status=false)
    {
        $vip_card = VipCard::find($vip_card_id);
        if(!$vip_card){
            //会员卡不存在
            trigger_error("会员卡异常");
        }

        if($vip_card['status'] != 1){
            //会员卡状态异常
            trigger_error("会员卡状态异常");
        }

        if(!$balance){
            $balance = self::getBalance($vip_card);
        }

        $old = UserVipCard::where(['user_id'=>$user_id,'vip_card_id'=>$vip_card_id])->first();
        if($old){
            if($old['status'] != 1){
                //旧卡状态异常
                trigger_error("旧会员卡状态异常");
            }

            return $old->update(['balance'=>$old['balance']+$balance,'expired_at'=>self::getExpired($vip_card)]);
        }else{
            return UserVipCard::create([
                'card_number'=> self::makeCardNumber($vip_card),
                'user_id'=> $user_id,
                'vip_card_id'=> $vip_card_id,
                'balance'=> $balance,
                'expired_at'=> self::getExpired($vip_card),
                'status'=> $status ? : 1,
            ]);
        }
    }

    /**
     * 获取余额
     *
     * @param $vip_card
     * @return mixed
     */
    public static function getBalance($vip_card)
    {
        if(in_array($vip_card['type'],[1,2])){ //充值卡
            return $vip_card['worth'];
        }else{
            //会员卡类型异常
            trigger_error("会员卡类型异常");
        }
    }

    public static function getExpired($vip_card)
    {
        if($vip_card['valid_date']){
            return date("Y-m-d",strtotime("+" . $vip_card['valid_date'] . " day")) . " 23:59:59";
        }
        return '9999-99-99 99:99:99';
    }

    public static function makeCardNumber($vip_card)
    {

        $prefix = '444';
        if($vip_card['type'] == 1){
            $prefix = '860';
        }elseif($vip_card['type'] == 2){
            $prefix = '660';
        }

        return $prefix . date('Ymds').rand(10000,99999);
    }
}
