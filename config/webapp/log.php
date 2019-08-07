<?php
use think\facade\Env;

// +----------------------------------------------------------------------
// | 日志设置
// +----------------------------------------------------------------------
return [
    // 日志记录方式，内置 file socket 支持扩展
    'type'        => 'File',
    // 日志保存目录
    'path'        => Env::get("runtime_path") . '/log/webapp',
    // 日志记录级别
    'level'       => [],
    // 单文件日志写入
    'single'      => false,
    // 独立日志级别
    'apart_level' => ['error','sql'],
    // 最大日志文件数量
    'max_files'   => 0,
    // 是否关闭日志写入
    'close'       => false,
];
