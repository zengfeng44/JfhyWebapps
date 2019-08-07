<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006-2016 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: 流年 <liu21st@gmail.com>
// +----------------------------------------------------------------------

// 应用公共文件
/**
 * Ajax统一返回JSON数据格式
 */
function ajaxReturn($data = null, $status = 0, $message = "Success", $extra = "")
{
    $return_data    =   [
        "code"      =>  $status,
        "result"    =>  $data,
        "message"   =>  $message,
        "extra"     =>  $extra
    ];

    return json_encode($return_data, true);
}

/**
 * Ajax统一返回模板数据格式
 */
function ajaxViewReturn($data = null, $status = 0, $message = "Success", $extra = "")
{
    $return_data    =   [
        "code"      =>  $status,
        "result"    =>  $data,
        "message"   =>  $message,
        "extra"     =>  $extra
    ];

    return $return_data;
}

/**
 * 随机生成SN编号
 * @param string $prefix 编号前缀
 */
function buildSN($prefix = '')
{
	$str_sn	=	$prefix . time() . str_pad(mt_rand(100, 9999), 4, '0', STR_PAD_LEFT);
	return $str_sn;
}

/**
 * 生成指定长度的随机字符串
 */
function genRandomStr($param){
    $str="0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ";
    $key = "";
    for($i=0;$i<$param;$i++)
     {
         $key .= $str{mt_rand(0,32)};    //生成php随机数
     }
     return $key;
 }

 /**
 * 字符串截取，支持中文和其他编码
 * @static
 * @access public
 * @param string $str 需要转换的字符串
 * @param string $start 开始位置
 * @param string $length 截取长度
 * @param string $charset 编码格式
 * @param string $suffix 截断显示字符
 * @return string
 */
function msubstr($str, $start=0, $length, $charset="utf-8", $suffix=true) {
    if(function_exists("mb_substr"))
        $slice = mb_substr($str, $start, $length, $charset);
    elseif(function_exists('iconv_substr')) {
        $slice = iconv_substr($str,$start,$length,$charset);
        if(false === $slice) {
            $slice = '';
        }
    }else{
        $re['utf-8']   = "/[\x01-\x7f]|[\xc2-\xdf][\x80-\xbf]|[\xe0-\xef][\x80-\xbf]{2}|[\xf0-\xff][\x80-\xbf]{3}/";
        $re['gb2312'] = "/[\x01-\x7f]|[\xb0-\xf7][\xa0-\xfe]/";
        $re['gbk']    = "/[\x01-\x7f]|[\x81-\xfe][\x40-\xfe]/";
        $re['big5']   = "/[\x01-\x7f]|[\x81-\xfe]([\x40-\x7e]|\xa1-\xfe])/";
        preg_match_all($re[$charset], $str, $match);
        $slice = join("",array_slice($match[0], $start, $length));
    }
    
    // 增加是否全部截取判断,全部截取不追加"..." --add by Solo
    $str_len		=	mb_strlen($str) - $start;
    $ellipsis_slice	=	$str_len > $length	?	$slice . '...'	:	$slice;
    
    return $suffix ? $ellipsis_slice : $slice;
}

function httpGet($url, $params){
	if (!empty($params))
		$url = "{$url}?" . http_build_query($params);

	$ch = curl_init ();
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
	curl_setopt($ch, CURLOPT_TIMEOUT, 60);
	$result = curl_exec($ch);
	curl_close($ch);

	return $result;
}

function httpPost($url, $params = null, $headers = null){
	if (empty($headers))
		$headers	=	["Content-type:application/json;","Accept:application/json"];

	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
	curl_setopt($ch, CURLOPT_POSTFIELDS, $params);
	curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
	curl_setopt($ch, CURLOPT_TIMEOUT, 60);
	$result = curl_exec($ch);
	curl_close ($ch);

	return $result;
}