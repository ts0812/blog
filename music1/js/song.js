var songContent = "[00:00.00]往后余生 \n[00:01.98]词：马良\n[00:04.12]曲：马良\n[00:07.46]作者: 蜡笔小新\n[00:16.05]在没风的地方找太阳\n[00:24.00]在你冷的地方做暖阳\n[00:31.63]人事纷纷\n[00:34.83]你总太天真\n[00:38.86]往后的余生\n[00:41.16]我只要你\n[00:44.21]往后余生\n[00:48.70]风雪是你\n[00:52.04]平淡是你[00:55.04]清贫也是你\n[00:57.59]荣华是你\n[01:03.50]心底温柔是你\n[01:06.40]目光所致\n[01:09.95]也是你\n[01:30.88]想带你去看晴空万里\n[01:38.28]想大声告诉你我为你着迷\n[01:43.90]往事匆匆\n[01:48.10]你总是会感动\n[01:52.02]往后的余生\n[01:54.89]我只要你\n[01:57.83]往后余生\n[02:01.83]风雪是你\n[02:05.69]春华是你\n[02:08.73]夏雨也是你\n[02:13.07]秋黄是你\n[02:16.85]四季冷暖是你\n[02:20.56]目光所致\n[02:23.72]也是你\n[03:19.72]往后余生\n[03:24.72]风雪是你\n[03:27.72]平淡是你\n[03:31.72]清贫也是你\n[03:35.72]荣华是你\n[03:38.72]心底温柔是你\n[03:42.72]目光所致\n[03:45.72]也是你\n[03:50.72]目光所致\n[03:52.72]也是你";

//var songContent1 = '[00:13.83]好きな人がつらい时に\n[00:20.30]一绪にいてあげられない\n[00:26.31]今すぐ逢いに行って\n[00:33.02]ギュッてきつく抱きしめたい\n[00:46.41]これからずっと2人だから\n[00:52.14]神様きっと试练下した\n[00:58.14]幸せすぎると后でダメになる\n[01:04.90]だからこんな时乗り越えよう\n[01:16.67]逢えなくなるね 见送るよ\n[01:22.80]さよならの前に抱き合う\n[01:29.46]背中にまわされた大きな手\n[01:52.39]あの顷ずっとあなたを\n[01:58.80]独り占めしていたよね\n[02:04.64]今では声だけでも\n[02:11.29]こんなに大切なのに\n[02:22.58]逢えなくなるね 见送るよ\n[02:28.88]さよならの前に抱き合う\n[02:35.56]颜を上げて 頬を寄せて 笑颜でいった\n[03:23.08]电话やベルかけまくって\n[03:29.28]気持ち伝えているのに\n[03:35.22]どうしてこんな风に\n[03:41.76]涙ばかりあふれてる\n[03:52.99]逢えなくなるね 见送るよ\n[03:59.20]さよならの前に抱き合う\n[04:06.50]背中にまわされた大きな手\n[04:18.12]逢えなくなるね 见送るよ\n[04:24.34]さよならの前に抱き合う\n[04:31.10]颜を上げて 頬を寄せて 笑颜でいった\n[04:43.06]逢えなくなるね 见送るよ\n[04:49.21]さよならの前に抱き合う\n[04:55.81]背中にまわされた大きな手\n[05:08.43]离れてても\n[05:11.65]心の中\n[05:14.84]君がいるから\n[05:26.01](终わり)' ;
function parseLyric(text) {
    //将文本分隔成一行一行，存入数组
    var lines = text.split('\n'),
        //用于匹配时间的正则表达式，匹配的结果类似[xx:xx.xx]
        pattern = /\[\d{2}:\d{2}.\d{2}\]/g,
        //保存最终结果的数组
        result = [];
    //去掉不含时间的行
    while (!pattern.test(lines[0])) {
        lines = lines.slice(1);
    };
    //上面用'\n'生成生成数组时，结果中最后一个为空元素，这里将去掉
    lines[lines.length - 1].length === 0 && lines.pop();
    lines.forEach(function(v /*数组元素值*/ , i /*元素索引*/ , a /*数组本身*/ ) {
        //提取出时间[xx:xx.xx]
        var time = v.match(pattern),
            //提取歌词
            value = v.replace(pattern, '');
        //因为一行里面可能有多个时间，所以time有可能是[xx:xx.xx][xx:xx.xx][xx:xx.xx]的形式，需要进一步分隔
        time.forEach(function(v1, i1, a1) {
            //去掉时间里的中括号得到xx:xx.xx
            var t = v1.slice(1, -1).split(':');
            //将结果压入最终数组
            result.push([parseInt(t[0], 10) * 60 + parseFloat(t[1]), value]);
        });
    });
    //最后将结果数组中的元素按时间大小排序，以便保存之后正常显示歌词
    result.sort(function(a, b) {
        return a[0] - b[0];
    });
    return result;
}
