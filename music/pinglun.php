<?php
    include 'db.php';
    date_default_timezone_set("Asia/Shanghai");  //上海时间
    if($_POST){
        $id = post_check($_POST['id']);
        $content = post_check($_POST['content']);
       
        if($id){
            $sql = 'select *from music where id='.$id ;
            if(find($sql)){
                $create_time = date("Y-m-d H:i:s");
                $sql = "insert into comment (content,music_id,create_time) value('".$content."','".$id."','".$create_time."')";
                
                $res = add($sql);
                if($res){
                        $result = ['code' => 'success', 'info' => '评论成功' , 'content' => $content];
                        exit(json_encode($result)); 
                }else{
                        $result = ['code' => 'fail', 'info' => '评论失败'];
                         exit(json_encode($result));
                }


            }else{
                $result = ['code' => 'fail', 'info' => '无效请求'];
                exit(json_encode($result));
            }
           
        }
        
   }else{
     exit('无效请求');
   }

  

      // var_dump(find($sql));

?>