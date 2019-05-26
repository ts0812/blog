
    let id=getQueryVariable('id');
    if(id){
        let articleUrl = domainName+'/api/blog/get-article';
        $.ajax({
            url:articleUrl,
            type:'get',
            data:{
                id:id
            },
            dataType: "json",
            success:function (data) {
                if(data.status==1){
                    $('.title').html(data.data.title);
                    $('.content').html(data.data.content);
                    $('title').html(data.data.title);
                    $('meta[name=keywords]').attr('content',data.data.keywords);
                    $('meta[name=description]').attr('content',data.data.description);
                    $('meta[itemprop=image]').attr('content',data.data.image);
                }
            },
            error:function () {
                alert('error');
            }
        })
    }

