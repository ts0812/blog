<?php
require_once("API/qqConnectAPI.php");
require_once("Curl.php");
require_once("db.php");
$code = $_GET['code']??'';
$state = $_GET['state']??'';
//$qc = new QC();
$_sex = ['未知','男','女'];
if($code&&$state){
//获取令牌AccessToken
    $accessToken = $qc->qq_callback();
    //获取用户openid 平台唯一标志符
    $openId = $qc->get_openid();
    $qc = new QC($accessToken,$openId);
    $info = $qc->get_user_info();
    $sql = 'select *from user where openid='."'D07AE37DAF1E33DD947A165B0CDBD92C'";
    $userInfo = find($sql);
    //已注册的qq用户
    if($userInfo){
    }else{  //未注册
        $qc = new QC($accessToken,$openId);
        $info = $qc->get_user_info();
        if($info &&$info['ret']==0){
            $sex=array_search($info['gender'],$_sex)??0;
            $age=(int)date('Y')-(int)$info['year'];
            $sql = "insert user ('nickname','sex','province','city','age','openid','image') 
            value(".$info['nickname'].",".$sex.",".$info['province'].",".$info['city'].",".$age.",".$openid.",".$info['figureurl_qq_2'].",)";
            $res = add($sql);
            if(!$res)
                return json_encode(['type'=>0,'message'=>'false']);
        }
    }
    //缓存身份
    $url = 'http://yii.mybdxc.cn/api/login/qq-login?openid='.$openId;
    $res = Curl::get($url);
    return json_encode($res);
}else{
    $qc->qq_login();
}
