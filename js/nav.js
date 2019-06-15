//目录导航

// document.writeln("<nav id=\'h\' class=\'blog-nav layui-header\'>");
// document.writeln("    <div class=\'blog-container\'>");
// document.writeln("        <a class=\'blog-user qqlianxi\' name=\'qqlianxi\' qq=\'1352645017\'>");
// document.writeln("            <i class=\'layui-icon layui-icon-login-qq layui-bg-black\' id=\'QQlogin\' style=\'font-size: 35px;\'></i></i>");
// document.writeln("        </a>");
// document.writeln("        <a class=\'blog-logo\' href=\'index.html\'>知音</a>");
// document.writeln("        <ul class=\'layui-nav\' lay-filter=\'nav\'>");
// document.writeln("            <li class=\'layui-nav-item\'><a href=\'\'><i");
// document.writeln("                    class=\'fa fa-home fa-fw\'></i>&nbsp;网站首页</a></li>");
// document.writeln("            <li class=\'layui-nav-item\'><a href=\'article.html\'><i");
// document.writeln("                    class=\'fa fa-file-text fa-fw\'></i>&nbsp;文章专栏</a></li>");
// document.writeln("            <li class=\'layui-nav-item\'><a href=\'\'><i");
// document.writeln("                    class=\'fa fa-share-square-o fa-fw\'></i>&nbsp;资源分享</a></li>");
// document.writeln("            <li class=\'layui-nav-item\'><a href=\'\'><i");
// document.writeln("                    class=\'fa fa-snowflake-o fa-fw\'></i>&nbsp;点点滴滴</a></li>");
// document.writeln("            <li class=\'layui-nav-item\'><a href=\'\'><i");
// document.writeln("                    class=\'fa fa-info fa-fw\'></i>&nbsp;关于本站</a></li>");
// document.writeln("            <li class=\'layui-nav-item\'><a href=\'\'><i");
// document.writeln("                    class=\'layui-icon fa-fw\'></i>&nbsp;给我留言</a></li>");
// document.writeln("            <span class=\'layui-nav-bar\'></spcan>");
// document.writeln("        </ul>");
// document.writeln("        <a class=\'blog-navicon\' href=\'javascript:;\'> <i class=\'layui-icon layui-icon-app\'></i>");
// document.writeln("        </a>");
// document.writeln("    </div>");
// document.writeln("</nav>");
// document.writeln("");
// document.writeln("<ul class=\'layui-nav layui-nav-tree layui-nav-side blog-nav-left leftOut layui-hide\' lay-filter=\'nav\'>");
// document.writeln("    <li class=\'layui-nav-item layui-thiss\'><a href=\'\'><i class=\'fa fa-home fa-fw\'></i>&nbsp;网站首页</a></li>");
// document.writeln("    <li class=\'layui-nav-item\'><a href=\'\'><i class=\'fa fa-file-text fa-fw\'></i>&nbsp;文章专栏</a></li>");
// document.writeln("    <li class=\'layui-nav-item\'><a href=\'\'><i class=\'fa fa-share-square-o fa-fw\'></i>&nbsp;资源分享</a></li>");
// document.writeln("    <li class=\'layui-nav-item\'><a href=\'\'><i class=\'fa fa-snowflake-o fa-fw\'></i>&nbsp;点点滴滴</a></li>");
// document.writeln("    <li class=\'layui-nav-item\'><a href=\'\'><i class=\'fa fa-info fa-fw\'></i>&nbsp;关于本站</a></li>");
// document.writeln("    <li class=\'layui-nav-item\'><a href=\'\'><i class=\'layui-icon fa-fw\'></i>&nbsp;给我留言</a></li>");
// document.writeln("    <span class=\'layui-nav-bar\'></span>");
// document.writeln("</ul>");
// document.writeln("<div class=\'blog-mask animated leftOut layui-hide\'></div>");

var $ = layui.$ //由于layer弹层依赖jQuery，所以可以直接得到
let user = getStorage('user'); //缓存身份
$(function () {
    let navUrl = domainName + '/api/blog/nav';
    $.ajax({
        url: navUrl,
        type: 'get',
        dataType: "json",
        success: function (data) {
            if (data.status == 1) {
                let navData = data.data;
                let length = navData.length;
                let i, txt,image;
                for (i = 0; i < length; i++) {
                    txt += "<li class='layui-nav-item layui-thiss'><a class='nav-url' onclick=\"goUrl(this)\" url='" + navData[i].url + "'><i class='layui-icon " + navData[i].icon + "'></i>&nbsp;" + navData[i].title + "</a></li>";
                   // txt += "<li class='layui-nav-item layui-thiss'><a class='nav-url' href='" + navData[i].url + "'><i class='layui-icon " + navData[i].icon + "'></i>&nbsp;" + navData[i].title + "</a></li>";
                }
                if(user)
                    image = "<a class='blog-user' onclick='touxiang()'><img class='touxiang' src='"+user.image+"'/></a>";
                else
                    image = "<a class='blog-user' href='qqlogin.php'> <i class='layui-icon layui-icon-login-qq layui-bg-black' id='QQlogin' style='font-size: 35px;'></i></i></a>";
                let navTxt = "<nav id='h' class='blog-nav layui-header'><div class='blog-container'>"+image+ "<a class='blog-logo' href='index.html'>知音</a> <ul class='layui-nav' lay-filter='nav'> " + txt + "<li class='layui-nav-item'> <span class='layui-nav-bar'></spcan> </ul> <a class='blog-navicon' onclick=\"apply()\"> <i class='layui-icon layui-icon-app'></i> </a> </div> </nav> <ul class='layui-nav layui-nav-tree layui-nav-side blog-nav-left leftOut layui-hide' lay-filter='nav'> " + txt + "<span class='layui-nav-bar'></span> </ul> <div class='blog-mask animated leftOut layui-hide' onclick=\"apply()\"></div>";

                $('body').prepend(navTxt);
            }
        },
        error: function () {
            layer.msg('error');
        }
    })
    let code = getQueryVariable('code');
    let state = getQueryVariable('state');
    //qq登录
    if(code && state){

        if(user)
            return ;
        let navUrl = 'qqlogin.php';
        $.ajax({
            url: navUrl,
            type: 'get',
            dataType: "json",
            data:{
                code:code,
                state:state
            },
            success: function (data) {
                if (data.status == 1) {
                    let userData=data.data;
                    setStorage('user',userData);
                    location.href = 'index.html';
                    // layer.msg(data.message);
                    // window.history.back(-1); //回到上一个页面
                }else{
                    layer.msg(data.message);
                }
            },
            error: function () {
                layer.msg('error');
            }
        })
    }
})
    $(".blog-navicon").click(function () {
        apply();
    })
    $('.blog-mask').click(function () {
        apply();
    })
    $('.nav-url').click(function () {
        $('.layadmin-iframe').attr('src',$(this).attr('url'));
        if($(this).parent().parent().is('.blog-nav-left')){
            apply();
        }
    })
// layer.open({
//     type: 2,
//     skin: 'layui-layer-demo', //样式类名
//     title:'用户信息',
//     closeBtn: 1, //不显示关闭按钮
//     anim: 2,
//     shadeClose: true, //开启遮罩关闭
//     content: 'index-list.html'
// });
//点击用户头像
function touxiang() {
    let logoutUrl = domainName + '/api/login/logout?token='+user.token;
    layer.confirm('是否退出账号？', function () {
        delStorage('user'); //删除身份缓存
        $.ajax({
            url: logoutUrl,
            type: 'get',
            dataType: "json",
            success: function (data) {
                if (data.status == 1) {
                    location.href = 'index.html';
                }else{
                    layer.msg(data.message);
                }
            },
            error: function () {
                layer.msg('error');
            }
        })
    });
}

push();
//每日推送
function push(){
    let pushUrl = domainName + '/api/blog/push';
    let pushStatus = getCookie('pushStatus');	
    if(pushStatus)
	    return false;
    $.get(pushUrl,function(data){
	   setTodayCookie('pushStatus',1);
	   if(data.data.content){
           layer.alert(data.data.content, {
               title:data.data.label,
               skin: 'layer-ext-moon'
           })
       }
	},'json');
}
//iframe跳转
function goUrl(a) {
    $('.layadmin-iframe').attr('src',$(a).attr('url'));
    if($(a).parent().parent().is('.blog-nav-left')){
        apply();
    }
}
//选择或隐藏目录
    function apply() {
        let is_show = $('.blog-mask').is('.layui-show');
        if(is_show){
            $('.blog-nav-left').removeClass('leftIn');
            $('.blog-nav-left').removeClass('layui-show');
            $('.blog-nav-left').addClass('leftOut');
            $('.blog-nav-left').addClass('layui-hide');
            $('.blog-mask').removeClass('leftIn');
            $('.blog-mask').removeClass('layui-show');
            $('.blog-mask').addClass('leftOut');
            $('.blog-mask').addClass('layui-hide');
            return;
        }
        $('.blog-nav-left').addClass('leftIn');
        $('.blog-nav-left').addClass('layui-show');
        $('.blog-nav-left').removeClass('leftOut');
        $('.blog-nav-left').removeClass('layui-hide');
        $('.blog-mask').addClass('leftIn');
        $('.blog-mask').addClass('layui-show');
        $('.blog-mask').removeClass('leftOut');
        $('.blog-mask').removeClass('layui-hide');
    }

