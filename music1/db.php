<?php

//连接数据库

session_start();


$db_host='localhost';
$db_user='root';
$db_pass='tans0812';
$db_name='music';
@$con=mysqli_connect($db_host,$db_user,$db_pass);
if(!$con){
	die('Could not connect: ' . mysqli_error($con));
}

//mysqli_query("set names 'utf8'");  
mysqli_select_db($con,$db_name);
//查询一个或一条数据(返回一维数组)
function find($sql){
  global $con;

  $result=mysqli_query($con,$sql);
  $ar=[];
  if($result)
	 $ar = mysqli_fetch_assoc($result);
  return $ar;
}

// /查询一个或多条数据(返回二维数组)
function select($sql){
    global $con;
    $result=mysqli_query($con,$sql);
    $ar=[];
    while($arr=mysqli_fetch_array($result)){
	    $ar[]=$arr;
	}
	return $ar;
}
//添加数据（返回添加id）
function add($sql){
    global $con;
	$result=mysqli_query($con,$sql);
	$i=mysqli_insert_id($con);//输出上一条插入的数据的id
	return $i;
}    

function post_check($post)     
    {    

        if (!get_magic_quotes_gpc()) // 判断magic_quotes_gpc是否为打开     
        {     
            $post = addslashes($post); // 进行magic_quotes_gpc没有打开的情况对提交数据的过滤     
        }     
        $post = str_replace("_", "\_", $post); // 把 '_'过滤掉     
        $post = str_replace("%", "\%", $post); // 把' % '过滤掉     
        $post = nl2br($post); // 回车转换   
        $post = strip_tags($post); //剥去字符串中的 HTML、XML 以及 PHP 的标签
       // $post= htmlspecialchars($post); // html标记转换  
        $post = str_replace("date",date('Y-m-d H:i:s'),$post);  //把字符中的date换为时间
       
          return $post; 
       
       
         
         
    }   


