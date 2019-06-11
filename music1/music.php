<?php
    include 'db.php';
    date_default_timezone_set("Asia/Shanghai");  //上海时间
    if($_GET){
        $id = $_GET['id']??0;
        $switch = $_GET['switch']??0;
        if($id){
            if($switch==0){
                $sql = 'select *from music where state=1 and id<'.$id . ' order by id desc limit 0,1 ';
                if($res = find($sql)){
                    die(json_encode(['type'=>'1','message'=>'ok','data'=>$res['id']]));
                }
                $sql = 'select *from music where state=1 order by id desc limit 0,1 ';
                if($res = find($sql)){
                    die(json_encode(['type'=>'1','message'=>'ok','data'=>$res['id']]));
                }
                die(json_encode(['type'=>'0','message'=>'没有了']));
            }else{
                $sql = 'select *from music where state=1 and id>'.$id . ' limit 0,1 ';
                if($res = find($sql)){
                    die(json_encode(['type'=>'1','message'=>'ok','data'=>$res['id']]));
                }
                $sql = 'select *from music where state=1 limit 0,1 ';
                if($res = find($sql)){
                    die(json_encode(['type'=>'1','message'=>'ok','data'=>$res['id']]));
                }
                die(json_encode(['type'=>'0','message'=>'没有了']));
            }
        }
   }else{
     exit('无效请求');
   }

  

      // var_dump(find($sql));

?>