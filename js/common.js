let domainName='http://yii.mybdxc.cn'; //定义接口域名
//获取url参数
function getQueryVariable(variable)
{
    var query = window.location.search.substring(1);
    var vars = query.split("&");
    for (var i=0;i<vars.length;i++) {
        var pair = vars[i].split("=");
        if(pair[0] == variable){return pair[1];}
    }
    return(false);
}
// //流量统计
//     var hm = document.createElement("script");
//     hm.src = "file:///C:/Users/Administrator/Desktop/blog/js/traffic.js";
//     var s = document.getElementsByTagName("script")[0];
//     s.parentNode.insertBefore(hm, s);
