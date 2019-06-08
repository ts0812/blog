<?php
require_once("API/qqConnectAPI.php");
$code = $_GET['code']??'';
$state = $_GET['state']??'';
$qc = new QC();
if($code&&$state){
//获取令牌AccessToken
    $accessToken = $qc->qq_callback();
    //获取用户openid 平台唯一标志符
    $openId = $qc->get_openid();
    $qc = new QC($accessToken,$openId);
    $info = $qc->get_user_info();
    var_dump($info);die;
    $model = User::findOne(['openid'=>$openId]);
    //已注册的qq用户
    if($model){
        $userinfo = $model->attributes;
        unset($userinfo['password']);
        $token = CacheKey::setToken($model->id,$userinfo);
        if($token){
            $data = [
                'token'=>$token,
                'image'=>$model->image,
                'nickname'=>$model->nickname
            ];
            $this->errCode(1,$data);
        }
    }else{  //未注册
        $qc = new \QC($accessToken,$openId);
        $info = $qc->get_user_info();
        if($info &&$info['ret']==0){
            $model = new User();
            $model->nickname=$info['nickname']??'';
            $model->sex=array_search($info['gender'],$model::$_sex)??0;
            $model->province=$info['province']??'';
            $model->city=$info['city']??'';
            $model->age=(int)date('Y')-(int)$info['year'];
            $model->openid=$openId;
            $model->image=$info['figureurl_qq_2']??'';
            if($model->save()){
                $userinfo = $model->attributes;
                unset($userinfo['password']);
                $token = CacheKey::setToken($model->id,$userinfo);
                if($token){
                    $data = [
                        'token'=>$token,
                        'image'=>$model->image,
                        'nickname'=>$model->nickname
                    ];
                    $this->errCode(1,$data);
                }
            }
        }
    }
    $this->errCode(9999);
}else{
    $qc->qq_login();
}
?>
