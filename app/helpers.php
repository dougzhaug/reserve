<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/12/19
 * Time: 11:17
 */

if (! function_exists('success')) {
    /**
     * 成功提示信息
     *
     * @param $message
     * @param bool $url
     * @param int $expire
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    function success($message,$url=false,$expire=3)
    {
        $message = [$message,$expire * 1000];
        if($url){
            return redirect($url)->withErrors($message, 'success');
        }else{
            return back()->withErrors($message, 'success');
        }
    }
}

if (! function_exists('error')) {
    /**
     * 失败提示信息
     *
     * @param $message
     * @param bool $url
     * @param int $expire
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    function error($message,$url=false,$expire=3)
    {
        $message = [$message,$expire * 1000];
        if($url){
            return redirect($url)->withErrors($message, 'error');
        }else{
            return back()->withErrors($message, 'error');
        }
    }
}

if (! function_exists('warning')) {
    /**
     * 警告提示信息
     *
     * @param $message
     * @param bool $url
     * @param int $expire
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    function warning($message,$url=false,$expire=3)
    {
        $message = [$message,$expire * 1000];
        if($url){
            return redirect($url)->withErrors($message, 'warning');
        }else{
            return back()->withErrors($message, 'warning');
        }
    }
}

if (! function_exists('bcrypt_random')) {
    /**
     * 随机字符串
     *
     * @param bool $string
     * @param int $length
     * @return string
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

/**
 * 生成树状结构数据
 *
 * @param $arr
 * @return array
 */
function make_tree($arr) {
    if (!function_exists('makeTree')) {

        function makeTree($arr, $parent_id = 0) {
            $new_arr = array();
            foreach ($arr as $k => $v) {
                if ($v->pid == $parent_id) {
                    $new_arr[] = $v;
                    unset($arr[$k]);
                }
            }
            foreach ($new_arr as &$a) {
                $a->children = makeTree($arr, $a->id);
            }
            return $new_arr;
        }

    }
    return makeTree($arr);
}

/**
 * 生成带前缀的树状结构数据
 *
 * @param $arr
 * @return array
 */
function make_tree_with_name_pre($arr) {
    $arr = make_tree($arr);
    if (!function_exists('makeTreeWithNamePre')) {

        function makeTreeWithNamePre($arr, $prestr = '') {
            $new_arr = array();
            foreach ($arr as $v) {
                if ($prestr) {
                    if ($v == end($arr)) {
                        $v->name = $prestr . '└─ ' . $v->name;
                    } else {
                        $v->name = $prestr . '├─ ' . $v->name;
                    }
                }

                if ($prestr == '') {
                    $prestr_for_children = '&nbsp;&nbsp;';
                } else {
                    if ($v == end($arr)) {
                        $prestr_for_children = $prestr . '&nbsp;&nbsp;&nbsp;&nbsp;';
                    } else {
                        $prestr_for_children = $prestr . '│ ';
                    }
                }
                $v->children = makeTreeWithNamePre($v->children, $prestr_for_children);

                $new_arr[] = $v;
            }
            return $new_arr;
        }
    }
    return makeTreeWithNamePre($arr);
}

/**
 * 变成树状结构数组
 *
 * @param $arr
 * @return array
 */
function make_tree_to_array($arr) {
    $tree = make_tree_with_name_pre($arr);
    if (!function_exists('makeTreeToArray')) {
        function makeTreeToArray($tree){
            static $new_tree = [];
            foreach ($tree as $key=>$val){
                if (isset($val['children']) && $val['children']){
                    $children = $val['children'];
                    unset($val['children']);
                    $new_tree[] = $val;
                    makeTreeToArray($children);
                }else{
                    $new_tree[] = $val;
                }
            }
            return $new_tree;
        }
    }
    return makeTreeToArray($tree);
}


if (!function_exists('is_assoc')){
    /**
     * 判断是否为索引数组
     *
     * @param $arr
     * @return bool
     */
    function is_assoc($arr)
    {
        return array_keys($arr) !== range(0, count($arr) - 1);
    }
}