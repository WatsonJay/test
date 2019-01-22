/**
 * Created by ylkj on 2018/12/28.
 */
jQuery(document).ready(function($){

    $(document).ready(function() {
        $('h2 a').click(function(){
            myloadoriginal = this.text;
            $(this).text('正在给力加载中 ...');
            var myload = this;
            setTimeout(function() { $(myload).text(myloadoriginal); }, 2012);
        });
    });

    $(document).ready(function(){
        $('#comment').bind('focus keyup input paste',function(){  //采用几个事件来触发（已增加鼠标粘贴事件）
            $('#commentnum').text($(this).attr("value").length)  //获取评论框字符长度并添加到ID="commentnum"元素上
        });
    });

    window.onload=window.onresize=function(){
        if(document.getElementById("main_right").clientHeight<document.getElementById("main_left").clientHeight){
            document.getElementById("main_right").style.height=document.getElementById("main_left").offsetHeight+"px";
        }
        else{
            document.getElementById("main_left").style.height=document.getElementById("main_right").offsetHeight+"px";
        }
    }

    $(function () {
        $('img').hover(
            function() {$(this).fadeTo("fast", 0.8);},
            function() {$(this).fadeTo("fast", 1);
            });
    });

//漂亮标题
    $('a').mouseover(function(e){
        this.myTitle = this.title;
        this.myHref = this.href;
        this.myHref = (this.myHref.length > 30 ? this.myHref.toString().substring(0,30)+"..." : this.myHref);
        this.title = "";
        var tooltip = "<div id='tooltip'><p>"+this.myTitle+"<em>"+this.myHref+"</em>"+"</p></div>";
        $('body').append(tooltip);
        $('#tooltip').css({"opacity":"0.8","top":(e.pageY+20)+"px","left":(e.pageX+10)+"px"}).show('fast');
    }).mouseout(function(){this.title = this.myTitle;$('#tooltip').remove();
    }).mousemove(function(e){$('#tooltip').css({"top":(e.pageY+20)+"px","left":(e.pageX+10)+"px"});
    });


    /*自定义滚动到评论与滚动到文章*/
    $("a.goto_comment").click(function () {
        $body.animate({
                scrollTop: $("#respond").offset().top
            },
            500)
    })
    $("a.goto_post").click(function () {
        $body.animate({
                scrollTop: $("#main").offset().top
            },
            500)
    })
    $("a.expand_all_cmt").click(function () {
        $('#commentlist').toggle();
    })
//END-------------
})

/* @reply js by zwwooooo */
jQuery(document).ready(function($){
//Begin jQuery
    $('.reply').click(function() {
        var atid = '"#' + $(this).parent().parent().attr("id") + '"';
        var atname = $(this).prevAll().find('cite:first').text();
        $("#comment").attr("value","<a href=" + atid + ">@" + atname + " </a>\n").focus();
    });
    $('a#cancel-comment-reply-link').click(function() { //点击取消回复评论清空评论框的内容
        $("#comment").attr("value",'');
    });
})
//END------------------
function timer() {
    var start = new Date(2018,09, 26); // 2018, 10, 26
    var end= new Date();
    var t = end - start;
    var h = ~~(t / 1000 / 60 / 60 % 24);
    if (h < 10) {
        h = "0" + h;
    }
    var m = ~~(t / 1000 / 60 % 60);
    if (m < 10) {
        m = "0" + m;
    }

    var s = ~~(t / 1000 % 60);
    if (s < 10) {
        s = "0" + s;
    }
    document.getElementById('d').innerHTML = ~~(t / 1000 / 60 / 60 / 24);
    document.getElementById('h').innerHTML = h;
    document.getElementById('m').innerHTML = m;
    document.getElementById('s').innerHTML = s;
}


function $(id){
    return document.getElementById(id)
}
function getHeight() {
    $(function(){

    })
}

window.onload = function() {
    getHeight();
}

