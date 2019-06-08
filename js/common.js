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

//封装过期控制代码
function set(key,value){
    var curTime = new Date().getTime();
    localStorage.setItem(key,JSON.stringify({data:value,time:curTime}));
}
function get(key,exp) {
    var data = localStorage.getItem(key);
    if(!data)
        return false;
    var dataObj = JSON.parse(data);
    if (new Date().getTime() - dataObj.time > exp) {
        localStorage.removeItem(key);
        console.log('身份已过期');
        return false;
    } else {
        var dataObjDatatoJson = JSON.parse(dataObj.data)
        return dataObjDatatoJson;
    }
}
// //流量统计
//     var hm = document.createElement("script");
//     hm.src = "file:///C:/Users/Administrator/Desktop/blog/js/traffic.js";
//     var s = document.getElementsByTagName("script")[0];
//     s.parentNode.insertBefore(hm, s);
