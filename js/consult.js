

// 諮詢小遊戲=====================================================================================================

var box_used = false;
var qa = ['最近的你，是否經常會睡不著，徹夜難眠呢?',
    '最近的你，那麼對於飲食多久會吃油炸的食物呢?',
    '對於皮膚狀況多久會覺得粉刺及青春痘困擾你呢?',
    '面對生活的壓力，多久會感到特別浮躁，無法專心?',
    '感覺皮膚粗糙且容易出油、黯沉的頻率是?'];
var qi = 0;
var prevNumber=-1;
function f_q(str) {
    if (qi == 5) {
        document.getElementById('qus').innerHTML = '感覺皮膚粗糙且容易出油、黯沉的頻率是?';
        document.getElementById('qn').innerHTML = 'Q6';
        if(!box_used){
            box_used = true;
            document.getElementById(str).style.color = "white";
            var boxOne = document.getElementsByClassName('an_prescription')[0];
            var boxtwo = document.getElementsByClassName('an_cabinet')[0];
            var boxthree = document.getElementsByClassName('monkeyMedPic')[0];
            boxOne.classList.add('an_prescription_animation');
            boxtwo.classList.add('an_cabinet_animation');
            boxthree.classList.add('an_monkey_animation');
            $("#showshower").css("display", "flex").hide(0).fadeIn(2000);
            
        }
    } else {
        document.getElementsByClassName("an_circle1")[qi].style.backgroundImage = "url('images/cir.png')";
        document.getElementById('qn').innerHTML = 'Q' + (qi + 2);
        document.getElementById('qus').innerHTML = qa[qi];
        if( prevNumber != -1){
            document.getElementsByClassName('extend')[prevNumber].style.width="0";
        }
        var extendnumber = Math.floor(Math.random()*8);
        var extend = document.getElementsByClassName('extend')[extendnumber];
        extend.style.width = '30px';
        prevNumber = extendnumber;
        qi++;
    }
}


// 按下完成=====================================================================================================



// var boxOne = document.getElementsByClassName('an_prescription')[0];
// var boxtwo = document.getElementsByClassName('an_cabinet')[0];
// var boxthree = document.getElementsByClassName('an_monkeyCabinet')[0];
// document.getElementById('an_qsFin').onclick = function () {
//     boxOne.classList.add('an_prescription_animation');
//     boxtwo.classList.add('an_cabinet_animation');
//     boxthree.classList.add('an_monkey_animation');
// }


// 按下完成=====================================================================================================



// $(document).ready(function () {
//     $("#an_qsFin").click(function () {
//         $("#showshower").css('display','flex'); 
//         $("#showshower").delay(1300).fadeIn(2000);
//         $("#showshower").addClass("showshower_flex");
//         $("#showshower").css("display", "flex").hide(0).fadeIn(2000);
//         $('#showshower').delay(1300).fadeIn(2000).css('display','flex');
//     });
// });



// 第四屏換照片=================================================================================================


