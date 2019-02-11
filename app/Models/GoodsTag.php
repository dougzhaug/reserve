<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GoodsTag extends Model
{
    protected $table = 'goods_tag';

    public static function makeTag($goods,$tag)
    {
        $tag = explode(',',$tag);
        $tag_ids = Tag::getTagIds($tag);

        $insert = [];
        foreach ($tag_ids as $value){
            $insert[] = ['goods_id'=>$goods['id'],'tag_id'=>$value];
        }

        self::where('goods_id',$goods['id'])->delete();

        return self::insert($insert);
    }
}
