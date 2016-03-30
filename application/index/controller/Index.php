<?php
namespace app\index\controller;

class Index
{
   
	public function create_new($title,$body){ //新建字段
	$uid = \think\Session::get("uid");
	 if(!$uid){ //如果session中没有uid
		throw_out("not_login");
		}
	$list = M('list'); //实例化数据库
	$addArray = array();
	$addArray['title'] = $title;
	$addArray['body'] = $body;
	$addArray['time'] = time();
	$addArray['uid'] = $uid;
	$list->add($addArray);
	throw_out("success");
	}
	public function getlist($page,$num){ 
		$list = M('list'); //实例化数据库
		$count = $list->count();
		$first_limit = ($page-1)*$num;
		$end_limit = $num;
		$result = $list->limit($first_limit.",".$end_limit)->select();
		$page_num = ceil($count/$num);
		$returnArr['result'] = $result;
		$returnArr['this_page'] = $page;
		$returnArr['page_num'] = $page_num;
		return $returnArr;
	}
	public function del($id){
		
		$uid = \think\Session::get("uid");
		
		
		if(!$uid){ //如果session中没有uid
		throw_out("not_login");
		}
		$list = M('list'); //实例化数据库
		$delArray = array();
		$delArray['uid'] = $uid;
		$delArray['id'] = $id;
		if(!$list->where($delArray)->delete()){
		throw_out("del_error");
		}else{
		throw_out("success");	
		}
		
	}
	public function update($id,$title,$body){
		$uid = \think\Session::get("uid");
		if(!$uid){ //如果session中没有uid
		throw_out("not_login");
		}
		$list = M('list'); //实例化数据库
		$updateArray = array();
		$updateArray['title'] = $title;
		$updateArray['body'] = $body;
		$whereArray['uid'] = $uid;
		$whereArray['id'] = $id;
		if(!$list->where($whereArray)->save($updateArray)){
		throw_out("update_error");
		}else{
		throw_out("success");	
		}
	
	}
	
	
	
	public function set_id($id)
    {
	
	
		$arr['msg'] = "this id is ".$id;
		$arr['id'] = $id;
		$arr["d"] = \org\Test::a();
		\think\Session::set("uid",$id);
		return $arr;
	
    }
	public function get_id($name="233",$id){
		$arr['msg'] = "this id is ".$id.$name;
		$arr['id'] = $id;
		$arr["d"] = a2(5,14);
		\think\Session::get("uid",$id);
		return $arr;
		
		
		
	}
}
