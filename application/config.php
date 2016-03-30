<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2016 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------
// $Id$

return [
    'url_route_on' => true,
    'log'          => [
        'type' => 'trace', // 支持 socket trace file
    ],
	'default_return_type'=>'json',
	'system_error' => [
		'not_fonud_sign'=>[
		'msg'=>"缺少签名参数",
		'code'=>1,
		'type'=>false
		],
		'sign_error'=>[
		'msg'=>"签名错误",
		'code'=>2,
		'type'=>false
		]

	],
	'session'     => [
    'prefix'         => '',
    'type'           => '',
    'auto_start'     => true,
],
];
$options = [
    'type'=>'Memcache', // 缓存类型为File
    'expire'=>0, // 缓存有效期为永久有效
    'prefix'=>'think',
    'host'=>'127.0.0.1',
	'port'=>'11211'
];
\think\Cache::connect($options);