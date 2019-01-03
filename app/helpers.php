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

//生成树状结构数据
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

//生成带前缀的树状结构数据
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

function make_tree_to_array($tree) {
    $tree = make_tree_with_name_pre($tree);
    if (!function_exists('makeTreeToArray')) {
        function makeTreeToArray($tree){

        }
    }

}

function make_tree_for_select($arr, $default, $depth = 0) {
    $arr = make_tree_with_name_pre($arr);
    if (!function_exists('makeTreeForSelect')) {

        function makeTreeForSelect($arr, $default, $depth, $recursion_count = 0, $ancestor_ids = '') {
            $recursion_count++;
            $str = '';
            foreach ($arr as $v) {
                $value = "";
                if ($v->id == $default) {
                    $value = "selected=selected";
                }
                $str .= "<option value='{$v->id}' data-depth='{$recursion_count}' data-ancestor_ids='" . ltrim($ancestor_ids, ',') . "' {$value}>{$v->name}</option>";
                if ($v->pid == 0) {
                    $recursion_count = 1;
                }
                if ($depth == 0 || $recursion_count < $depth) {
                    $str .= makeTreeForSelect($v->children,$default, $depth, $recursion_count, $ancestor_ids . ',' . $v->id);
                }
            }
            return $str;
        }

    }
    return makeTreeForSelect($arr, $default, $depth);
}

/**
 * 判断是否为索引数组
 */
if (!function_exists('is_assoc')) {
    function is_assoc($arr)
    {
        return array_keys($arr) !== range(0, count($arr) - 1);
    }
}