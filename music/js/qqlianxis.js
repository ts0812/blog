var system ={
win : false,
mac : false,
xll : false
};
//检测平台
var p = navigator.platform;
system.win = p.indexOf("Win") == 0;
system.mac = p.indexOf("Mac") == 0;
system.x11 = (p == "X11") || (p.indexOf("Linux") == 0);
var qqlianxi = document.getElementsByName("qqlianxis");


//跳转语句，如果是手机访问就自动跳转到wap.baidu.com页面
if(system.win||system.mac||system.xll){
	

			 for(var i=0;i<qqlianxi.length;i++){
			 	var QQ = document.getElementsByName("qqlianxis")[i].innerHTML;

			 	qqlianxi[i].href ="tencent://message/?Menu=yes&uin="+QQ+"&Site= 北岛星辰&Service=300&sigT=45a1e5847943b64c6ff3990f8a9e644d2b31356cb0b4ac6b24663a3c8dd0f8aa12a595b1714f9d45";
			 	
			 }

  //电脑网页发起qq临时对话，对方需开启临时对话
  }else{
 
			 for(var i=0;i<qqlianxi.length;i++){
			 	var QQ = document.getElementsByName("qqlianxis")[i].innerHTML;
			 	qqlianxi[i].href ="http://wpa.qq.com/msgrd?v=3&uin="+QQ+"&site=qq&menu=yes";
			 }



//手机网页发起qq临时对话，对方需开启临时对话
//alert('手机');
}