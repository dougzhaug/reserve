<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/12/19
 * Time: 11:17
 */

if (! function_exists('make_username')) {
    /**
     * 生成用户名
     *
     * @param int $length
     * @param bool $prefix
     * @return string
     */
    function make_username($length=12,$prefix=false)
    {
        return $prefix ? : 'B_' . str_random($length);
    }
}

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
                if ($v['pid'] == $parent_id) {
                    $new_arr[] = $v;
                    unset($arr[$k]);
                }
            }
            foreach ($new_arr as &$a) {
                $a['children'] = makeTree($arr, $a['id']);
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

/**
 * 生成左侧菜单HTML
 *
 * @param $arr
 * @return string
 */
function make_menu($arr) {
    $tree = make_tree($arr);

    if (!function_exists('makeTreeToArray')) {
        function makeMenu($tree){
            $menu = '';
            foreach ($tree as $key=>$val){
                if(!$val['is_nav']){
                    continue;
                }

                try{
                    $href= route($val['name']);
                }catch (Exception $e){
                    $href = url($val['url']??'/');
                }

                if(empty($val['children'])){
                    $menu .= '<li> <a href="'. $href .'" id="nav-index" class="waves-effect"><i  class="'. $val['icon'] .' fa-fw"></i> <span class="hide-menu"> ' . $val['title'] . ' </span></a> </li>';
                }else{
                    $menu .= '<li> <a href="javascript:void(0)" class="waves-effect"><i class="' . $val['icon'] . ' fa-fw" data-icon="v"></i> <span class="hide-menu"> ' . $val['title'] . ' <span class="fa arrow"></span> </span></a><ul class="nav nav-second-level">';
                    $menu .= makeMenu($val['children']);
                    $menu .= '</ul></li>';
                }
            }
            return $menu;
        }
    }
    return makeMenu($tree);
}

if (!function_exists('img_path')){
    /**
     * 获取图片路径
     *
     * @param bool $source
     * @return \Illuminate\Config\Repository|mixed
     */
    function img_path($source=false)
    {
        switch ($source){
            case 'local':
                return '/storage/uploads/';
                break;
            case 'qiniu':
                return config('filesystems.disks.qiniu.domain') . '/';
                break;
            default:
                return config('filesystems.disks.qiniu.domain') . '/';
                break;
        }
    }
}

if (!function_exists('img')){
    function img($image='')
    {
        $img = img_path().$image;

        if(!@getimagesize($img)){
            $img = config('filesystems.default_image');
        }

        return $img;
    }
}

if (!function_exists('file_format')) {
    /**
     * 获取文件格式
     *
     * @param $str
     * @return string
     */
    function file_format($str)
    {
        // 取文件后缀名
        $str = strtolower(pathinfo($str, PATHINFO_EXTENSION));
        // 图片格式
        $image = array('webp', 'jpg', 'png', 'ico', 'bmp', 'gif', 'tif', 'pcx', 'tga', 'bmp', 'pxc', 'tiff', 'jpeg', 'exif', 'fpx', 'svg', 'psd', 'cdr', 'pcd', 'dxf', 'ufo', 'eps', 'ai', 'hdri');
        // 音频格式
        $audio = array('mp3');
        // 视频格式
        $video = array('mp4', 'avi', '3gp', 'rmvb', 'gif', 'wmv', 'mkv', 'mpg', 'vob', 'mov', 'flv', 'swf', 'ape', 'wma', 'aac', 'mmf', 'amr', 'm4a', 'm4r', 'ogg', 'wav', 'wavpack');
        // 压缩格式
        $zip = array('rar', 'zip', 'tar', 'cab', 'uue', 'jar', 'iso', 'z', '7-zip', 'ace', 'lzh', 'arj', 'gzip', 'bz2', 'tz');
        // Pdf格式
        $pdf = array('pdf');
        // 文档格式
        $text = array('exe', 'doc', 'ppt', 'xls', 'wps', 'txt', 'lrc', 'wfs', 'torrent', 'html', 'htm', 'java', 'js', 'css', 'less', 'php', 'pps', 'host', 'box', 'docx', 'word', 'perfect', 'dot', 'dsf', 'efe', 'ini', 'json', 'lnk', 'log', 'msi', 'ost', 'pcs', 'tmp', 'xlsb');
        // 匹配不同的结果
        switch ($str) {
            case in_array($str, $image):
                return 'image';
                break;
            case in_array($str, $audio):
                return 'audio';
                break;
            case in_array($str, $video):
                return 'video';
                break;
            case in_array($str, $zip):
                return 'zip';
                break;
            case in_array($str, $pdf):
                return 'pdf';
                break;
            case in_array($str, $text):
                return 'text';
                break;
            default:
                return false;
                break;
        }
    }
}

if (!function_exists('switchery2db'))
{
    /**
     * 处理Switchery开关插件返回的 on 和 off的问题
     *
     * @param $switchery
     * @return int
     */
    function switchery2db($switchery){
        if(!$switchery){
            return 0;
        }

        return $switchery == 'on' ? 1 : 0;
    }
}
if (!function_exists('sld'))
{
    /**
     * 获取二级域名（子域名）
     *
     * @return mixed
     */
    function sld(){

        preg_match("#(http|https)://(.*?)\.#i",request()->url(),$match);

        return $match[2]??'';
    }
}