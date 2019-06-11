
<!DOCTYPE html>
<html>

<?php 
	session_start();
	include 'db.php'; 
	date_default_timezone_set("Asia/Shanghai");  //上海时间
	$id = post_check($_GET['id']);  //db.php函数 过滤
	$sql = 'select *from music where id='.$id ;
	$music_list = find($sql);
	 
	 if($music_list == false){

	 	header('Location: http://mybdxc.cn/xiaoshijie/music/index.php?id=1');  //不存在音乐就跳转
	 }
	  echo '<iframe src="http://mybdxc.cn/xiaoshijie/canvas/jiazai/'.rand(1,2).'.html" style="z-index: 100000000000;border:0px;width:100%;height:100%；position:fixed;" id="jiazai"></iframe>';  //加载动画
	if($_SESSION['music_user']){
			echo '<script type="text/javascript">var music_user='.$_SESSION['music_user'].'</script>';
		
	}else{
			echo '<script type="text/javascript">var music_user=0</script>';
			$_SESSION['music_user'] = 1;
	}	


?>
	<head>

		<meta charset="utf-8" name="viewport" content="width=device-width,initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no"/>
		<meta itemprop="name" content="<?php echo $music_list['title']?>" />  <!-- 分享标题 -->
		<meta itemprop="keywords" content="<?php echo $music_list['keywords']?>" />  <!-- 分享标题 -->
		<meta itemprop="description" content="<?php echo $music_list['description']?>"/>	<!-- 分享内容 -->
		<meta itemprop="image" content="<?php if($music_list['small_image']){
										echo $music_list['small_image'];
										}else{
										echo 'http://mybdxc.cn/xiaoshijie/music/img/qq.jpg';
									}
										?>" />   <!-- QQ分享的缩略图 未填默认内容接近100*100的图片-->
		<title>知音</title>
	

		<!--<link rel="stylesheet/less" href="less/less.less" />-->
		<link rel="stylesheet" href="css/layout.css" />
		<script src="./js/less.min.js"></script>
		<script src="./js/jquery.js"></script>
		<script type="text/javascript" src="../layer/2.4/layer.js"></script>	
		<script type="text/javascript">  <!-- 歌词lrc -->	
		var lrc= <?php echo json_encode($music_list['lrc'])?>;
	
		var state = '"'+<?php echo $music_list['state']?>+'"';
		if(state ==0){
			
			if(<?php echo '"'.$_GET['i'].'"'?>){   //关闭访问，除非加参数i

			}else{
				location.href = "public.html";
			}
			
			
		}
		</script>
		<script src="./js/lrc.js"></script>  <!-- 歌词lrc -->

 	</head>	
		<style type="text/css">
		@font-face{
		    font-family: 'kaiti';
		    src : url('<?php echo $music_list["ttf"]?>');
		}
			*{
				  -webkit-touch-callout:none;  /*系统默认菜单被禁用,禁止移动web长按弹出菜单*/
				  -webkit-user-select:none; /*webkit浏览器*/
				  -khtml-user-select:none; /*早期浏览器*/
				  -moz-user-select:none; /*火狐*/
				  -ms-user-select:none;  /*IE10*/
				  user-select:none;
				}
		body{
			position: fixed;
			
		}
		span{
			 font-family: 'kaiti';
		}
		Element {-webkit-user-select:none;
		  -moz-user-select:none;
		  -khtml-user-select:none;
		   user-select:none;
		}


	iframe{
		width: 100%;
		height: 100%;
		position: fixed;
		border: 0px;
		pointer-events:none;

	}

	.gongneng{
		width: 100%;height: 30px;position: absolute;top: 68%;padding-left:5px; display: none;
	}
	.now_geci{
		position: absolute;
	    top: 73%;
	    font-size: 13px;
	    color: #fff;
	    font-weight: 400;
	    width: 100%;
		}
	.time{
		display: none;
	}	
	.time_progress{
		display: none;
	}
	.btnpic{
		display: none;
	}
	.danmu_open{
	width: 30px;height: 30px;background-image: url(icon/icon.png);background-size:60px;background-position:0 0px;position: absolute;
	}
	.danmu_closs{
	width: 30px;height: 30px;background-image: url(icon/icon.png);background-size:60px;background-position:0 -30px;position: absolute;	
	}
	.num{
		margin-left: 20px;font-size: 12px;color: #b39a9a;
	}
	.pinglun{
	width: 30px;height: 30px;text-align: center;overflow:hidden;background-image: url(icon/icon.png);background-size:60px;background-position:0 -60px;position: absolute;left: 47px;
	}
	.touxiang_open{
		width: 30px;height: 30px;text-align: center;overflow:hidden;background-image: url(icon/icon.png);background-size:60px;background-position:30px -60px;position: absolute;right: 10px;
	}
	.touxiang_close{
		width: 30px;height: 30px;text-align: center;overflow:hidden;background-image: url(icon/icon.png);background-size:60px;background-position:30px -30px;position: absolute;right: 10px;
	}
	.geci_open{
		width: 30px;height: 30px;text-align: center;overflow:hidden;background-image: url(icon/icon.png);background-size:60px;background-position:0 -90px;position: absolute;right: 40px;
	}
	.geci_close{
		width: 30px;height: 30px;text-align: center;overflow:hidden;background-image: url(icon/icon.png);background-size:60px;background-position:30px 0px;position: absolute;right: 40px;
	}
	.danmu_txt{
		height: 150px;
		width: 80%;
		

		position: absolute;
		top: 43%;
		display: none;
	}
	.box{
		border-radius: 15px;
		display: inline-block;
		width: auto;
		height:auto;
		background-color: #55ff20;
		 display: table;
		 margin: 5px;
		 padding: 7px 10px;
	}
	.touxiang{
		height: 30px; width:30px; border-radius: 30px;vertical-align:middle;margin-right:10px;
	}
	.content{
		color: white;display: table-cell;vertical-align: middle;font-size: 15px;
	}
	.comment{
		width: 100%;
		height: 126px;

		position: absolute;
		bottom:0px;
		overflow: hidden;
  		  border: solid 1px #ececec;
   		 background-color: #f5f5f5;
   		 z-index: 2;
   		     border-radius: 10px 10px 0 0;
   		     display: none;
	}
	.comment__textarea_default, .comment__textarea_input{
		   
    border: none;
    height: 52px;
    resize: none;
    overflow: auto;
    outline: 0;
    background: 0 0;
    margin: 10px 5% 0 5%;
    width: 90%;
    font-size: 15px;
	}
	.shengyu{
		    text-align: right;
    font-size: 12px;
    margin: 0 10px;
    color: #999;

	}
	#count{
    color: #31c27c;
	}
	.c_tx_thin {
    color: #999;}
    .queding{background-color: #2caf6f;
    border-color: #2caf6f;
    color: #fff;
    width: auto;
    padding: 5px;
    margin: 5px 10px;
    border-radius: 5px;
    float: right;
    }
    .bj_img{
    	width: 100%;
    	height: 100%;
    }
    .main{
    	visibility: hidden;
    }
	</style>
	

	<body id="body">

		<div class="main">
		<?php
	if($music_list['background']){   //背景
		$url = explode('.', $music_list['background']);
		$houzui = $url[(count($url)-1)];
		if($houzui == 'html'){
			echo "<iframe src=".$music_list['background']."></iframe>";
		}
		if($houzui == 'jpg' || $houzui == 'png'){  
			echo '<img src="'.$music_list['background'].'"'.'class="bj_img"'.'>';
		}
		
	}


	?>
			<!--音乐-->
			<audio src="<?php echo $music_list['mp3']?>" id="my_audio" loop="loop"></audio>
			<!--cd播放机-->
			<div class="img" id="img">
			<a style="display: inline-block;" class="qqlianxi" qq="<?php echo $music_list['qq']?>" name="qqlianxi">	

			<?php 
			if($music_list['image']){  //img存在标签和弹幕是否滚动有关
				echo '<img src="'.$music_list['image'].'"/>';
			}else{
				echo '<img src="" style="display:none"/>';
			}
			?>
			
			 
			
			</a>
			<!-- <span class="centerCircle"></span> --> <!-- 中间的小圆圈 -->
			</div>
			<!--音频名字-->
			<div class="musicName">
				<!--<span>慌しく年</span>-->
				<span style="<?php echo $music_list['color3']?>"><?php echo $music_list['song']?></span>
				<!--<span>Kiroro-好きな人</span>-->
			</div>
			<!--歌词-->
			<div id="musicContent">
				<span class="musicContent01" style="<?php echo $music_list['color1']?>"></span>
				<span class="musicContent02" style="<?php echo $music_list['color2']?>"></span>
				<span class="musicContent03" style="<?php echo $music_list['color1']?>"></span>
			</div>
			<!-- 弹幕内容 -->
			<div class="danmu_txt">
				
					<?php 
					function randomColor() { 
        // 颜色 例:#866573
        $str = '#'; 
        for($i = 0 ; $i < 6 ; $i++) { 
            $randNum = rand(0 , 15); 
            switch ($randNum) { 
                case 10: 
                    $randNum = 'A'; 
                    break; 
                case 11: 
                    $randNum = 'B'; 
                    break; 
                case 12: 
                    $randNum = 'C'; 
                    break; 
                case 13: 
                    $randNum = 'D'; 
                    break; 
                case 14: 
                    $randNum = 'E'; 
                    break; 
                case 15: 
                    $randNum = 'F'; 
                    break; 
            } 
            $str .= $randNum; 
        } 
        return $str; 
    } 

					$id = post_check($_GET['id']);  //db.php函数 过滤
			        $sql = 'select *from music where id='.$id ;
			        
			         if(find($sql)){
			            $sql_1 = 'select *from comment where music_id='.$id.' order by create_time desc';			           
			            $comment_list = select($sql_1);
			            
			            foreach($comment_list as $k=>$v){

			            	echo '<div class="box" style="background-color:'.randomColor().';max-width:'.rand(70, 100).'%"><img src="'.$music_list['small_image'].'" class="touxiang" onerror="this.style.display='."'none'".'"><div class="content" style="color:'."#white".'">'.$v['content'].'</div></div>';	
			            }
			          
			            $result = ['code' => 'success', 'info' => $comment_list ];			           
			         }


					?>
			</div>
			<div class="gongneng" id="gongneng">  <!-- 功能栏 -->
				<div class="danmu_closs" id="danmu" item="0" val="0"><div style="" class="num"></div></div> 
				<div class="pinglun" id="pinglun" flag="0"></div> 
				<div class="geci_open"  id="geci" flag1="1"></div> 
				<div class="touxiang_open" id="toux" flag2="1"></div> 
				
			</div>
			<div class="now_geci" style="text-align:center; "><span class="musicContent02" style="font-size: 18px;visibility:hidden;<?php echo $music_list['color2']?>" id="now_geci" ></span>  </div> <!-- 当前歌词 -->
			<div class="time" style="text-align:center; ">
				<!--当前时间-->
			    <span class="now_time" id="now_time" >00:00</span>
			    <!--总的时间-->
			    
			    <span class="all_time" id="all_time">00:00</span>
			</div>
			<!--时间轴-->
			<div class="time_progress">
				<div class="progress">
			    	<p class="bar" id="bar"></p>
			        <div class="btn" id="btn"></div>
			    </div>
			</div>

			<!--暂停或播放-->
			<div class="btnpic" item="0"></div>

			<!-- 评论发布 -->
			<div class="comment">
			<textarea id="doc1" name="content" class="comment__textarea_default c_tx_thin js_reply_text_blur" placeholder="哪一句情话曾让你心动……" minlength="1" maxlength="30"></textarea>
             <div class="shengyu">剩余<span id="count">30</span>个字</div>         
				
				<div><a class="queding" onclick="queding()">发布评论</a></div>
			</div>
		</div>
	</body>
	<script type="text/javascript">

	window.onload=function(){ 
		 playPause();   //开启音乐
		$('#jiazai').remove();  //加载完成，去掉加载动画，显示内容
		$(".main").css('visibility','visible');  //显示内容
		$('title').html('<?php echo $music_list['title']?>');  //修改title
		
		document.body.addEventListener("touchmove",function(event){
    
        event.preventDefault();
        });

	    $("body").on("touchstart", function(e) {
   	 // 判断默认行为是否可以被禁用

		    startX = e.originalEvent.changedTouches[0].pageX,
		    startY = e.originalEvent.changedTouches[0].pageY;
		});
		$("body").on("touchend", function(e) {         
		   	 // 判断默认行为是否可以被禁用
		                
			    moveEndX = e.originalEvent.changedTouches[0].pageX,
			    moveEndY = e.originalEvent.changedTouches[0].pageY,
			    X = moveEndX - startX,	//左右滑
			    Y = moveEndY - startY;  //上下滑
	 		  
	    
			    if ( Y == 0) {  //点击事件
			         gongneng_show();
			    }
		    })

			//写在事件外边，防止被注销
			var iTime; 

			if(music_user){  //判断是否第一次访问

			}else{//第一次访问
						$('.gongneng').fadeIn(0);
				       	$('.time').fadeIn(0);
						$('.btnpic').fadeIn(0);
						$('.time_progress').fadeIn(0);
						iTime = setTimeout(function () {
				        //需要执行的事件
					       	$('.gongneng').fadeOut(2000);
					       	$('.time').fadeOut(2000);
							$('.btnpic').fadeOut(2000);
							$('.time_progress').fadeOut(2000);

				    }, 5000);
			}

			$('body').click(function(){   //点击事件
				
							gongneng_show();
			})
			function gongneng_show(){  //展现功能栏，并5s无操作是隐藏
			  $('.gongneng').fadeIn(0);
							$('.time').fadeIn(0);
							$('.btnpic').fadeIn(0);
							$('.time_progress').fadeIn(0);
			
				     clearTimeout(iTime);
				    iTime = setTimeout(function () {
				        //需要执行的事件
				          $('.gongneng').fadeOut(2000);
				       	
						$('.time').fadeOut(2000);
						$('.btnpic').fadeOut(2000);
						$('.time_progress').fadeOut(2000);
				    }, 5000);
				
			}; 
		}	
			//写在事件内部
		
		
		
	</script>
	<script type="text/javascript">
	var maxCount = 30;  // 最高字数，这个值可以自己配置
	$("#doc1").on("input propertychange", function() {

	    var len = getStrLength(this.value);
	    var num = maxCount-len;
	    if(num<0){
	      // num = 0;
	      var txt = '剩余<span id="count">'+Math.abs(num)+'</span>个字';
	      $(".shengyu").html(txt);
	    }else{
	    	var txt = '剩余<span id="count">'+num+'</span>个字';
	        $(".shengyu").html(txt);	
	    }
	    
	
	})
	 
	// 中文字符判断
	function getStrLength(str) { 
	    var len = str.length; 
	    var reLen = 0; 
	    for (var i = 0; i < len; i++) {        
	        if (str.charCodeAt(i) < 27 || str.charCodeAt(i) > 126) { 
	            // 全角    
	            reLen += 1; 
	        } else { 
	            reLen++; 
	        } 
	    } 
	    return reLen;    
	}
	var now_url = location.href;
	var id = now_url.split('=')[1];

	$('.pinglun').click(function(){   //评论开关
		
		if($(this).attr('flag') == 1){
			$('.comment').css('display','none');
			$(this).attr('flag',0)
		}else{
			$('.comment').css('display','block');
			$(this).attr('flag',1)
		}
	})
	var pinglun_time = 0;  //评论时间
	var xixiu_time = 10000;  //间隔时间才能再次评论 毫秒
	function jiange_time(){

		var nowtime =new Date().getTime();
		var free_time = xixiu_time-(nowtime-pinglun_time);//还差多久时间才能评论
		if(free_time>0){
			layer.msg(Math.ceil(free_time/1000)+'s后再评论吧！');
			return 1;
		}else{
			//console.log(free_time);
			return 0;
			
		}
		
	}

	$('#geci').click(function(){   //歌词开关
		if($(this).attr('flag1') == 1){   //关闭歌词
			$(this).attr('flag1',0);
			if($('#danmu').attr('item') == 1)  //开启了弹幕，歌词显示在下面
			{
				$('#now_geci').css('visibility','hidden');
			}else{
				$('#musicContent').css('visibility','hidden');
			}		
			$('.musicName').css('display','none');	
			$(this).attr('class','geci_close');
			
		}else{   //开启歌词

			$(this).attr('flag1',1);
			if($('#danmu').attr('item') == 1)  //开启了弹幕，歌词显示在下面
			{
				$('#now_geci').css('visibility','visible');
			}else{
				$('#musicContent').css('visibility','visible');
			}		
			$('.musicName').css('display','block');	
			$(this).attr('class','geci_open');
		}
	})

	$('#toux').click(function(){   //头像开关
		if($(this).attr('flag2') == 1){  //关闭
			$(this).attr('flag2',0);

			
			$('.img').css('display','none');		
			$(this).attr('class','touxiang_close');
			
		}else{		//开启
			$('.img').css('display','block');
			$(this).attr('class','touxiang_open');
			$(this).attr('flag2',1);


			
		}
	})
	function queding(){
		if(state == 2){			
			layer.msg('已关闭评论');
			return ;
		}
		if(pinglun_time){    //上次评论时间
			var res = jiange_time();
			if(res){
				return ;
			}
		}
		var len = $("#doc1").val().length;
		if(len == 0){
		   layer.msg('请输入内容在提交哦');
		}else{

			if(id){  //获取当前的music 的id
			//	console.log(id);
			}else{
				 layer.msg('无效请求'); 
				 return ;
			}
		              $.ajax({
		                           type: "post",  //提交方式  
		                           dataType: "json", //数据类型  
		                           data: 'content='+$("#doc1").val()+'&id='+id,//自定义数据参数，视情况添加
		                           url: "pinglun.php", //请求url  
		                           success: function (data) { //提交成功的回调函数  
		                            if(data.code == 'success')
		                            {
		                            	var danmu_now = $('#danmu').attr('val'); //当前弹幕的位置
		                            	var danmu_num = $('.num').html();   //弹幕数量


		                            	if(parseInt(danmu_num)<99){  //弹幕总数大于99
		                            		$('.num').html(++danmu_num);
		                            	}else{
		                            		$('.num').html('99+');
		                            	}
		                            	var pinglun_txt = '<div class="box" style="display:none"><img src="<?php echo $music_list["image"]?>" class="touxiang" onerror="this.style.display='+"'none'" +'"><div class="content">'+data.content+'</div></div>';
		                            	$('.box').eq(danmu_now).after(pinglun_txt);
		                           		$('.comment').css('display','none');
		  								layer.msg(data.info); 
		  								$("#doc1").val('');
		  								pinglun_time = new Date().getTime();//评论时间		                             
		                            }
		                            else{
		                              layer.msg(data.info);	                               
		                            }
		                          },
		                          error: function(){
		                          	layer.msg('网络错误，请联系管理员');
		                          }
		                       
		                     });
		                    
		      }

	}
	$("#danmu").click(function(){
		if($(this).attr('item') == 1){
			$(this).attr('class','danmu_closs');
			$(this).attr('item','0');
			if($("#geci").attr('flag1') == 1){
			$('#musicContent').css('visibility','visible'); //三行歌词
			$('#now_geci').css('visibility','hidden');		//一行歌词
			}


			$('.musicName').css('visibility','visible');  //歌名
			$('.danmu_txt').css('display','none');  //弹幕内容
			$('.num').css('display','block');  //弹幕数
			//scroll();

		}else{
			$(this).attr('class','danmu_open');
			$(this).attr('item','1');

			if($("#geci").attr('flag1') == 1){
			$('#musicContent').css('visibility','hidden'); //三行歌词
			$('#now_geci').css('visibility','visible');		//一行歌词
			}

			$('.musicName').css('visibility','hidden');
			 $('.danmu_txt').css('display','block');
			 $('.num').css('display','none');
			scroll();//滚动弹幕
		}
		
	})

	

	var box = $('.box');
	if(box.length>99){
		$('.num').html('99+');
	}else{
	$('.num').html(box.length);	
	}
	
	for(var j = 0;j<box.length;j++){
		box.eq(j).fadeOut(0); //全部隐藏
	}
	var set;
	function scroll(){     //弹幕滚动
		clearTimeout(set);  //清除上次循环
		var box = $('.box');
		var i= $('#danmu').attr('val'); //当前显示到第几条弹幕
		    
		
		if($(".img img").attr('class') && $('#danmu').attr('item') == 1  ){  // 音乐播放 弹幕开启才滚动

	
						for(j=0;j<i-3;j++){
							box.eq(j).css('display','none');  //i-3前面的统统隐藏
						}

				
					if(i<box.length){

						 box.eq(i-3).fadeOut(2000);  //渐隐
						 box.eq(i).fadeIn(2000);    //渐显
						 i++;
						 $('#danmu').attr('val',i);
						set = setTimeout(scroll,2000);
					}else{
							for(var j = 0;j<box.length;j++){
									box.eq(j).fadeOut(5000); //全部隐藏
							}
					}
				
		}
		// if($(".img img").attr('class') && $('#danmu').attr('item') == 1  ){  // 音乐播放 弹幕开启才滚动
		// else{

		// 		for(var j = 0;j<box.length;j++){

		// 			if(box.eq(j).css('display') == 'table'){ //停止音乐时 将显示的隐藏
						
		// 				box.eq(j).fadeOut(10000); 
		// 			}
					
		// 		}
			
		// }

	}
		var my_audio = document.getElementById("my_audio");
		var p_all=$(".time_progress").width();  //进度总长度

		var startX = startY = endX = endY = 0;  
	//显示歌词的元素
	
	 $(".btnpic").css("background-position","280px 0");
				$(".btnpic").attr("item","1");
		function playPause()
		{ 
			if(my_audio.paused)
				{
					my_audio.play();
					$(".img img").addClass("rainbow");
					scroll();
				}
				else
				{
					my_audio.pause();
					$(".img img").removeClass("rainbow");
					
				}	  
		}
		$(".btnpic").click(function(){
			if($(this).attr("item")=="0"){
				$(this).css("background-position","280px 0");
				$(this).attr("item","1");
			}else{
				$(this).css("background-position","0 0");
				$(this).attr("item","0");
			}
			
			playPause();
		});
		var lyric = parseLyric(songContent);
		    //ÏÔÊ¾¸è´ÊµÄÔªËØ
		lyricContainer = document.getElementById('musicContent');
		//audio播放的时候实时获取当前播放时间
		my_audio.ontimeupdate = function()
		{
			//获取当前播放时间
			document.getElementById("now_time").innerHTML = timeFormat(my_audio.currentTime);
			//当前的长度
			now_long=my_audio.currentTime/my_audio.duration*p_all;
			$(".bar").css({width:now_long});
			var btn_l=now_long-10+'px';
			$(".btn").css({left:btn_l});
			//遍历所有歌词，看哪句歌词的时间与当然时间吻合
		    for (var i = 0, l = lyric.length; i < l; i++) {
		        if (this.currentTime /*当前播放的时间*/ > lyric[i][0]) {
		            //显示到页面
//		            lyricContainer.textContent = lyric[i][1];
				if(i>=1){
					$(".musicContent01").html(lyric[i-1][1]);
		            $(".musicContent02").html(lyric[i][1]);
		            $(".musicContent03").html(lyric[i+1][1]);
				}else{
		            $(".musicContent02").html(lyric[i][1]);
		            $(".musicContent03").html(lyric[i+1][1]);
				}
	        };
	        addListenTouch();
	    };
	};
	
		//页面一旦加入就获取audio的总时间
		my_audio.onprogress = function()
		{
			document.getElementById("all_time").innerHTML = timeFormat(my_audio.duration);
			//总的长度
		};	
		// Time format converter - 00:00//时间格式转换器- 00:00
		var timeFormat = function(seconds){
			var m = Math.floor(seconds/60)<10 ? "0"+Math.floor(seconds/60) : Math.floor(seconds/60);
			var s = Math.floor(seconds-(m*60))<10 ? "0"+Math.floor(seconds-(m*60)) : Math.floor(seconds-(m*60));
			return m+":"+s;
		};	
		//手动拉拽进度条的部分
	function addListenTouch(){
		//var speed=$('.had-play');
		var btn=document.getElementById("btn");
		document.getElementById("btn").addEventListener("touchstart", touchStart, false);
		document.getElementById("btn").addEventListener("touchmove", touchMove, false);
		document.getElementById("btn").addEventListener("touchend", touchEnd, false);
		document.getElementById("musicContent").addEventListener("touchstart", touchStart, false);
		document.getElementById("musicContent").addEventListener("touchmove", touchMove, false);
		document.getElementById("musicContent").addEventListener("touchend", touchEnd, false);
		document.getElementById("btn").addEventListener("touchstart", touchStart, false);
		
	}
	function touchStart(e){
		e.preventDefault();
		var touch=e.touches[0];
		startX=touch.pageX;
		my_audio.pause();   //暂停音乐
		document.getElementById("all_time").innerHTML = timeFormat(my_audio.duration);	
		//歌词区域touch移动距离
		var touchSong = e.targetTouches[0];
        startSongX = touchSong.pageX;
        startSongY = touchSong.pageY;
		}
	function touchMove(e){//滑动
		var touch=e.touches[0];
		x=touch.pageX-startX//滑动的距离
		//btn.style.webkitTransform='translate('+0+'px,'+y+'px)';
		var widthBar=now_long+x;
		//
		$(".bar").css({width:widthBar});
		//console.log(now_long);console.log(x);console.log(p_all);
		if(widthBar<p_all)
			{
			//	
			$("#btn").css({left:widthBar-10+'px'});
			$("#bar").css({width:widthBar});	
			}//不让进度条超出页面
		//歌词区域touch移动距离
		var touchSong = e.targetTouches[0];
        endSongX = touchSong.pageX;
        endSongY = touchSong.pageY;
       
		var yu=widthBar/p_all*my_audio.duration;
		document.getElementById("now_time").innerHTML = timeFormat(yu);
		}
	function touchEnd(e){//手指离开屏幕
		if(Math.abs(endSongX-startSongX)<10){
			my_audio.play();   //开启音乐
			$(".img img").addClass("rainbow");
			$('.btnpic').css("background-position","280px 0");
			$('.btnpic').attr("item","1");
			return ;
		}
		//layer.msg("水平移动距离=    "+Math.abs(endSongX-startSongX));
		e.preventDefault();//取消事件的默认动作
		now_long=parseInt(btn.style.left);
		var touch=e.touches[0];
		var dragPaddingLeft=btn.style.left;
		var change=dragPaddingLeft.replace("px","");
		numDragpaddingLeft=parseInt(change);
		//console.log(numDragpaddingLeft);
		var currentTimeNew=(numDragpaddingLeft/(p_all-20)*my_audio.duration);
		
		my_audio.currentTime = currentTimeNew;
		//console.log(currentTimeNew);
		//console.log(timeFormat(currentTimeNew));
		document.getElementById("now_time").innerHTML = timeFormat(currentTimeNew);
		my_audio.play();   //开启音乐
		$(".img img").addClass("rainbow");
		$('.btnpic').css("background-position","280px 0");
		$('.btnpic').attr("item","1");
		document.getElementById("all_time").innerHTML = timeFormat(my_audio.duration);	
		//console.log("垂直移动距离=    "+(endSongY-startSongY));
		
	}
	


	$(".time_progress").on("touchstart", function(e) {   //进度条移动web点击
    // 判断默认行为是否可以被禁用

		
		e.preventDefault();
		startX = e.originalEvent.changedTouches[0].pageX,
   		startY = e.originalEvent.changedTouches[0].pageY;		
   		my_audio.pause();   //暂停音乐
		document.getElementById("all_time").innerHTML = timeFormat(my_audio.duration);	
	
	});
	$(".time_progress").on("touchend", function(e) {         
	    // 判断默认行为是否可以被禁用
	                
	    moveEndX = e.originalEvent.changedTouches[0].pageX,
	    moveEndY = e.originalEvent.changedTouches[0].pageY,
	    X = moveEndX - startX,	//左右滑
	    Y = moveEndY - startY;  //上下滑
	    if(Y==0 && X==0){
	    	$(".bar").css({width:moveEndX});
	    	$("#btn").css({left:moveEndX-10+'px'});
		    e.preventDefault();//取消事件的默认动作
			
			numDragpaddingLeft=parseInt(moveEndX);
			//console.log(numDragpaddingLeft);
			var currentTimeNew=(numDragpaddingLeft/(p_all-20)*my_audio.duration);
			my_audio.currentTime = currentTimeNew;
			//console.log(currentTimeNew);
			//console.log(timeFormat(currentTimeNew));
			document.getElementById("now_time").innerHTML = timeFormat(currentTimeNew);
			my_audio.play();   //开启音乐
			$(".img img").addClass("rainbow");
			$('.btnpic').css("background-position","280px 0");
			$('.btnpic').attr("item","1");
			document.getElementById("all_time").innerHTML = timeFormat(my_audio.duration);	
	    }
	  
	
    })
    
window.addEventListener('contextmenu', function(e){  //移动端web禁止长按选择文字以及弹出菜单
	e.preventDefault();
})


	</script>
	
	<!-- qq链接 -->
	<!-- <script src="./js/qqlianxi.js"></script>    -->
</html>