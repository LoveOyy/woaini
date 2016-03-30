<?php

function a2($a,$b){
	return $a+$b;
	
}
\think\Route::get('getsession/:time',function($time){ //获取session ssid
    $arr = array();
	$ssid = md5(mt_rand(1,999999).time().mt_rand(1,999999));
	$arr['ssid'] = $ssid;
	$arr['session_die_time'] = time()+$time;
	S("ssid_".$ssid,$arr,$time);
	return $arr;
	
});
\think\Hook::add('action_begin',function(){ //签名验证
return;
	$getArr = I('get.');
	if(!$getArr){return;}
	$sign = isset($getArr['sign'])?$getArr['sign']:system_error("not_fonud_sign");
	unset($getArr['sign']);
	ksort($getArr);
	$signstr = "";
	foreach($getArr as $k=>$v){
		$signstr .= $k."=".urlencode($v)."&";	
	}
	$signstr = rtrim($signstr,"&");

	if(md5($signstr) != $sign){
		system_error("sign_error");
	}
	
	
});
\think\Hook::add('action_begin',function(){ //ssid 认证
	$getArr = I('get.');
	if(!$getArr){return;}
	if(isset($getArr['ssid']))
		$ssid = $getArr['ssid'];
	else
		return;
	if(!S("ssid_".$ssid)){return;} //如果ssid没有被初始化
		$ssidarr = S("ssid_".$ssid);
		if(!$ssidarr){return;}
		if(!isset($ssidarr['session_die_time']) or $ssidarr['session_die_time']>time()){
			S("ssid_".$_GET['ssid'],false);
			return;
		}
	foreach($ssidarr as $k=>$v){
		\think\Session::set($k,$v);
	}

	
});
\think\Hook::add("app_end",function(){
	
	if(isset($_GET['ssid'])){
	if(isset($_SESSION)){
		S("ssid_".$_GET['ssid'],$_SESSION);
	}
	}

	
	}
);


function system_error($k){
	header("Content-type: application/json");
	$system_error = C("system_error");
	echo json_encode($system_error[$k]);
	die();

}
function throw_out($k){
	header("Content-type: application/json");
	$error = C("error");
	$error = $error[CONTROLLER_NAME."_".ACTION_NAME];
	echo json_encode($error[$k]);
	
	if(isset($_GET['ssid'])){
	if(isset($_SESSION)){
		S("ssid_".$_GET['ssid'],$_SESSION);
	}
	}
	
	
	die();
}


?>