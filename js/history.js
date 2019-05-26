window.onload=function (){
    let historyUrl = domainName + '/api/blog/get-history-list';
    $.ajax({
        url: historyUrl,
        type: 'get',
        dataType: "json",
        data: {},
        success: function (data) {
            if (data.status == 1) {
                let indexData = data.data;
                let length = indexData.length;
                let i, txt = '';
                for (i = 0; i < length; i++) {
                    txt += '<li> <h3>'+indexData[i]['md']+'<span>'+indexData[i]['year']+'</span></h3> <dl class="right"> <span>'+indexData[i]['content']+'</span></dl></li>'
                }
                txt='<ul><h2 class="second" style="position: relative;"><span>'+indexData[0]['year']+'年</span></h2>'+txt+'</ul>';
                $('.timeline-date').append(txt);
                show();
            }
        },
        error: function () {
            alert('error');
        }
    })
    function show(){
        let timeline= $('.timeline-date');
        let lineHeight=0,i ;
        for (i=0;i<timeline.length;i++) {
            lineHeight+=timeline.eq(i).outerHeight();
        }
        $(".timeline").eq(0).animate({
            height:lineHeight
        },3000);
    }

};