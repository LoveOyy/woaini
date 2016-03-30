<?php
namespace app\user\controller;

class User
{
    public function login($username,$password){
		$user = M("user");
		$result = $user->where(array('username'=>$username,'password'=>$password))->find();
		if(!$result){
			throw_out("not_have_user");
		}
		\think\Session::set("uid",$result['id']);
		throw_out("success");
       
    }
	public function reg($username,$password){
		$user = M("user");
		$result = $user->where(array('username'=>$username))->find();
		if($result){
			throw_out("has_been_reg");
		}
	$addArray = array();
	$addArray['username'] = $username;
	$addArray['password'] = $password;
	$uid = $user->add($addArray);
	\think\Session::set("uid",$uid);
	throw_out("success");
			
			
    }
	
}
