/**
 * Created by ylkj on 2018/12/28.
 */
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

