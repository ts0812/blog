//音乐列表


$(function(){
    let musicUrl = domainName+'/api/blog/get-article-list';
    let state = 1;
    addContent(1);
    function addContent(i){
        $.ajax({
            url:musicUrl,
            type:'get',
            dataType: "json",
            data:{
                page:i,
                size:10
            },
            success:function (data) {
                if(data.status==1){
                    let indexData=data.data;
                    let length = indexData.length;
                    if(length==0){
                        state=0;
                        tishi();
                        return;
                    }
                    let i,type='',txt='';
                    for (i=0;i<length;i++){
                        if(indexData[i]['type'])
                            type = '<div class="t-right-new"><p>'+indexData[i]['type']+'</p></div>';
                        txt+='<div class="grid-item item">'+type+'<a class="url" href="article.html?id='+indexData[i]['content_id']+'""><img src="'+indexData[i]['image']+'" class="item-img"  onerror="this.src=\'images/demo2.jpg\'"/> <section class="section-p"> <p class="price-p">'+indexData[i]['title']+'</p> </section> </a> </div>';
                    }
                    $('.fall-box').append(txt);
                }
            },
            error:function () {
                alert('error');
            }
        })
    }

    let i=1;
    $(window).scroll(function(){
        var scrollTop = $(this).scrollTop();var scrollHeight = $(document).height();var windowHeight = $(this).height();
        if(scrollTop + windowHeight == scrollHeight){
            console.log(state);
            ++i;
            if(state==0)
                return false;
            addContent(i);
        }
    })
    function tishi(){
        $('.more-n').html('<div style="width: 150px;\n' +
            '    height: 30px;\n' +
            '    line-height: 30px;\n' +
            '    font-size: 16px;\n' +
            '    text-align: center;\n' +
            '    border-radius: 3px;\n' +
            '    opacity: 0.7;\n' +
            '    background: rgb(0, 0, 0);\n' +
            '    margin: 10px auto 30px;\n' +
            '    color: rgb(255, 255, 255);\n' +
            '    display: block;">就有这么多了！</div>');
    }
})

