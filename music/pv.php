<?php
  include 'db.php';
  date_default_timezone_set("Asia/Shanghai");  //上海时间
 // 定义一个函数getIP()  客户访问ip
  function getIP()
  {
    global $ip;
    if (getenv("HTTP_CLIENT_IP"))
    $ip = getenv("HTTP_CLIENT_IP");
    else if(getenv("HTTP_X_FORWARDED_FOR"))
    $ip = getenv("HTTP_X_FORWARDED_FOR");
    else if(getenv("REMOTE_ADDR"))
    $ip = getenv("REMOTE_ADDR");
    else $ip = "Unknow";
    return $ip;
  }

  // $ip = getIP();
  // $sql = "select id from ip where ip='".$ip."'";
  // $res = select($sql);
  if($_POST){
   // $_SESSION['zaixian_time'] = $_POST['zaixian_time'];  //测试是否关闭之后传数据到该页面
    $ip = getIP();  //客户访问ip
    $sql = "select *from ip where ip='".$ip."'";
    $res = select($sql);
    //更新浏览量 
    $id=$_POST['id']??0;
    $sql = "update music set view_num=view_num+1 where id=$id";
    $result = update($sql);	 
    if($res){  
        $sql = "insert into pv (ip_id,music_id,zaixian_time,jiazai_time,create_time) value('".$res[0]['id']."','".$_POST['id']."','".$_POST['zaixian_time']."','".$_POST['jiazai_time']."','".date('Y-m-d H:i:s')."')";
        $id = add($sql);  //zaixian_time id
    }else{
        $data=getCity($ip);  //ip定位
        
        $sql = "insert into ip (ip,country,prov,city,isp,create_time) value('".$data['ip']."','".$data['country']."','".$data['region']."','".$data['city']."','".$data['isp']."','". date('Y-m-d H:i:s')."')";
        $id = add($sql);  //ip id
        $sql = "insert into pv (ip_id,music_id,zaixian_time,jiazai_time,create_time) value('".$id."','".$_POST['id']."','".$_POST['zaixian_time']."','".$_POST['jiazai_time']."','".date('Y-m-d H:i:s')."')";
        $id = add($sql);  //zaixian_time id
                 
    }
   die(1);
  }
   // ip定位地址，返回数组
  function getCity($ip = '',$key='')
    {
        if($ip == ''){
            $url = "http://int.dpool.sina.com.cn/iplookup/iplookup.php?format=json";
            $ip=json_decode(file_get_contents($url),true);
            $data = $ip;
        }else{
            $url="http://ip.taobao.com/service/getIpInfo.php?ip=".$ip;  //淘宝免费ip接口 定位到市
            $ip=json_decode(file_get_contents($url));   
            if((string)$ip->code=='1'){
               return false;
            }
            $data = (array)$ip->data;
        }
        
        return $data;   //返回数组
    }
//var_dump($_SESSION['zaixian_time']);


?>


