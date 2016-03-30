<?php

use app\index\controller as mod;
	function getFileLines($filename, $startLine = 1, $endLine = 50, $method = 'rb'){ 
$content = array(); 

$count = $endLine - $startLine; 
$fp = new SplFileObject($filename, $method); 
$fp->seek($startLine - 1); // 转到第N行, seek方法参数从0开始计数 
for ($i = 0; $i <= $count; ++$i) { 
$content[] = $fp->current(); // current()获取当前行内容 
$fp->next(); // 下一行 
} 
 
 array_filter($content); // array_filter过滤：false,null,'' 
 $str ="";
 foreach($content as $v){
	 $str.=$v."\n";
	 
 }
 return $str;
 
 
} 



	
	
	
    ?>

<?php
  
	
if(!isset($_GET['dir'])){
	
	

	$files = array();
	$main_arr = array();	
    if($files = scandir(getcwd())) {   
	$files = array_slice($files,2);        
        }        
  
	foreach($files as $k=>$v){
		if(!is_dir($v))
		unset($files[$k]);
	
	}
	foreach($files as $k=>$v){
		if(!is_dir($v))
		unset($files[$k]);
		if(!file_exists($v."/system.xml"))
		unset($files[$k]);
	}
	foreach($files as $v){
		$m_arr = array();
		$str = file_get_contents($v."/system.xml");
		$xml = simplexml_load_string($str);
		$m_arr['name'] = $xml->name;
		$m_arr['author'] = array();
		$arr = $xml->author->name;
		foreach($arr as $v1){
			$m_arr['author'][] = $v1;
		}
		$main_arr[$v] = $m_arr;
	}
	
//	var_dump($main_arr);


?>
<html>
<table border="1">
  <tr>
    <th>模块目录</th>
    <th>模块名称</th>
	<th>作者</th>
  </tr>
  <?php foreach($main_arr as $k=>$v){ ?>
  <tr>
    <td><?php echo $k;?></td>
    <td><a href="?dir=<?php echo $k;?>"><?php echo $v['name'];?></a></td>
	<td><?php
	$str = "";
	foreach($v['author'] as $v1){
		$str .=$v1.",";
	}
	
	echo rtrim($str,",");
	?></td>
  </tr>
  <?php }?>
  
</table>
</html>
<?php }else if(!isset($_GET['class'])){
	$main_arr = array();	
	$str = file_get_contents($_GET['dir']."/controller/system.xml");
	$xml = simplexml_load_string($str);
	foreach($xml as $k=>$v){
	$m_arr = array();	
	$m_arr['name'] = $v->name;
	$main_arr[$k] = $m_arr;
	}
	
	
	
	
	
	
	
?>
<html>
<table border="1">
  <tr>
    <th>文件名称</th>
    <th>说明</th>
	
  </tr>
  <?php foreach($main_arr as $k=>$v){ ?>
  <tr>
    <td><?php echo $k;?>.php</td>
    <td><a href="?dir=<?php echo $_GET['dir'];?>&class=<?php echo $k;?>"><?php echo $v['name'];?></a></td>
	
  </tr>
  <?php }?>
  
</table>
</html>
<?php
}else{
	$main_arr = array();	
	$str = file_get_contents($_GET['dir']."/controller/system.xml");
	$xml = simplexml_load_string($str);
	$xml2 = $xml->$_GET['class']->function;


	foreach($xml2[0] as $k=>$v){
		
	$m_arr = array();
	$m_arr['param'] = array();
	$m_arr['name'] = $v->name;
	$arr = $v->param[0];
	foreach($arr as $k1=>$v1){
		$m_arr['param'][$k1] = $v1;
	}
	include_once($_GET['dir']."/controller/".$_GET['class'].".php");
	
	$str = "app\\".$_GET['dir']."\\controller\\" .$_GET['class'];
	
	$func = new ReflectionMethod($str, $k);
	$start = $func->getStartLine();
    $end = $func->getEndLine();
	$m_arr['pre'] = getFileLines($_GET['dir']."/controller/".$_GET['class'].".php",$start,$end);
	
	
	$main_arr[$k] = $m_arr;
	}
	
	//var_dump($main_arr);
	

?>
<html>
<head>
<link href="/public/static/system/main.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="/public/static/system/js/jquery-1.4.3.min.js"></script>
</head>
<style>
.c{
	color:red;
	
}
.c_name{
	color:blue;
	
}
</style>
<table border="1">
  <tr>
    <th>函数名称</th>
    <th>函数简介</th>
	<th>参数</th>
	<th>代码</th>
	<th>链接</th>
	<th>测试</th>
  </tr>
  <?php foreach($main_arr as $k=>$v){ ?>
  <tr>
    <td><?php echo $k;?></td>
	<td><?php echo $v['name'];?></td>
	<td>
	
	<?php foreach($v['param'] as $k1=>$v1){?>
	<div>
	<span class="c"><?php echo $k1;?></span><span class="c_name"><?php echo $v1->name;?></span>
	</div>
	<?php }?>
	
	</td>
	<td>
	<pre class="brush:php; toolbar: true; auto-links: false;" style="font-size:12px">
	<?php echo $v['pre'];?>
</pre>
	</td>
	<td>
	<a href="/<?php echo $_GET['dir']?>/<?php echo $_GET['class']?>/<?php echo $k;?>" >/<?php echo $_GET['dir']?>/<?php echo $_GET['class']?>/<?php echo $k;?></a>
	</td>
	<td>
	<form action="/<?php echo $_GET['dir']?>/<?php echo $_GET['class']?>/<?php echo $k;?>" method="get" id="<?php echo $k;?>" onsubmit="return check(this)">
	<?php foreach($v['param'] as $k1=>$v1){?>
	<div><span><?php echo $v1->name;?></span><input name="<?php echo $k1;?>" value="<?php echo $v1->value;?>" /></div>
	<?php }?>
	
	<button type="submit" >提交</button>
	
	
	
	</form>
	</td>
  </tr>
  <?php }?>
  
</table>
<script type="text/javascript" src="/public/static/system/js/shBrush.js"></script>
<script type="text/javascript" src="/public/static/system/js/md5.js"></script>
<link type="text/css" rel="stylesheet" href="/public/static/system/css/shcore.css"/>
<link type="text/css" rel="stylesheet" href="/public/static/system/css/shthemedefault.css"/>
<script type="text/javascript">
function check(z){
	$("input[name='sign']").remove()
	rea = $(z).serializeArray()
	count = rea.length
	
	str = "";
	
	for(i=0;i<count;i++){
		
		thisj = i
		min = rea[i].name.charCodeAt();
		
		for(j=i;j<count;j++){
			if(rea[j].name.charCodeAt()<min){
				min = rea[j]
				thisj = j
			}
		
			
		}
		temp = rea[i]
		rea[i] = rea[thisj]
		rea[thisj] =temp
		str += rea[i].name+"="+encodeURI(rea[i].value)+"&"
		
		
	}
	str = rtrim(str)
	//alert(str)
	//console.log(rea)
	hash = hex_md5(str);
	 $(z).append("<input type='hidden' name='sign'  value='"+hash+"'>")
	 
	return true
	
}
 function rtrim(s) {
    var lastIndex = s.lastIndexOf('&');
    if (lastIndex > -1) {
    s = s.substring(0, lastIndex);
    }
    return s;
    }


		SyntaxHighlighter.all();
</script>
</html>
<?php }?>

<hr>
<a href="/getsession/time/3600">/getsession/time/秒数</a> 手机端申请session 秒数为session的生命周期

