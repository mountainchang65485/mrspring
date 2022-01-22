var tempIndex = 0;
var tempVh = 0;
var couponNoTemp = "";
var memCouponNoTemp = "";
// var sqlString = "";

if(parseInt(window.innerWidth) > 768){
    tempVh = 100;
}else{
    tempVh = 200;
}
// console.log(window.innerWidth);

PageContainer = document.querySelector(".reservationContainer_d");

//下一步btn
page1_nextStep = document.querySelector(".first_page .nextStep");
page2_nextStep = document.querySelector(".second_page .nextStep");

//上一步btn
page2_prevStep = document.querySelector(".second_page .previousStep_d");
page3_prevStep = document.querySelector(".third_page .previousStep_d");

//完成預約btn
page3_nextStep = document.querySelector(".third_page .nextStep");

page1_nextStep.addEventListener("click",nextStep);
page2_nextStep.addEventListener("click",nextStep);

page2_prevStep.addEventListener("click",prevStep);
page3_prevStep.addEventListener("click",prevStep);

page3_nextStep.addEventListener("click",completeOrder);

function nextStep(){
    if(tempIndex == 0){
        var xhrMember = new  XMLHttpRequest();
        xhrMember.onreadystatechange = function(){
            if( xhrMember.readyState == 4){
                if( xhrMember.status == 200 ){
                    if(xhrMember.responseText == 1){
                        firstPageMove();
                    }else if(datevalue != "" && temp_card != ""){
                        document.getElementById("smallLightBox_wrapper").style.visibility = "visible";
                        document.querySelector("#smallLightBox_wrapper h3").innerHTML = "還沒登入哦!!!";
                        // alert( "還沒登入哦" );
                    }else if(datevalue == "" && temp_card != ""){
                        document.getElementById("smallLightBox_wrapper").style.visibility = "visible";
                        document.querySelector("#smallLightBox_wrapper h3").innerHTML = "還沒選擇日期和登入哦!!!";
                        // alert( "還沒選擇日期和登入哦" );
                    }else if(datevalue != "" && temp_card == ""){
                        document.getElementById("smallLightBox_wrapper").style.visibility = "visible";
                        document.querySelector("#smallLightBox_wrapper h3").innerHTML = "還沒選擇湯牌和登入哦!!!";
                        // alert( "還沒選擇湯牌和登入哦" );
                    }else if(datevalue == "" && temp_card == ""){
                        document.getElementById("smallLightBox_wrapper").style.visibility = "visible";
                        document.querySelector("#smallLightBox_wrapper h3").innerHTML = "還沒選擇湯牌、日期和登入哦!!!";
                        // alert( "還沒選擇湯牌、日期和登入哦" );
                    }
                }else{
                    alert( xhrMember.status );
                }
            }
        }
        var urlMember = "php/login_or_not.php";
        xhrMember.open("Get", urlMember, true);
        xhrMember.send( null );

        function firstPageMove(){
            //判斷有沒有選擇日期
            // console.log(datevalue);
            // console.log(temp_card);
            if(datevalue != "" && temp_card != ""){
                //每次點選初始化選項

                //初始化時段動畫
                roomvalue = "000";
                for(let j = 0;j < document.getElementsByClassName("clock").length;j++){
                    document.getElementsByClassName("clock")[j].style.filter = "brightness(1)";
                    document.getElementsByClassName("clock")[j].addEventListener("click",clockSlide);
                    document.getElementsByClassName("clock")[j].classList.add("nav-control");
                }
                document.getElementsByClassName("firstBranch_d")[0].click();
                document.getElementsByClassName("firstClock_d")[0].click();
                
                

                roomvalue = "";
                clockvalue = "";
                stepCount = 0;
                
                document.getElementsByClassName("firstBranch_d")[0].style.backgroundColor = "rgb(0, 209, 188)";
                document.querySelectorAll(".branch_container img")[0].style.opacity = ".5";
                document.querySelectorAll(".branch_container img")[0].style.filter = "brightness(1)";

                document.getElementsByClassName("secondBranch_d")[0].style.backgroundColor = "#f9c8b9";
                document.querySelectorAll(".branch_container img")[1].style.opacity = ".5";
                document.querySelectorAll(".branch_container img")[1].style.filter = "brightness(1)";
                
                document.getElementsByClassName("thirdBranch_d")[0].style.backgroundColor = "#7fd1de";
                document.querySelectorAll(".branch_container img")[2].style.opacity = ".5";
                document.querySelectorAll(".branch_container img")[2].style.filter = "brightness(1)";

                document.getElementById("roomPriceText").innerText = "0";
                document.getElementsByClassName("branchTextContainer")[0].style.transform = "translateY(0)";
                document.getElementsByClassName("clockTextContainer")[0].style.transform = "translateY(0)";
                // document.getElementById("roomPriceText").innerText = document.getElementsByClassName("branch")[0].getAttribute("roomPrice");
                // for(var i = 0;i < document.getElementsByClassName("slider-list__item").length;i++){
                //     if(document.getElementsByClassName("slider-list__item")[i].className.indexOf("slider-list__item_active") != -1){
                //         document.getElementsByClassName("slider-list__item")[i].classList.remove("slider-list__item_active");
                //     }
                // }
                // document.getElementsByClassName("slider-list__item")[0].classList.add("slider-list__item_active");
                
                // document.getElementsByClassName("slider-list__item")[0].style.transform = "rotate(0deg) translateX(0%)";
                // document.querySelectorAll(".slider-list__item .back__element")[0].style.transform = "rotate(0deg) translateX(0%)";
                // document.querySelectorAll(".slider-list__item .front__element")[0].style.transform = "rotate(0deg) translateX(0%)";
                
                // document.getElementsByClassName("slider-list__item")[1].style.transform = "rotate(90deg) translateX(100%)";
                // document.getElementsByClassName("slider-list__item")[2].style.transform = "rotate(90deg) translateX(100%)";

                //初始化選擇時段(不可以點選)
                for(var j = 0;j < document.getElementsByClassName("clock").length;j++){
                    document.getElementsByClassName("clock")[j].style.filter = "brightness(.5)";
                    document.getElementsByClassName("clock")[j].removeEventListener("click",clockSlide);
                    document.getElementsByClassName("clock")[j].classList.remove("nav-control");
                }
                
                PageContainer.style.transform = `translateY(${-1*tempVh}vh)`;
                window.scroll(0,0);
                stepCount++;
                tempIndex++;
            }else if(datevalue == "" && temp_card != ""){
                document.getElementById("smallLightBox_wrapper").style.visibility = "visible";
                document.querySelector("#smallLightBox_wrapper h3").innerHTML = "還沒選擇日期哦!!!";
            }else if(datevalue != "" && temp_card == ""){
                document.getElementById("smallLightBox_wrapper").style.visibility = "visible";
                document.querySelector("#smallLightBox_wrapper h3").innerHTML = "還沒選擇湯牌哦!!!";
            }else if(datevalue == "" && temp_card == ""){
                document.getElementById("smallLightBox_wrapper").style.visibility = "visible";
                document.querySelector("#smallLightBox_wrapper h3").innerHTML = "還沒選擇湯牌和日期哦!!!";
            }
        }       
    }else if(tempIndex == 1){
        var xhrMember = new  XMLHttpRequest();
        xhrMember.onreadystatechange = function(){
            if( xhrMember.readyState == 4){
                if( xhrMember.status == 200 ){
                    if(xhrMember.responseText == 1){
                        secondPageMove();
                    }else if(roomvalue != "" && clockvalue != ""){
                        document.getElementById("smallLightBox_wrapper").style.visibility = "visible";
                        document.querySelector("#smallLightBox_wrapper h3").innerHTML = "還沒登入哦!!!";
                    }else if(roomvalue == "" && clockvalue != ""){
                        document.getElementById("smallLightBox_wrapper").style.visibility = "visible";
                        document.querySelector("#smallLightBox_wrapper h3").innerHTML = "還沒選擇分店和登入哦!!!";
                    }else if(roomvalue != "" && clockvalue == ""){
                        document.getElementById("smallLightBox_wrapper").style.visibility = "visible";
                        document.querySelector("#smallLightBox_wrapper h3").innerHTML = "還沒選擇時段和登入哦!!!";
                    }else if(roomvalue == "" && clockvalue == ""){
                        document.getElementById("smallLightBox_wrapper").style.visibility = "visible";
                        document.querySelector("#smallLightBox_wrapper h3").innerHTML = "還沒選擇分店、時段和登入哦!!!";
                    }
                }else{
                    alert( xhrMember.status );
                }
            }
        }
        var urlMember = "php/login_or_not.php";
        xhrMember.open("Get", urlMember, true);
        xhrMember.send( null );

        function secondPageMove(){
            //判斷有沒有選擇分店或時段
            // console.log(roomvalue);
            // console.log(clockvalue);
            if(roomvalue != "" && clockvalue != ""){
                //填日期
                document.getElementById("orderResDate").innerText = datevalue.split("-").join("/");
                document.getElementById("roomResDate").innerText = datevalue.split("-").join("/");
                
                //填時段
                if(clockvalue == "morning"){
                    document.getElementById("orderResTime").innerText = "早上09:00-12:00";
                    document.getElementById("roomResTime").innerText = "早上";
                    document.querySelector(".roomInfoClockImg_d img").src = "images/morning_black.png"
                }else if(clockvalue == "afternoon"){
                    document.getElementById("orderResTime").innerText = "下午15:00-18:00";
                    document.getElementById("roomResTime").innerText = "下午";
                    document.querySelector(".roomInfoClockImg_d img").src = "images/afternoon_black.png"
                }else{
                    document.getElementById("orderResTime").innerText = "晚上21:00-24:00";
                    document.getElementById("roomResTime").innerText = "晚上";
                    document.querySelector(".roomInfoClockImg_d img").src = "images/night_black.png"
                }
                    
                //填分店
                document.getElementById("orderRoomName").innerText = roomvalue + "分店";
                document.getElementById("roomResName").innerText = roomvalue + "店";

                //填分店照片,分店資訊,分店價錢
                var xhr = new XMLHttpRequest();
                xhr.onreadystatechange = function(){
                    if( xhr.readyState == 4){
                        if( xhr.status == 200 ){
                            showBranchImg(xhr.responseText);
                        }else{
                            alert( xhr.status );
                        }
                    }
                }

                var url = "php/branchImg.php?roomvalue=" + roomvalue + "店";
                xhr.open("Get", url, true);
                xhr.send( null );

                function showBranchImg(jsonStr){
                    var BranchImg = JSON.parse(jsonStr);
                    // console.log(BranchImg);
                    document.querySelectorAll(".roomPicSlider_d .roomPic img")[0].src = BranchImg[0].branchImgUrl1;
                    document.querySelectorAll(".roomPicSlider_d .roomPic img")[1].src = BranchImg[0].branchImgUrl2;
                    document.querySelectorAll(".roomPicSlider_d .roomPic img")[2].src = BranchImg[0].branchImgUrl3;
                    document.querySelector(".roomInfoText p").innerText = BranchImg[0].branchDescription;
                    document.getElementById("orderRoomPrice").innerText = BranchImg[0].branchPrice;
                }

                //填湯牌名稱,湯牌價錢
                var xhr2 = new XMLHttpRequest();
                xhr2.onreadystatechange = function(){
                    if( xhr2.readyState == 4){
                        if( xhr2.status == 200 ){
                            showCardInfo(xhr2.responseText);
                        }else{
                            alert( xhr2.status );
                        }
                    }
                }

                var url2 = "php/yt_cardInfo.php?cardNo=" + document.querySelector(".springCard .card").getAttribute("cardNo");
                xhr2.open("Get", url2, true);
                xhr2.send( null );

                function showCardInfo(jsonStr){
                    var CardInfo = JSON.parse(jsonStr);
                    // console.log(CardInfo);
                    document.getElementById("orderCardName").innerText = CardInfo.effectTypeName;
                    document.getElementById("orderCardPrice").innerText = CardInfo.cardPrice;
                }

                //初始化訂單總價錢
                document.getElementById("roomTotalPriceText").innerText = parseInt(document.getElementById("roomPriceText").innerText) + parseInt(document.getElementById("cardPriceText").innerText);
                roomTotalPriceTextTemp = document.getElementById("roomTotalPriceText").innerText;
                document.getElementById("couponDiscount").innerText = "0";
                
                //產生優惠券選項
                var xhr3 = new XMLHttpRequest();
                xhr3.onreadystatechange = function(){
                    if( xhr3.readyState == 4){
                        if( xhr3.status == 200 ){
                            showCoupon(xhr3.responseText);
                        }else{
                            alert( xhr3.status );
                        }
                    }
                }

                var url3 = "php/yt_showCoupon.php";
                xhr3.open("Get", url3, true);
                xhr3.send( null );

                function showCoupon(jsonStr){
                    var Coupon = JSON.parse(jsonStr);
                    // console.log(Coupon);
                    
                    var couponInnerHtml = "";

                    document.getElementById("coupon").innerHTML = couponInnerHtml;

                    couponInnerHtml += `<option value="0">選擇優惠券</option>`
                    for(let i = 0;i < Coupon.length;i++){
                        couponInnerHtml += `<option value="${i+1}" couponNo="${Coupon[i].memCouponNo}">${Coupon[i].couponName}</option>`
                    }
                    document.getElementById("coupon").innerHTML = couponInnerHtml;

                    document.querySelector(".orderDetails select").addEventListener("input",function(){
                        // console.log(document.querySelector(".orderDetails select").value);
                        couponIndex = document.querySelector(".orderDetails select").value;
                        
                        if(couponIndex == 0){
                            couponNoTemp = "";
                            memCouponNoTemp = "";
                            document.getElementById("roomTotalPriceText").innerText = parseInt(document.getElementById("orderCardPrice").innerText) + parseInt(document.getElementById("orderRoomPrice").innerText);
                        }else{
                            couponNoTemp = Coupon[couponIndex-1].couponNo;
                            memCouponNoTemp = Coupon[couponIndex-1].memCouponNo;
                            if(Coupon[couponIndex-1].couponType == 1){
                                document.getElementById("roomTotalPriceText").innerText = (parseInt(document.getElementById("orderCardPrice").innerText) + parseInt(document.getElementById("orderRoomPrice").innerText) - parseInt(Coupon[couponIndex-1].couponDiscount));
                            }else if(Coupon[couponIndex-1].couponType == 2){
                                document.getElementById("roomTotalPriceText").innerText = Math.ceil((parseInt(document.getElementById("orderCardPrice").innerText) + parseInt(document.getElementById("orderRoomPrice").innerText)) * parseFloat(Coupon[couponIndex-1].couponDiscount));
                            } 
                        }
                        document.getElementById("couponDiscount").innerText = parseInt(roomTotalPriceTextTemp) - parseInt(document.getElementById("roomTotalPriceText").innerText);
                        // console.log(couponNoTemp);
                    });
                }

                //填登入者資訊
                var xhr4 = new XMLHttpRequest();
                xhr4.onreadystatechange = function(){
                    if( xhr4.readyState == 4){
                        if( xhr4.status == 200 ){
                            showMemberInfo(xhr4.responseText);
                        }else{
                            alert( xhr4.status );
                        }
                    }
                }

                var url4 = "php/yt_showMemberInfo.php";
                xhr4.open("Get", url4, true);
                xhr4.send( null );

                function showMemberInfo(jsonStr){
                    var memberInfo = JSON.parse(jsonStr);
                    console.log(memberInfo);
                    document.getElementById("orderMemAccount").innerText = memberInfo.memId;
                    document.getElementById("orderMemFirstName").innerText = memberInfo.memFirstName;
                    document.getElementById("orderMemLastName").innerText = memberInfo.memLastName;
                    document.getElementById("orderTwId").innerText = memberInfo.twId;
                    document.getElementById("orderMemTel").innerText = memberInfo.memTel;
                }

                PageContainer.style.transform = `translateY(${-2*tempVh}vh)`;
                window.scroll(0,0);
                tempIndex++;
            }else if(roomvalue == "" && clockvalue == ""){
                document.getElementById("smallLightBox_wrapper").style.visibility = "visible";
                document.querySelector("#smallLightBox_wrapper h3").innerHTML = "還沒選擇分店和時段哦!!!";
            }else if(roomvalue != "" && clockvalue == ""){
                document.getElementById("smallLightBox_wrapper").style.visibility = "visible";
                document.querySelector("#smallLightBox_wrapper h3").innerHTML = "還沒選擇時段哦!!!";
            }
        }    
    }
    // console.log(tempIndex);
    // console.log(tempVh);
}

function prevStep(){
    if(tempIndex == 1){
        PageContainer.style.transform = `translateY(0)`;
        tempIndex--;
    }else if(tempIndex == 2){
        PageContainer.style.transform = `translateY(${-1*tempVh}vh)`;
        tempIndex--;
    }
    window.scroll(0,0);
    // console.log(tempIndex);
    // console.log(tempVh);
}

//偵測視窗width的改變
window.onresize = resize;

function resize(){
    if(parseInt(window.innerWidth) > 768){
        tempVh = 100;
    }else{
        tempVh = 200;
    }
    // console.log(window.innerWidth);
}

//完成預約
function completeOrder(){
    var xhrMember = new  XMLHttpRequest();
    xhrMember.onreadystatechange = function(){
        if( xhrMember.readyState == 4){
            if( xhrMember.status == 200 ){
                if(xhrMember.responseText == 1){
                    thirdPageComplete();
                }else{
                    document.getElementById("smallLightBox_wrapper").style.visibility = "visible";
                    document.querySelector("#smallLightBox_wrapper h3").innerHTML = "還沒登入哦!!!";
                }
            }else{
                alert( xhrMember.status );
            }
        }
    }
    var urlMember = "php/login_or_not.php";
    xhrMember.open("Get", urlMember, true);
    xhrMember.send( null );

    function thirdPageComplete(){
        //新增不開放時段
        var xhr = new XMLHttpRequest();
        xhr.onreadystatechange = function(){
            if( xhr.readyState == 4){
                if( xhr.status == 200 ){
                    inserReservationToDb(xhr.responseText);
                }else{
                    alert( xhr.status );
                }
            }
        }

        var url = "php/yt_InserReservationToDb.php?roomvalue=" + roomvalue + "店" + "&datevalue=" + datevalue + "&clockvalue=" + clockvalue;
        xhr.open("Get", url, true);
        xhr.send( null );

        function inserReservationToDb(jsonStr){
            // console.log(jsonStr);
        }

        //新增訂單,下架使用的優惠券
        var xhr2 = new XMLHttpRequest();
        xhr2.onreadystatechange = function(){
            if( xhr2.readyState == 4){
                if( xhr2.status == 200 ){
                    inserOrderToDb(xhr2.responseText);
                }else{
                    alert( xhr2.status );
                }
            }
        }

        var OrderInfo = {};
        // OrderInfo.memNo = 1;
        OrderInfo.orderResDate = datevalue;
        OrderInfo.orderResTime = clockvalue;
        OrderInfo.branchNo = roomvalue + "店";
        OrderInfo.cardNo = document.querySelector(".springCard .card").getAttribute("cardNo");
        OrderInfo.orderOldPrice = parseInt(roomTotalPriceTextTemp);
        OrderInfo.orderNewPrice = parseInt(document.getElementById("roomTotalPriceText").innerText);
        OrderInfo.couponNo = couponNoTemp;
        OrderInfo.memCouponNo = memCouponNoTemp;
        // console.log(OrderInfo.orderNewPrice);
        var jsonStr = JSON.stringify(OrderInfo);

        var url2 = "php/yt_InserOrderToDb.php?jsonStr=" + jsonStr;
        xhr2.open("Get", url2, true);
        xhr2.send( null );

        function inserOrderToDb(jsonStr){
            // console.log(jsonStr);
        }



        document.getElementById("smallLightBox_wrapper").style.visibility = "visible";
        document.querySelector("#smallLightBox_wrapper h3").innerHTML = "已完成付款囉，請前往會員中心查看預約。"
        document.querySelector("#smallLightBox_wrapper .nextStepBtn_d").addEventListener("click",jumpUrl);
        
        function jumpUrl(){
            location.href = "member.php";
            document.querySelector("#smallLightBox_wrapper .nextStepBtn_d").removeEventListener("click",jumpUrl);
        }
    } 
}