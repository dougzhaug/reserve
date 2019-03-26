<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model as EloquentModel;

class Model extends EloquentModel
{
    //

    /**
     * @param $value
     * @param bool $key    false 返回数组  0|1|2...返回对应的下标图片
     * @return array|\Illuminate\Config\Repository|mixed|string
     */
    public function getImageUrl($value,$key=false)
    {
        $array = json_decode($value,true);
        if($array){
            if(is_array($array)){
                if(is_int($key)){
                    if(isset($array[$key])){
                        return img($array[$key]);
                    }
                }else{
                    foreach ($array as $k=>$v){
                        $array[$k] = img($k);
                    }
                    return $array;
                }

            }else{
                return img($array);
            }
        }

        return img();
    }
}
