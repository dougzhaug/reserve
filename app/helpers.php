<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/12/19
 * Time: 11:17
 */

if (! function_exists('bcrypt_random')) {
    /**
     * @param bool $string
     * @param int $length
     */
    function bcrypt_random($string=false,$length=16)
    {
        if($string){
            $encrypt = $string;
            $str_length = strlen($string);
            if($str_length < $length){
                $encrypt = $string.str_random($length-$str_length);
            }
        }else{
            $encrypt = str_random($length);
        }

        return bcrypt($encrypt);
    }
}