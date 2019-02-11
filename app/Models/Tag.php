<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
    ];

    /**
     * 通过标签获取标签id
     *
     * @param $tag
     * @return array
     */
    public static function getTagIds($tag)
    {
        $ids = [];
        foreach ($tag as $value){
            if(!self::filteringSensitiveWords($value)) continue;
            $tagModel = self::where('name',$value)->first();
            if(!$tagModel){
                $ids[] = self::insertGetId(['name'=>$value]);
            }else{
                $ids[] = $tagModel['id'];
            }
        }

       return $ids;
    }

    /**
     * 过滤敏感词汇
     *
     * @param $word
     * @return bool
     */
    private static function filteringSensitiveWords($word)
    {
        return true;
    }

}
