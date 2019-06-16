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
                    let i=0,type='',txt='';
                    console.log(indexData);
                    var insertDiv = setInterval(function () {
                        if(i>=length-1)
                            clearInterval(insertDiv);
                        if(indexData[i]['type'])
                            type = '<div class="t-right-new"><p>'+indexData[i]['type']+'</p></div>';
                        txt='<div class="grid-item item">'+type+'<a class="url" target="_blank" href="article.html?id='+indexData[i]['content_id']+'""><img src="'+indexData[i]['image']+'" class="item-img"  onerror="this.src=\'images/demo2.jpg\'"/> <section class="section-p"> <p class="price-p">'+indexData[i]['title']+'</p> </section> </a> </div>';
                        let box_y = $('.box-y');
                        let minIndex = getHeight(box_y);
                        box_y.eq(minIndex).append(txt);
                        i++;
                    },100);
                }
            },
            error:function () {
                alert('error');
            }
        })
    }
    //计算瀑布流每行高度，返回最低的index值
    function getHeight(box_y){
        let length = box_y.length;
        if(length==0)
            return false;
        let i,j,minIndex=0,minHeight=0;
        for (i=0;i<length;i++) {
            let gridItem = box_y.eq(i).children('.grid-item');
            let gridHeight=0; //行高度
            if(gridItem.length != 0 ) {
                for (j = 0; j < gridItem.length; j++) {
                    gridHeight += gridItem.eq(j).height();
                }
            }
            if(i==0)
                minHeight = gridHeight;
            else{
                if(gridHeight<minHeight){
                    minHeight = gridHeight;
                    minIndex=i;
                }
            }
        }
        return minIndex;
    }
    let page=1;
    $(window).scroll(function(){
        var scrollTop = $(this).scrollTop();var scrollHeight = $(document).height();var windowHeight = $(this).height();
        if(scrollTop + windowHeight == scrollHeight){
            console.log(state);
            ++page;
            if(state==0)
                return false;
            addContent(page);
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

