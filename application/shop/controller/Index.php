<?php
namespace app\shop\controller;

class Index
{
	
	
	
	
	
	
	public function item_list($shop_id=0,$page=1,$num=10,$item_type=0,$search="",$order=""){ //商家的商品列表
		$shop_item = M('shop_item');
		$whereArr = array();
		$orderBy ="";
		if($shop_id!=0){
			$whereArr['shop_id'] = $shop_id;
		}
		if($item_type!=0){
			$whereArr['item_type'] = $item_type;
		}
		if($search!=""){
			$whereArr['item_name'] = array('like',"%{$search}%");
		}
		if($order!=""){
			$orderBy = $order." desc";
		}
		$count = $shop_item->where($whereArr)->count();
		$result = $shop_item->where($whereArr)->page($page,$num)->order($orderBy)->select();
		$page_num = ceil($count/$num);
		$returnArr['result'] = $result;
		$returnArr['this_page'] = $page;
		$returnArr['page_num'] = $page_num;
		return $returnArr;
	}
	public function shop_list($shop_type=0,$page=1,$num=10,$last_id=0,$search="",$order=""){ //商家列表
			$shop_list= M('shop_list');
			$whereArr = array();
			$orderBy = "";
			if($shop_type!=0){ //为0默认所有店铺
				$whereArr['shop_type'] = $shop_type;
			}
			if($search!=""){
				$whereArr['shop_name'] = array('like',"%{$search}%");
			}
			if($last_id!=0){ //批发馆中使用
				$whereArr['last_id'] = $last_id;
			}
			if($order!=""){
				$orderBy = $order." desc";
			}
			
			$count = $shop_list->where($whereArr)->count();
			$result = $shop_list->where($whereArr)->page($page,$num)->order($orderBy)->select();
			$page_num = ceil($count/$num);
			$returnArr['result'] = $result;
			$returnArr['this_page'] = $page;
			$returnArr['page_num'] = $page_num;
			return $returnArr;	
		
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
