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

	'error' => [
		'user_reg'=>[
			'has_been_reg'=>[
				'msg'=>"账号已被注册",
				'code'=>1,
				'type'=>false
				],
			'success'=>[
				'msg'=>"注册成功",
				'code'=>0,
				'type'=>true
				]

		],
		'user_login'=>[
			'not_have_user'=>[
				'msg'=>"账号或密码错误,没有找到该用户",
				'code'=>1,
				'type'=>false
				],
			'success'=>[
			'msg'=>"登陆",
			'code'=>0,
			'type'=>true
			]
	
		]
	]
];
