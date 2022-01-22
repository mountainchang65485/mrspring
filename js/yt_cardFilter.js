var temp_card = "";
var cardTimeItemValue = "";
var cardPriceTemp = "0";
document.querySelector("#lightbox .nextStepBtn_d").addEventListener("click",function(){
    if(temp_card == ""){
        document.getElementById("smallLightBox_wrapper").style.visibility = "visible";
        document.querySelector("#smallLightBox_wrapper h3").innerHTML = "還沒選擇湯牌哦!!!"
    }else{
        document.getElementById("cardPriceText").innerHTML = cardPriceTemp;
    }
});




document.getElementById("select-box1").addEventListener("input",cardFilter);
document.getElementById("lightbox_filter_select").addEventListener("input",cardFilter);

function cardFilter(){
    temp_card = "";
    // console.log(document.getElementById("select-box1").value);
    // console.log(this.value);
    var filterValue = this.value;
    
    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function(){
        if( xhr.readyState == 4){
            if( xhr.status == 200 ){
                cardchange(xhr.responseText);
            }else{
                alert( xhr.status );
            }
        }
    }

    var url = "php/yt_cardFilter.php?cardFilter=" + filterValue;
    xhr.open("Get", url, true);
    xhr.send( null );
}


function cardchange(jsonStr){
    var cardResult = JSON.parse(jsonStr);
    // console.log(cardResult);

    var cardInnerHtml = "";

    document.getElementsByClassName("responsive")[0].innerHTML = cardInnerHtml;
    for(let i = 0;i < cardResult.length;i++){
        // console.log(cardResult[i].cardText,cardResult[i].cardText.split("").length);
        cardTextLength = cardResult[i].cardText.split("").length;
        cardTextArry = cardResult[i].cardText.split("");
        for(let j = cardTextLength;j < 6;j++){
            cardTextArry[j] = "";
        }
        cardInnerHtml += `  <div class="cards">
                                <div class="card card${i}" cardNo="${cardResult[i].cardNo}" cardPrice="${cardResult[i].cardPrice}">
                                    <img class="knot" src="images/knot${cardResult[i].effectTypeNo}.png">
                                    <div class="front">
                                        


                                        <div class="draw">
                                            <div class="drawingArea" style="display: block;">
                                                <div class="circle circle0" style="transform: rotate(120deg); transform-origin: 50% 50%; color: ${cardResult[i].cardTextColor1};">
                                                    <p class="futura_R"
                                                        style="transform: rotate(378deg); left: -4.58359px; top: -58.8254px; opacity: 1;font-family: ${cardResult[i].cardFont};">${cardTextArry[0]}
                                                        </p>
                                                    <p class="futura_R"
                                                        style="transform: rotate(306deg); left: -31.4164px; top: -50.1068px; opacity: 1;font-family: ${cardResult[i].cardFont};">${cardTextArry[0]}
                                                        </p>
                                                    <p class="futura_R"
                                                        style="transform: rotate(234deg); left: -31.4164px; top: -21.8932px; opacity: 1;font-family: ${cardResult[i].cardFont};">${cardTextArry[0]}
                                                        </p>
                                                    <p class="futura_R"
                                                        style="transform: rotate(162deg); left: -4.58359px; top: -13.1746px; opacity: 1;font-family: ${cardResult[i].cardFont};">${cardTextArry[0]}
                                                        </p>
                                                    <p class="futura_R"
                                                        style="transform: rotate(90deg); left: 12px; top: -36px; opacity: 1;font-family: ${cardResult[i].cardFont};">${cardTextArry[0]}
                                                        </p>
                                                </div>
                                                <div class="circle circle1" style="transform: rotate(123deg); transform-origin: 50% 50%; color: ${cardResult[i].cardTextColor2};">
                                                    <p class="futura_R"
                                                        style="transform: rotate(330deg); left: -36px; top: -77.5692px; opacity: 1;font-family: ${cardResult[i].cardFont};">${cardTextArry[1]}
                                                        </p>
                                                    <p class="futura_R"
                                                        style="transform: rotate(210deg); left: -36px; top: 5.56922px; opacity: 1;font-family: ${cardResult[i].cardFont};">${cardTextArry[1]}
                                                        </p>
                                                    <p class="futura_R"
                                                        style="transform: rotate(90deg); left: 36px; top: -36px; opacity: 1;font-family: ${cardResult[i].cardFont};">${cardTextArry[1]}
                                                        </p>
                                                </div>
                                                <div class="circle circle2" style="transform: rotate(126deg); transform-origin: 50% 50%; color: ${cardResult[i].cardTextColor3};">
                                                        <p class="futura_R"
                                                            style="transform: rotate(417.273deg); left: 48.5703px; top: -74.9261px; opacity: 1;font-family: ${cardResult[i].cardFont};">${cardTextArry[2]}
                                                            </p>
                                                        <p class="futura_R"
                                                            style="transform: rotate(384.545deg); left: 17.9099px; top: -101.494px; opacity: 1;font-family: ${cardResult[i].cardFont};">${cardTextArry[2]}
                                                            </p>
                                                        <p class="futura_R"
                                                            style="transform: rotate(351.818deg); left: -22.2467px; top: -107.267px; opacity: 1;font-family: ${cardResult[i].cardFont};">${cardTextArry[2]}
                                                            </p>
                                                        <p class="futura_R"
                                                            style="transform: rotate(319.091deg); left: -59.15px; top: -90.414px; opacity: 1;font-family: ${cardResult[i].cardFont};">${cardTextArry[2]}
                                                            </p>
                                                        <p class="futura_R"
                                                            style="transform: rotate(286.364deg); left: -81.0835px; top: -56.2847px; opacity: 1;font-family: ${cardResult[i].cardFont};">${cardTextArry[2]}
                                                            </p>
                                                        <p class="futura_R"
                                                            style="transform: rotate(253.636deg); left: -81.0835px; top: -15.7153px; opacity: 1;font-family: ${cardResult[i].cardFont};">${cardTextArry[2]}
                                                            </p>
                                                        <p class="futura_R"
                                                            style="transform: rotate(220.909deg); left: -59.15px; top: 18.414px; opacity: 1;font-family: ${cardResult[i].cardFont};">${cardTextArry[2]}
                                                            </p>
                                                        <p class="futura_R"
                                                            style="transform: rotate(188.182deg); left: -22.2467px; top: 35.2671px; opacity: 1;font-family: ${cardResult[i].cardFont};">${cardTextArry[2]}
                                                            </p>
                                                        <p class="futura_R"
                                                            style="transform: rotate(155.455deg); left: 17.9099px; top: 29.4935px; opacity: 1;font-family: ${cardResult[i].cardFont};">${cardTextArry[2]}
                                                            </p>
                                                        <p class="futura_R"
                                                            style="transform: rotate(122.727deg); left: 48.5703px; top: 2.92614px; opacity: 1;font-family: ${cardResult[i].cardFont};">${cardTextArry[2]}
                                                            </p>
                                                        <p class="futura_R"
                                                            style="transform: rotate(90deg); left: 60px; top: -36px; opacity: 1;font-family: ${cardResult[i].cardFont};">${cardTextArry[2]}
                                                            </p>
                                                </div>
                                                <div class="circle circle3" style="transform: rotate(129deg); transform-origin: 50% 50%; color: ${cardResult[i].cardTextColor4};">
                                                        <p class="futura_R"
                                                            style="transform: rotate(398.571deg); left: 47.855px; top: -111.056px; opacity: 1;font-family: ${cardResult[i].cardFont};">${cardTextArry[3]}
                                                            </p>
                                                        <p class="futura_R"
                                                            style="transform: rotate(347.143deg); left: -33.362px; top: -129.593px; opacity: 1;font-family: ${cardResult[i].cardFont};">${cardTextArry[3]}
                                                            </p>
                                                        <p class="futura_R"
                                                            style="transform: rotate(295.714deg); left: -98.493px; top: -77.6528px; opacity: 1;font-family: ${cardResult[i].cardFont};">${cardTextArry[3]}
                                                            </p>
                                                        <p class="futura_R"
                                                            style="transform: rotate(244.286deg); left: -98.493px; top: 5.65284px; opacity: 1;font-family: ${cardResult[i].cardFont};">${cardTextArry[3]}
                                                            </p>
                                                        <p class="futura_R"
                                                            style="transform: rotate(192.857deg); left: -33.362px; top: 57.5931px; opacity: 1;font-family: ${cardResult[i].cardFont};">${cardTextArry[3]}
                                                            </p>
                                                        <p class="futura_R"
                                                            style="transform: rotate(141.429deg); left: 47.855px; top: 39.0558px; opacity: 1;font-family: ${cardResult[i].cardFont};">${cardTextArry[3]}
                                                            </p>
                                                        <p class="futura_R"
                                                            style="transform: rotate(90deg); left: 84px; top: -36px; opacity: 1;font-family: ${cardResult[i].cardFont};">${cardTextArry[3]}
                                                            </p>
                                                </div>
                                                <div class="circle circle4" style="transform: rotate(132deg); transform-origin: 50% 50%; color: ${cardResult[i].cardTextColor5};">
                                                    <p class="futura_R"
                                                        style="transform: rotate(428.824deg); left: 99.8967px; top: -79.349px; opacity: 1;font-family: ${cardResult[i].cardFont};">${cardTextArry[4]}
                                                        </p>
                                                    <p class="futura_R"
                                                        style="transform: rotate(407.647deg); left: 76.6811px; top: -116.843px; opacity: 1;font-family: ${cardResult[i].cardFont};">${cardTextArry[4]}
                                                        </p>
                                                    <p class="futura_R"
                                                        style="transform: rotate(386.471deg); left: 41.4886px; top: -143.42px; opacity: 1;font-family: ${cardResult[i].cardFont};">${cardTextArry[4]}
                                                        </p>
                                                    <p class="futura_R"
                                                        style="transform: rotate(365.294deg); left: -0.927797px; top: -155.488px; opacity: 1;font-family: ${cardResult[i].cardFont};">${cardTextArry[4]}
                                                        </p>
                                                    <p class="futura_R"
                                                        style="transform: rotate(344.118deg); left: -44.8396px; top: -151.419px; opacity: 1;font-family: ${cardResult[i].cardFont};">${cardTextArry[4]}
                                                        </p>
                                                    <p class="futura_R"
                                                        style="transform: rotate(322.941deg); left: -84.3162px; top: -131.762px; opacity: 1;font-family: ${cardResult[i].cardFont};">${cardTextArry[4]}
                                                        </p>
                                                    <p class="futura_R"
                                                        style="transform: rotate(301.765deg); left: -114.026px; top: -99.1719px; opacity: 1;font-family: ${cardResult[i].cardFont};">${cardTextArry[4]}
                                                        </p>
                                                    <p class="futura_R"
                                                        style="transform: rotate(280.588deg); left: -129.957px; top: -58.0499px; opacity: 1;font-family: ${cardResult[i].cardFont};">${cardTextArry[4]}
                                                        </p>
                                                    <p class="futura_R"
                                                        style="transform: rotate(259.412deg); left: -129.957px; top: -13.9501px; opacity: 1;font-family: ${cardResult[i].cardFont};">${cardTextArry[4]}
                                                        </p>
                                                    <p class="futura_R"
                                                        style="transform: rotate(238.235deg); left: -114.026px; top: 27.1719px; opacity: 1;font-family: ${cardResult[i].cardFont};">${cardTextArry[4]}
                                                        </p>
                                                    <p class="futura_R"
                                                        style="transform: rotate(217.059deg); left: -84.3162px; top: 59.7621px; opacity: 1;font-family: ${cardResult[i].cardFont};">${cardTextArry[4]}
                                                        </p>
                                                    <p class="futura_R"
                                                        style="transform: rotate(195.882deg); left: -44.8396px; top: 79.4191px; opacity: 1;font-family: ${cardResult[i].cardFont};">${cardTextArry[4]}
                                                        </p>
                                                    <p class="futura_R"
                                                        style="transform: rotate(174.706deg); left: -0.927797px; top: 83.4881px; opacity: 1;font-family: ${cardResult[i].cardFont};">${cardTextArry[4]}
                                                        </p>
                                                    <p class="futura_R"
                                                        style="transform: rotate(153.529deg); left: 41.4886px; top: 71.4196px; opacity: 1;font-family: ${cardResult[i].cardFont};">${cardTextArry[4]}
                                                        </p>
                                                    <p class="futura_R"
                                                        style="transform: rotate(132.353deg); left: 76.6811px; top: 44.8435px; opacity: 1;font-family: ${cardResult[i].cardFont};">${cardTextArry[4]}
                                                        </p>
                                                    <p class="futura_R"
                                                        style="transform: rotate(111.176deg); left: 99.8967px; top: 7.349px; opacity: 1;font-family: ${cardResult[i].cardFont};">${cardTextArry[4]}
                                                        </p>
                                                    <p class="futura_R"
                                                        style="transform: rotate(90deg); left: 108px; top: -36px; opacity: 1;font-family: ${cardResult[i].cardFont};">${cardTextArry[4]}
                                                        </p>
                                                </div>
                                                <div class="circle circle5" style="transform: rotate(135deg); transform-origin: 50% 50%; color: ${cardResult[i].cardTextColor6};">
                                                    <p class="futura_R"
                                                        style="transform: rotate(422.308deg); left: 115.506px; top: -102.92px; opacity: 1;font-family: ${cardResult[i].cardFont};">${cardTextArry[5]}
                                                        </p>
                                                    <p class="futura_R"
                                                        style="transform: rotate(394.615deg); left: 69.8013px; top: -154.51px; opacity: 1;font-family: ${cardResult[i].cardFont};">${cardTextArry[5]}
                                                        </p>
                                                    <p class="futura_R"
                                                        style="transform: rotate(366.923deg); left: 5.35728px; top: -178.95px; opacity: 1;font-family: ${cardResult[i].cardFont};">${cardTextArry[5]}
                                                        </p>
                                                    <p class="futura_R"
                                                        style="transform: rotate(339.231deg); left: -63.0631px; top: -170.642px; opacity: 1;font-family: ${cardResult[i].cardFont};">${cardTextArry[5]}
                                                        </p>
                                                    <p class="futura_R"
                                                        style="transform: rotate(311.538deg); left: -119.786px; top: -131.49px; opacity: 1;font-family: ${cardResult[i].cardFont};">${cardTextArry[5]}
                                                        </p>
                                                    <p class="futura_R"
                                                        style="transform: rotate(283.846deg); left: -151.816px; top: -70.4615px; opacity: 1;font-family: ${cardResult[i].cardFont};">${cardTextArry[5]}
                                                        </p>
                                                    <p class="futura_R"
                                                        style="transform: rotate(256.154deg); left: -151.816px; top: -1.53854px; opacity: 1;font-family: ${cardResult[i].cardFont};">${cardTextArry[5]}
                                                        </p>
                                                    <p class="futura_R"
                                                        style="transform: rotate(228.462deg); left: -119.786px; top: 59.4897px; opacity: 1;font-family: ${cardResult[i].cardFont};">${cardTextArry[5]}
                                                        </p>
                                                    <p class="futura_R"
                                                        style="transform: rotate(200.769deg); left: -63.0631px; top: 98.6423px; opacity: 1;font-family: ${cardResult[i].cardFont};">${cardTextArry[5]}
                                                        </p>
                                                    <p class="futura_R"
                                                        style="transform: rotate(173.077deg); left: 5.35728px; top: 106.95px; opacity: 1;font-family: ${cardResult[i].cardFont};">${cardTextArry[5]}
                                                        </p>
                                                    <p class="futura_R"
                                                        style="transform: rotate(145.385deg); left: 69.8013px; top: 82.5097px; opacity: 1;font-family: ${cardResult[i].cardFont};">${cardTextArry[5]}
                                                        </p>
                                                    <p class="futura_R"
                                                        style="transform: rotate(117.692deg); left: 115.506px; top: 30.9201px; opacity: 1;font-family: ${cardResult[i].cardFont};">${cardTextArry[5]}
                                                        </p>
                                                    <p class="futura_R"
                                                        style="transform: rotate(90deg); left: 132px; top: -36px; opacity: 1;font-family: ${cardResult[i].cardFont};">${cardTextArry[5]}
                                                        </p>
                                                </div>
                                            </div>
                                        </div>      




                                        <h3 class="card_name">${cardResult[i].cardName}</h3>
                                        <div class="card_item_box">
                                            <div class="card_item card_item1">
                                                <div class="card_item_image">
                                                    <img src="${checkNull(cardResult[i].item1Img2Url)}">
                                                </div>
                                                <h4 class="card_item_name card_item_name1">${checkNull(cardResult[i].item1name)}</h4>
                                            </div>
                                            <div class="card_item card_item2">
                                                <div class="card_item_image">
                                                    <img src="${checkNull(cardResult[i].item2Img2Url)}">
                                                </div>
                                                <h4 class="card_item_name card_item_name2">${checkNull(cardResult[i].item2name)}</h4>
                                            </div>
                                            <div class="card_item card_item3">
                                                <div class="card_item_image">
                                                    <img src="${checkNull(cardResult[i].item3Img2Url)}">
                                                </div>
                                                <h4 class="card_item_name card_item_name3">${checkNull(cardResult[i].item3name)}</h4>
                                            </div>
                                            <div class="card_item card_item4">
                                                <div class="card_item_image">
                                                    <img src="${checkNull(cardResult[i].item4Img2Url)}">
                                                </div>
                                                <h4 class="card_item_name card_item_name4">${checkNull(cardResult[i].item4name)}</h4>
                                            </div>
                                            <div class="clear"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>`;
    }

    function checkNull(temp){
        if(!temp && typeof temp != "undefined" && temp != 0){
            // console.log(temp);
            return "";
        }else{
            // console.log(temp);
            return temp;
        }
    }

    document.getElementsByClassName("responsive")[0].innerHTML = cardInnerHtml;
    
    document.getElementsByClassName("responsive")[0].className = "responsive";
    $('.responsive').slick({
        dots: false,
        prevArrow: $('.prev'),
        nextArrow: $('.next'),
        infinite: false,
        speed: 300,
        slidesToShow: 3,
        slidesToScroll: 3,
        responsive: [
            {
            breakpoint: 1100,
            settings: {
                slidesToShow: 2,
                slidesToScroll: 2
            }
            },
            {
            breakpoint: 780,
            settings: {
                slidesToShow: 1,
                slidesToScroll: 1,
            }
            }
        ]
    });

    var totalA;
    var totalB;
    var totalC;
    var total;
    $('.card').click(function(){
        var cardNo = $(this).attr('cardno');
        $.ajax({
            url: './php/publish_radar_change.php',
            data: {cardNo:cardNo},
            type: 'GET',
            async: false,
            success: function(data){
                var dataJson = jQuery.parseJSON(data);
                // alert(data);
                totalA = parseInt(dataJson.item1pointA)+parseInt(dataJson.item2pointA)+parseInt(dataJson.item3pointA)+parseInt(dataJson.item4pointA); 
                totalB = parseInt(dataJson.item1pointB)+parseInt(dataJson.item2pointB)+parseInt(dataJson.item3pointB)+parseInt(dataJson.item4pointB);
                totalC = parseInt(dataJson.item1pointC)+parseInt(dataJson.item2pointC)+parseInt(dataJson.item3pointC)+parseInt(dataJson.item4pointC); 
                total = parseInt(totalA)+parseInt(totalB)+parseInt(totalC);
                $('#cardNo').val(cardNo); 
            },

            error: function(data){
            }
        });

        //定義變數
    
        var chartRadarDOM;
        var chartRadarDOM2;
        var chartRadarData;
        var chartRadarOptions;
        //載入雷達圖
        Chart.defaults.global.legend.display = false;
        Chart.defaults.global.defaultFontColor = 'rgba(0,0,74, 1)';
        chartRadarDOM = document.getElementById("chartRadar");
        chartRadarDOM2 = document.getElementById("chartRadar2");
        chartRadarDOM3 = document.getElementById("chartRadar3");
        chartRadarData;
        chartRadarOptions = 
        {   
            scale: 
            {
                ticks: 
                {
                    fontSize: 18,
                    beginAtZero: true,
                    maxTicksLimit: 7,
                    min:0,
                    max:1
                },
                pointLabels: //類別字
                {   
                    fontFamily: "pigmo",
                    fontSize: 21,
                    fontColor: ['rgba(221,125,29,1)', 'rgba(178,79,89,1)', 'rgba(106,145,45,1)']
                },
                gridLines: //網線
                {   

                    color: '#aaa',
                },
                legend:
                {
                },
            }
        };

        // console.log("---------Rader Data--------");
        var graphData =[parseFloat(totalA/total),parseFloat(totalB/total), parseFloat(totalC/total)];


        // console.log("--------Rader Create-------------");
        // console.log(graphData);
            
        //CreateData
        chartRadarData = {

            labels: ['舒筋活骨', '養顏美容', '安定心神'],
            datasets: [{
                // label: `療效`,
                backgroundColor: "rgba(250,180,0,.6)",
                borderColor: "rgba(225,225,225,.3)",
                pointBackgroundColor: ['rgba(221,125,29,.8)', 'rgba(178,79,89,.8)', 'rgba(106,145,45,.8)'],
                pointBorderColor: ['rgba(221,125,29,.8)', 'rgba(178,79,89,.8)', 'rgba(106,145,45,.8)'],
                pointHoverBackgroundColor: ['rgba(221,125,29,.8)', 'rgba(178,79,89,.8)', 'rgba(106,145,45,.8)'],
                pointHoverBorderColor: ['rgba(221,125,29,.8)', 'rgba(178,79,89,.8)', 'rgba(106,145,45,.8)'],
                pointBorderWidth: 10,
                pointHoverBorderWidth: 0,
                borderJoinStyle: 'round',
                fillColor: '#f00',
                data: graphData}]
        };
            
        //Draw
        var chartRadar = new Chart(chartRadarDOM, {
            type: 'radar',
            data: chartRadarData,
            options: chartRadarOptions
        });
        var chartRadar = new Chart(chartRadarDOM2, {
            type: 'radar',
            data: chartRadarData,
            options: chartRadarOptions
        });
        
    });

    //點選到的牌子給class 使其變色
    $('.card').click(function(){
        $(".card").removeClass("card_selected");
        $(this).addClass("card_selected");
        cardPriceTemp = this.getAttribute("cardPrice");
        // console.log(cardPriceTemp);

        document.querySelector("#lightbox .nextStepBtn_d").addEventListener("click",function(){//點完牌子後點選完成關閉燈箱
            if(temp_card == ""){
                document.getElementById("smallLightBox_wrapper").style.visibility = "visible";
                document.querySelector("#smallLightBox_wrapper h3").innerHTML = "還沒選擇湯牌哦!!!"
            }else{
                $("#lightbox_wrapper").css("visibility","hidden");
                $('body').css({//畫面恢復可滾動
                    "height":"auto",
                });
            }
        });
        
        temp_card = $(this).parent('.cards').html();//將點選到的牌子寫入temp
        // console.log(temp_card);
        if (window_width<=1200) {//不是桌機時
            $("#lightbox_radar_btn").css("display","block");//當card被點選 會開啟雷達btn
            $("#lightbox_radar_btn").click(function(){
                $("#lightbox_radar").css("display","block");//雷達btn被點選開啟雷達圖
            });
            $("#lightbox_radar_close").click(function(){
                $("#lightbox_radar").css("display","none");//點選關閉將雷達圖關閉
            });
    
        } 
          
        
    });

    document.querySelector("#lightbox .nextStepBtn_d").addEventListener("click",function(){
        if(temp_card == ""){
            document.getElementById("smallLightBox_wrapper").style.visibility = "visible";
            document.querySelector("#smallLightBox_wrapper h3").innerHTML = "還沒選擇湯牌哦!!!"
        }else{
            $('#add_card').html(temp_card);

            var xhr = new XMLHttpRequest();
            xhr.onreadystatechange = function(){
                if( xhr.readyState == 4){
                    if( xhr.status == 200 ){
                        cardTimeItem(xhr.responseText);
                    }else{
                        alert( xhr.status );
                    }
                }
            }

            var url = "php/yt_cardTimeItem.php?cardNo=" + document.querySelector(".springCard .card").getAttribute("cardNo");
            xhr.open("Get", url, true);
            xhr.send( null );

            function cardTimeItem(jsonStr){
                cardTimeItemValue = "";
                var cardTimeItemResult = JSON.parse(jsonStr);
                if(cardTimeItemResult == "notFound"){
                    document.querySelector(".calendar_top_box_left_d").style.visibility = "hidden";
                }else{
                    document.querySelector(".calendar_top_box_left_d").style.visibility = "visible";
                    document.querySelector(".calendar_top_box_left_d .herbsImg_d img").src = cardTimeItemResult.itemImg4Url;
                    document.querySelector(".herbsTitle").innerHTML = cardTimeItemResult.itemName;
                    if(cardTimeItemResult.itemTime == 1){
                        cardTimeItemValue = "1";
                    }else if(cardTimeItemResult.itemTime == 2){
                        cardTimeItemValue = "2";
                    }else if(cardTimeItemResult.itemTime == 3){
                        cardTimeItemValue = "3";
                    }
                    // console.log(cardTimeItemValue);
                }
                // console.log(cardTimeItemResult);
            }

            // console.log(document.querySelector(".springCard .card").getAttribute("cardNo"));
            
            // $('.springCard').css('display','none');
            
            if (window_width<=768) {
                // $('.selected_card_data').html(temp_card);
                // $('.selected_card_data').addClass('change_card');
                // $('.selected_card_data').css('margin-bottom','0px');
                // $('.forum_wrap .article_publish').css('padding-top','10px');
                // $('.change_card').click(lightboxOn);
                $("#lightbox_radar").css("display","none");
            }   
        }
    });
    // console.log(cardInnerHtml);
}