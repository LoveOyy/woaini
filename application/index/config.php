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
	'index_create_new'=>[
		'not_login'=>[
		'msg'=>"没有登陆",
		'code'=>1,
		'type'=>false
		],
		'success'=>[
		'msg'=>"添加成功",
		'code'=>0,
		'type'=>true
		]

	],
	'index_del'=>[
		'not_login'=>[
		'msg'=>"没有登陆",
		'code'=>1,
		'type'=>false
		],
		'del_error'=>[
		'msg'=>"删除失败",
		'code'=>2,
		'type'=>false
		],
		'success'=>[
		'msg'=>"删除成功",
		'code'=>0,
		'type'=>true
		]

	],
	'index_update'=>[
		'not_login'=>[
		'msg'=>"没有登陆",
		'code'=>1,
		'type'=>false
		],
		'update_error'=>[
		'msg'=>"修改失败",
		'code'=>2,
		'type'=>false
		],
		'success'=>[
		'msg'=>"修改成功",
		'code'=>0,
		'type'=>true
		]

	],
	
	
	]
];
