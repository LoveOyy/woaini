<?php
namespace app\shop\controller;

class Buy
{
	
	public function shop_list($id = "1"){
		$re = M('user')->select();
		return $re;
		
		
		
	}
	public function buy_item(){
		
		
	}
    public function index()
    {
        return 'a';
    }
	public function set_id($id)
    {
	
	
		$arr['msg'] = "this id is ".$id;
		$arr['id'] = $id;
		$arr["d"] = \org\Test::a();
		\think\Session::set("uid",$id);
		return $arr;
	
    }
	public function get_id($id){
		$arr['msg'] = "this id is ".$id;
		$arr['id'] = $id;
		$arr["d"] = a2(5,14);
		\think\Session::get("uid",$id);
		return $arr;
		
		
		
	}
}
