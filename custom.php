<?php
ob_start();
session_start();
$_SESSION["where"] = $_SERVER['REQUEST_URI'];
try{
    require_once("php/connectBooks.php");  
    // 時段限定藥材arr
    $sql = "select * from item where itemTime != 0 and itemStatus = 1 order by itemTime";
    $itemTime = $pdo->query($sql);    

    // 一般藥材arr
    $sql = "select * from item where itemTime = 0 and itemStatus = 1 order by effectTypeNo";
    $itemNormal = $pdo->query($sql);

    // 小百科arr
    $sql = "select * from item where itemStatus = 1 order by effectTypeNo";
    $itemAll = $pdo->query($sql);

    // 小百科arr2
    $sql = "select * from item where itemStatus = 1 order by effectTypeNo";
    $itemAll2 = $pdo->query($sql);

    }catch(PDOException $e){
    echo $e->getMessage();
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>湯先生 Mr.Spring - 客製湯頭</title>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
    <link rel="stylesheet" href="css/base.css">
    <link rel="stylesheet" href="css/share.css">
    <link rel="stylesheet" href="css/fonts.css">
    <link rel="stylesheet" href="css/slick-custom.css">
    <link rel="stylesheet" href="css/slick-theme.css">
    <link rel="stylesheet" href="css/colourpicker.css">
    <link rel="stylesheet" href="css/card.css">
    <link rel="stylesheet" href="css/custom.css">
    <link rel="stylesheet" href="css/circleCarousel.css">
    <link rel="stylesheet" href="css/signin.css">
    <link rel="stylesheet" href="css/header.css">    
    <script type="text/javascript" src="js/jquery-3.3.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/pixi.js/3.0.7/pixi.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/2.0.2/TweenMax.min.js"></script>
</head>
<style>
            /* *{
                outline: 2px solid red;
            } */
           

            @media screen and (max-width:1199px) and (min-width:992px){
               
            #memPic{
                position:fixed;
                right:20px;
            } 
            }
            #kasumi_top_container {
                position: absolute;
                /* top: 0; */
                bottom: 58px;
                left: 0;
                width: 100%;
                height: 100vh;
                z-index: 2;
                overflow: hidden;
                pointer-events: none;
                /* opacity: .4; */
                animation-name: fade ;
                animation-duration: 5s; 
                animation-fill-mode: forwards;
            }

            @keyframes fade{
                0%{opacity:0;}
                100%{opacity:.4;}
            }

            header #kasumi_top_container canvas {
                position: absolute;
                left: 0;
                bottom: 0;
                pointer-events: none;
            }
</style>
<body>
   
    
    <!-- 導覽列 -->
    <header>
        <nav id="nav_bar">
            <!-- <span id="memName"></span> -->


            <script src="js/g4CheckLogin.js"></script>
            
            
            <!-- <input type="hidden" name="memId" id="memId"> -->

            <ul id="banner">
                <a class="flag" href="custom.php">
                    <h2 class="headerNow">客製湯頭</h2>
                </a>
                <a class="flag" href="reservation.php">
                    <h2>預約訂房</h2>
                </a>
                <a class="flag" href="home.php">
                    <h1> <img id="mrSpringLogo_w" style="width:118.7px; " src="images/mrSpringLogo_W.svg" alt="湯先生">
                        <img id="mrSpringLogo" style="width:110px;" src="images/mrSpringLogo.svg" alt="湯先生"></h1>
                </a>
                <a class="flag" href="forum.php">
                    <h2>討論の區</h2>
                </a>
                <a class="flag" id="headerMemberLink">
                    <h2>會員専區</h2>
                </a>
            </ul>
        </nav>

        

        <div id="nav_wrapper">
            <h1 id="mt_logo">
                <a href="home.php"><img src="images/logoHorizon.svg" alt="Mr.Spring Logo"></a>
            </h1>
            <!-- <div class="nav_icon_wrap">
                <span class="loginTextWarp">
                     <span class="loginTextS" style="color:rgb(200, 169, 125);">登入</span>
                </span>
                <span class="spanLoginWrap">
                     <img id="spanLogin" src="images/account.png" alt="member">
                </span>-->
         

            <div class="button_container" id="toggle">
                <span class="top"></span>
                <span class="middle"></span>
                <span class="bottom"></span>
            </div>
        </div>

            <div id="memPic">
            <span id="loginHereWrap">
                <img id="LoginHere" src="images/account.svg" alt="會員登入" style=" margin:auto;">
             </span>
                <span id="loginText" style="color:rgb(200, 169, 125);">登入</span>
            </div>
        <div class="overlay" id="overlay">

            <nav class="overlay-menu">
                <ul>
                    <li><a href="home.php">Home</a></li>
                    <li><a href="custom.php">客製湯頭</a></li>
                    <li><a href="reservation.php">預約訂房</a></li>
                    <li><a href="forum.php">討論の區</a></li>
                    <li><a id="MobileHeaderMemberLink">會員専區</a></li>
                </ul>
            </nav>
        </div>

        <script src="js/headerMemberLink.js"></script>

        <script>
            $("#toggle").click(function () {
                $(this).toggleClass("action");
                $("#overlay").toggleClass("open");
            });
        </script>

    </header>
    
    <!-- 燈箱：登入 -->
    <div id="lightBox" style=" z-index: 1000; position:fixed; display:none;">

        <!-- 登入 -->
        <div id="login" class="table_wrap">
            
        <div style="text-align:center;">

                <!-- 登入logo -->
                <figure id="login_img" class="Login_pic">
                    <img src="images/Logo_browen.svg" alt="湯先生">
                </figure>

                <!-- 註冊大頭貼 -->
                <form id="signin_img" class="Login_pic" enctype="multipart/form-data" action="signinUpload.php" method="post">
                    <label class="signin_label">
                        <input type="file" name="memUpFile" id="upFile" >
                        <div class="imgPreview"><img id="imgPreview" src="images/Logo_browen.svg" alt="上傳檔案">
                            <i class="fas fa-camera"></i></div>
                    </label>
        </div>

            <!--瀏覽上傳的圖片  -->
            <script type="text/javascript">
                $('#upFile').change(function () {
                    var file = $('#upFile')[0].files[0];
                    var reader = new FileReader;
                    reader.onload = function (e) {
                        $('#imgPreview').attr('src', e.target.result);
                    };
                    reader.readAsDataURL(file);
                });

            </script>


            <div style="text-align:center;">
                <p id="login_test" class="Login_title">會員登入</p>
                </div>
            <div id="t1">
                <table  id="tableLogin" class="table_data">

                    <tr>
                        <td>
                            <label>帳號</label>
                            <input type="text" id="memId" name="memId"  placeholder="example123">
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label>密碼</label>
                            <input type="password" id="memPsw" name="memPsw" placeholder="******">
                        </td>
                    </tr>
                </table>
            </div>

            <div id="t2">
                <table   id="table_signin" class="table_data">
                    
                    <tr>
                        <td>
                            <label>帳號</label>
                            <input type="text" id="memId_s" name="memId_s" placeholder="輸入2~10英數字" maxlength="10"
                                minlength="2" autocomplete="off"  pattern="[A-z0-9]{2-10}">
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label>密碼</label>
                            <input type="password" id="memPsw_s" name="memPsw_s" placeholder="******" maxlength="10"
                                autocomplete="off" >
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label>姓氏</label>
                            <input type="text" name="memFirstName" id="memLastName" placeholder="湯" maxlength="10"
                                autocomplete="off" >
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <label>名字</label>
                            <input type="text" name="memLastName" id="memFirstName" placeholder="生生" maxlength="10"
                                autocomplete="off" >
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <label>暱稱</label>
                            <input type="text" name="memNickname" id="memNickname" placeholder="我是湯先生" maxlength="10"
                                autocomplete="off" >
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <label>身分證</label>
                            <input type="text" name="twId" id="twId" placeholder="S123456789" maxlength="10"
                                autocomplete="off" >
                        </td>
                    </tr>

                    
                    <tr>
                        <td>
                            <label>信箱</label>
                            <input type="email" name="memEmail" id="memEmail" placeholder="mrspring@email.com"
                                autocomplete="off" >
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label>電話</label>
                            <input type="tel" name="memTel" id="memTel" placeholder="0912345678" maxlength="10"
                                autocomplete="off" >
                        </td>
                    </tr>
                </table>
            </div>

            <div class="btn_wrap">
            <div style="text-align:center;">
            <input type="button" name="login" for="form_table" class="btn_s btnLogin" id="btnLogin" value="登入"
                        style="color:rgb(112, 95, 69); border:1.5px solid rgb(145, 123, 91);">
                    <input type="submit" name="sign" for="signin_img" class="btn_s btnLogin" id="btn_signin" value="送出"
                        style="color:rgb(112, 95, 69);margin:auto; border:1.5px solid rgb(145, 123, 91);">
            </form>
                    

<script>
    
    $('input').keydown(function(e) {
    code = e.keyCode; // in case of browser compatibility
    // console.log(code );
    if(code == 13) {
        e.preventDefault();
        // do something
        /* also can use return false; instead. */
        }
    });
                        
</script>
                <!-- <span>登入</span> -->
                    
                    <button class="btn_s" id="btnLoginCancel" value="取消">
                        <div class="x_x">
                            <span class="top"></span>
                            <span class="bottom"></span>
                        </div>
                    </button>
                    </div>
            </div>
            <div style="text-align:center;">
                <button type="button" id="test_btn" class="first_time" onclick="memberFunction()">還沒申請帳號?</button>
            </div>
        </div>

        <!-- 登入後點頭像的燈箱============================================================================ -->

        
        
    </div>

    <div>



    </div>
    <div id="gowhere"style="display:none;">
        <div id="gowhere_container">
        
            <div style="text-align:center;">
                    <p id="login_test" class="Login_title">去哪兒?</p>
            </div>


            <div class="btn_wrap">
                <div style="text-align:center;">
                    <input type="button" name="login" for="form_table" class="btn_s btnLogin" id="btnLoginAfter"
                        value="去會員專區" style="color:rgb(112, 95, 69); border:1.5px solid rgb(145, 123, 91);">
                    <input type="button" name="sign" for="signin_img" class="btn_s btnLogin" id="btn_signinAfter"
                        value="登出"
                        style="color:rgb(112, 95, 69);margin:auto; border:1.5px solid rgb(145, 123, 91);">
                    


                    <!-- <script>
                        document.getElementById("btn_signin").onclick= function(){
                            document.getElementById("signin_img").submit();
                        }
                    </script> -->
                    <!-- <span>登入</span> -->

                    <button class="btn_s" id="btnLoginCancelAfter" value="取消">
                        <div class="x_x">
                            <span class="top"></span>
                            <span class="bottom"></span>
                        </div>
                    </button>
                </div>
            </div>
        </div>
          
    </div>

    <!-- 登入js -->
        <script>
            function memberFunction() {
                var w = document.getElementById('btnLogin');
                w.innerHTML = "註冊"
                var x = document.getElementById('login_test');
                x.innerHTML = "會員註冊";
                var y = document.getElementById('test_btn');
                // y.innerHTML = "已經有帳號了？";
                if (y.innerHTML == '已經有帳號了？') {
                    y.innerHTML = '還沒申請帳號?';
                    x.innerHTML = "會員登入";
                    // w.innerHTML = "登入";
                    document.getElementById('t2').style.display = 'none';
                    document.getElementById('t1').style.display = 'block';
                    document.getElementById('signin_img').style.display = 'none';
                    document.getElementById('login_img').style.display = 'block';
                    document.getElementById('btnLogin').style.display = 'block';
                    document.getElementById('btn_signin').style.display = 'none';

                } else {
                    y.innerHTML = "已經有帳號了？";
                    document.getElementById('t2').style.display = 'block';
                    document.getElementById('t1').style.display = 'none';
                    document.getElementById('signin_img').style.display = 'block';
                    document.getElementById('login_img').style.display = 'none';
                    document.getElementById('btnLogin').style.display = 'none';
                    document.getElementById('btn_signin').style.display = 'block';
                }
            }
        </script>
    

    <!-- 登入的SESSION -->
    <script>
    function $id(id){
    	return document.getElementById(id);
    }	
        function showLoginForm(){
          //檢查登入bar面版上 spanLogin 的字是登入或登出
          //如果是登入，就顯示登入用的燈箱(lightBox)
          //如果是登出
          //將登入bar面版上，登入者資料清空 
          //spanLogin的字改成登入
          //將頁面上的使用者資料清掉
          
          if($id('loginText').innerHTML == "登入"){
            $id('lightBox').style.display = 'block';
            $id("LoginHere").src = "images/account.svg";
            $id("LoginHere").style.width = "100%";
          }else{ //確認是否登出
            $id('gowhere').style.display = 'block';
            $id('btnLoginAfter').onclick = G4goMember;
            $id('btn_signinAfter').onclick = G4LogOut;
            function G4goMember(){
                location.href = "member.php";
            }

            function G4LogOut(){
                $id('loginText').innerHTML = '登入';
                $id("LoginHere").src = "images/account.svg";
                $id("LoginHere").style.width = "100%";
                //清session的資料
                var xhr = new XMLHttpRequest();
                xhr.onload = function(){  //這裡若没有要做什麼事，可以不寫
                  if( xhr.status == 200){
                    // alert(xhr.responseText); 
                  }
                }
                xhr.open("get", "php/loginOut.php",true);
                xhr.send(null);
                $id('gowhere').style.display = 'none';
                location.href = `${location.href}`;
            }
            
          }

        }//showLoginForm

        function sendForm(){
          //=====使用Ajax 回server端,取回登入者姓名, 放到頁面上    
          var xhr = new XMLHttpRequest();
          xhr.onload = function(){
            // console.log(123);
            if(xhr.status == 200){
              if( xhr.responseText == "notFound"){
                alert("帳密錯誤");
              }else{
                // $id("memName").innerHTML = memInfo.memFirstName;
                // $id('loginText').innerHTML = "登出";
                console.log(xhr.responseText)
                $id("LoginHere").src = xhr.responseText;
                $id("loginText").innerHTML = "登出";
                $id("LoginHere").style.width = "100%";
                $id("loginHereWrap").style.borderColor = "rgb(200, 169, 125)";
                // $id("LoginHere").style.position = "absolute";
                 
              }
            }else{
              alert(xhr.status);
            }
          }
          xhr.open("post", "php/afterLogin.php", true);
          xhr.setRequestHeader("content-type","application/x-www-form-urlencoded");
          var data_info = "memId=" + $id("memId").value + "&memPsw=" + $id("memPsw").value;
          xhr.send(data_info);


          //將登入表單上的資料清空，並隱藏起來
          $id('lightBox').style.display = 'none';
          $id('memId').value = '';
          $id('memPsw').value = '';

        }

        function cancelLogin(){
          //將登入表單上的資料清空，並將燈箱隱藏起來
          $id('lightBox').style.display = 'none';
          $id('memId').value = '';
          $id('memPsw').value = '';
        //   $id("loginHereWrap").style.border = "unset";
        }

        
        function cancelLogOut(){
          //將登入表單上的資料清空，並將燈箱隱藏起來
          $id('gowhere').style.display = 'none';
        }


    window.addEventListener("load", function(){
       //初始化網頁....
        //.....取登入者資訊
        // var xhr = new XMLHttpRequest();
        // xhr.onload = function(){
        //   if( xhr.status == 200){
        //     if( xhr.responseText != "notFound"){ //已登入
        //     //   $id("memName").innerHTML = xhr.responseText;
        //       $id("loginText").innerHTML = "登出";
        //       $id("LoginHere").style.width = "50px";
        //       $id("loginHereWrap").style.borderColor = "rgb(200, 169, 125)";
        //     }
        //   }
        // }
        // xhr.open("get", "php/afterLogin.php", true);
        // xhr.send(null);  

        //註冊事件處理器....
        //===設定spanLogin.onclick 事件處理程序是 showLoginForm

        $id('memPic').onclick = showLoginForm;

        //===設定btnLogin.onclick 事件處理程序是 sendForm
        $id('btnLogin').onclick = sendForm;

        //===設定btnLoginCancel.onclick 事件處理程序是 cancelLogin
        $id('btnLoginCancel').onclick = cancelLogin;

        $id("btnLoginCancelAfter").onclick=cancelLogOut;

    })  

    </script>

    <!-- 藥材挑選 -->
    <section id="scrCustom">

        <!-- 客製挑選屏 -->
        <div id="customWrapper">
            <!-- mobile切換按鈕-客製用 -->
            <div class="switchBar switchBarCustom">
                <span id="goWikiBtn">藥材小百科</span>
                <span class="scr_now">客製湯頭</span>
            </div>
            <!-- 雷達及資訊容器 -->
            <div id="items_info_wrapper_forflex">
                <div id="items_info_wrapper">
                    <div id="radar_wrapper">
                        <p id="radar_title">目前療效</p>
                        <canvas id="chartRadar" width="300" height="300"></canvas>
                    </div>
                    <p id="title_price">目前所選藥材價格：
                        <span id="total_price">0 元</span>
                    </p>
                    <p id="title_amount">最多可選 4 項藥材，您目前已選擇：
                        <span id="total_amount">0 項</span>
                    </p>
                </div>
                <!-- 選擇完成按鈕-769以上 -->
                <div id="btn_wrapper_forflex">
                    <button id="btnSubmitItems">選擇完成</button>
                </div>  
            </div>

            <!-- 可選藥材清單 -->
            <form id="items_input">
                <h3>時段限定藥材</h3>
                <div class="items_time">
                <?php
                while( $itemTimeRow = $itemTime->fetch(PDO::FETCH_ASSOC) ){
                ?>
                    <input type="checkbox" value="<?php echo $itemTimeRow["itemNo"]?>" name="items" id="item<?php echo $itemTimeRow["itemNo"]?>" data-price="<?php echo $itemTimeRow["itemPrice"]?>" data-pointa="<?php echo $itemTimeRow["pointA"]?>" data-pointb="<?php echo $itemTimeRow["pointB"]?>" data-pointc="<?php echo $itemTimeRow["pointC"]?>" data-color="<?php echo $itemTimeRow["itemColor"]?>">
                    <label for="item<?php echo $itemTimeRow["itemNo"]?>">
                        <img src="<?php echo $itemTimeRow["itemImg2Url"]?>" alt="<?php echo $itemTimeRow["itemName"]?>">
                        <p><?php echo $itemTimeRow["itemName"]?></p>
                        <span class="item_time_tag time_<?php echo $itemTimeRow["itemTime"]?>"><?php switch($itemTimeRow["itemTime"]){case '1': echo '早'; break;case '2': echo '午'; break;case '3': echo '晚'; break;}?></span>
                    </label>
                <?php
                }
                ?>                    
                </div>

                <h3>一般藥材</h3>
                <div class="items_normal">
                <?php
                while( $itemNormalRow = $itemNormal->fetch(PDO::FETCH_ASSOC)){                
                ?>

                    <div>
                        <input type="checkbox" value="<?php echo $itemNormalRow["itemNo"]?>" name="items" id="item<?php echo $itemNormalRow["itemNo"]?>" data-price="<?php echo $itemNormalRow["itemPrice"]?>" data-pointa="<?php echo $itemNormalRow["pointA"]?>" data-pointb="<?php echo $itemNormalRow["pointB"]?>" data-pointc="<?php echo $itemNormalRow["pointC"]?>" data-color="<?php echo $itemNormalRow["itemColor"]?>">
                        <label for="item<?php echo $itemNormalRow["itemNo"]?>">
                            <img src="<?php echo $itemNormalRow["itemImg2Url"]?>" alt="<?php echo $itemNormalRow["itemName"]?>">
                            <p><?php echo $itemNormalRow["itemName"]?></p>
                        </label>
                    </div>

                <?php
                }
                ?>
                </div>
            </form> 

            <!-- 選擇完成按鈕-768以下 --> 
            <div id="btn_wrapper_formobile">
                <button id="btnSubmitItems_formobile">選擇完成</button>
            </div>           
        </div>
   
        <!-- 桌機等待中湯先生圖片 -->
        <img id="mrSpringStand" src="./images/MrSpringStand.png" alt="湯先生等待中">
        
        <!-- 桌機漸層湯水 -->     
        <div id="bottomWave">
            <img id="mrSpringBath" src="./images/MrSpringBath.png" alt="湯先生泡湯">
        </div>

        <!-- footer -->
        <div class="all_rights">
            <h4>Non commercial use&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Copyright © 2019 Mr.Spring All rights
                reserved</h4>
        </div>
    </section>

    <!-- 藥材百科 -->
    <!-- pc百科黑底 -->
    <div id="mask"></div>
    <!-- pc百科拉出按鈕 -->
    <div id="btnShowWiki">
        <div id="btnSpace"></div>
        <span>藥材小百科</span>
        <div id="btnRightTri"></div>
    </div>

    <section id="scrWiki">
        <!-- pc百科收起按鈕 -->
        <div id="btnCloseWiki">
            <div id="btnSpace2"></div>
            <span>收回小百科</span>
            <div id="btnLeftTri"></div>
        </div>

        <!-- 藥材百科容器 -->
        <div id="wikiWrapper" class="holderCircle">
            <!-- mobile切換按鈕-百科用 -->
            <div class="switchBar switchBarCustom">
                <span class="scr_now">藥材小百科</span>
                <span id="goCustomBtn">客製湯頭</span>
            </div>

            <!-- 小百科-資訊 -->
            <div id="wikiInfo" class="wikiInfo contentCircle">
                <?php
                $i = 0;
                while($itemAllRow = $itemAll->fetch()){
                    $i ++;
                ?>
                <div class="CirItem <?php if($i==1){echo 'active CirItem'.$i;}else{echo 'CirItem'.$i;}?>">
                    <h3><?php echo $itemAllRow["itemName"]?></h3>
                    <p><?php echo $itemAllRow["itemText"]?></p>
                    <img src="<?php echo $itemAllRow["itemImg3Url"]?>" alt="<?php echo $itemAllRow["itemName"]?>">
                </div>
                <?php
                }
                ?>
            </div>

            <!-- 小百科-導覽 -->
            <div id="wikiNav" class="wikiNav dotCircle">
                <?php
                $j = 0;
                while($itemAll2Row = $itemAll2->fetch()){
                    $j ++;
                ?>

                <div class="itemDot <?php if($j==1){echo 'active itemDot'.$j;}else{echo 'itemDot'.$j;}?>" data-tab="<?php echo $j ?>">
                    <img src="<?php echo $itemAll2Row["itemImg1Url"]?>" alt="<?php echo $itemAll2Row["itemName"]?>">
                    <span class="forActive"></span>
                </div>

                <?php
                }
                ?>
            </div>
        </div>

        <!-- footer -->
        <div class="all_rights">
            <h4>Non commercial use&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Copyright © 2019 Mr.Spring All rights
                reserved</h4>
        </div>
    </section>

    <!-- 湯牌製作燈箱 -->
    <section id="scrCardLightbox">
        <div id="lightboxContent">
            <div id="lightboxToggle"></div>
            <h3>製成我的專屬湯牌</h3>
            <div id="dashboard">
                <div id="options">
                    <div class="inputSet titleInputSet">
                        <div class="option">湯牌標題<span></span></div>
                        <div class="cardInputWrapper">
                            <input type="text" placeholder="請輸入10字以內文字" id="cardTitleInput" maxlength="10">
                        </div>
                    </div>
                    <div class="inputSet textInputSet">
                        <div class="option">徽章文字<span></span></div>
                        <div class="cardInputWrapper">
                            <input type="text" placeholder="請輸入1-6個英數字" id="cardTextInput" maxlength="6" oninput="value=value.replace(/[^\w\.\/]/ig,'')" >
                        </div>
                    </div>
                    <div class="inputSet fontInputSet">
                        <div class="option">徽章字體<span></span></div>
                        <div class="cardInputWrapper">
                            <select id="cardFontSelect">
                                <option value="Times New Roman" id="font0" >Times New Roman</option>
                                <option value="Tahoma" id="font1">Tahoma</option>
                                <option value="Arial" id="font2">Arial</option>
                                <option value="Verdana" id="font3">Verdana</option>
                                <option value="Microsoft JhengHei" id="font4">微軟正黑體</option>
                                <option value="Candara" id="font5">Candara</option>
                            </select>
                        </div>
                    </div>
                    <div class="inputSet colorInputSet">
                        <div class="option">文字顏色<span></span></div>
                        <div class="cardInputWrapper">
                            <input type="colour" class="colourpicker_input" value="rgba(0,0,0)" id="colourpicker_1">
                            <input type="colour" class="colourpicker_input" value="rgba(0,0,0)" id="colourpicker_2">
                            <input type="colour" class="colourpicker_input" value="rgba(0,0,0)" id="colourpicker_3">
                            <input type="colour" class="colourpicker_input" value="rgba(0,0,0)" id="colourpicker_4">
                            <input type="colour" class="colourpicker_input" value="rgba(0,0,0)" id="colourpicker_5">
                            <input type="colour" class="colourpicker_input" value="rgba(0,0,0)" id="colourpicker_6">
                        </div>
                    </div>
                </div>
            </div>
            <div class="card card1 zoom_in">
                <img class="knot" src="./images/red_knot.png">
                <div class="front">                    
                    <div class="draw">
                        <div class="drawingArea" style="display: block;">
                            <div class="circle circle0" style="transform: rotate(120deg); transform-origin: 50% 50%; ">
                                <p class="futura_R"
                                    style="transform: rotate(378deg); left: -4.58359px; top: -58.8254px; opacity: 1;">
                                    </p>
                                <p class="futura_R"
                                    style="transform: rotate(306deg); left: -31.4164px; top: -50.1068px; opacity: 1;">
                                    </p>
                                <p class="futura_R"
                                    style="transform: rotate(234deg); left: -31.4164px; top: -21.8932px; opacity: 1;">
                                    </p>
                                <p class="futura_R"
                                    style="transform: rotate(162deg); left: -4.58359px; top: -13.1746px; opacity: 1;">
                                    </p>
                                <p class="futura_R"
                                    style="transform: rotate(90deg); left: 12px; top: -36px; opacity: 1;">
                                    </p>
                            </div>
                            <div class="circle circle1" style="transform: rotate(123deg); transform-origin: 50% 50%; ">
                                <p class="futura_R"
                                    style="transform: rotate(330deg); left: -36px; top: -77.5692px; opacity: 1;">
                                    </p>
                                <p class="futura_R"
                                    style="transform: rotate(210deg); left: -36px; top: 5.56922px; opacity: 1;">
                                    </p>
                                <p class="futura_R"
                                    style="transform: rotate(90deg); left: 36px; top: -36px; opacity: 1;">
                                    </p>
                            </div>
                            <div class="circle circle2" style="transform: rotate(126deg); transform-origin: 50% 50%; ">
                                    <p class="futura_R"
                                        style="transform: rotate(417.273deg); left: 48.5703px; top: -74.9261px; opacity: 1;">
                                        </p>
                                    <p class="futura_R"
                                        style="transform: rotate(384.545deg); left: 17.9099px; top: -101.494px; opacity: 1;">
                                        </p>
                                    <p class="futura_R"
                                        style="transform: rotate(351.818deg); left: -22.2467px; top: -107.267px; opacity: 1;">
                                        </p>
                                    <p class="futura_R"
                                        style="transform: rotate(319.091deg); left: -59.15px; top: -90.414px; opacity: 1;">
                                        </p>
                                    <p class="futura_R"
                                        style="transform: rotate(286.364deg); left: -81.0835px; top: -56.2847px; opacity: 1;">
                                        </p>
                                    <p class="futura_R"
                                        style="transform: rotate(253.636deg); left: -81.0835px; top: -15.7153px; opacity: 1;">
                                        </p>
                                    <p class="futura_R"
                                        style="transform: rotate(220.909deg); left: -59.15px; top: 18.414px; opacity: 1;">
                                        </p>
                                    <p class="futura_R"
                                        style="transform: rotate(188.182deg); left: -22.2467px; top: 35.2671px; opacity: 1;">
                                        </p>
                                    <p class="futura_R"
                                        style="transform: rotate(155.455deg); left: 17.9099px; top: 29.4935px; opacity: 1;">
                                        </p>
                                    <p class="futura_R"
                                        style="transform: rotate(122.727deg); left: 48.5703px; top: 2.92614px; opacity: 1;">
                                        </p>
                                    <p class="futura_R"
                                        style="transform: rotate(90deg); left: 60px; top: -36px; opacity: 1;">
                                        </p>
                            </div>
                            <div class="circle circle3" style="transform: rotate(129deg); transform-origin: 50% 50%; ">
                                    <p class="futura_R"
                                        style="transform: rotate(398.571deg); left: 47.855px; top: -111.056px; opacity: 1;">
                                        </p>
                                    <p class="futura_R"
                                        style="transform: rotate(347.143deg); left: -33.362px; top: -129.593px; opacity: 1;">
                                        </p>
                                    <p class="futura_R"
                                        style="transform: rotate(295.714deg); left: -98.493px; top: -77.6528px; opacity: 1;">
                                        </p>
                                    <p class="futura_R"
                                        style="transform: rotate(244.286deg); left: -98.493px; top: 5.65284px; opacity: 1;">
                                        </p>
                                    <p class="futura_R"
                                        style="transform: rotate(192.857deg); left: -33.362px; top: 57.5931px; opacity: 1;">
                                        </p>
                                    <p class="futura_R"
                                        style="transform: rotate(141.429deg); left: 47.855px; top: 39.0558px; opacity: 1;">
                                        </p>
                                    <p class="futura_R"
                                        style="transform: rotate(90deg); left: 84px; top: -36px; opacity: 1;">
                                        </p>
                            </div>
                            <div class="circle circle4" style="transform: rotate(132deg); transform-origin: 50% 50%; ">
                                <p class="futura_R"
                                    style="transform: rotate(428.824deg); left: 99.8967px; top: -79.349px; opacity: 1;">
                                    </p>
                                <p class="futura_R"
                                    style="transform: rotate(407.647deg); left: 76.6811px; top: -116.843px; opacity: 1;">
                                    </p>
                                <p class="futura_R"
                                    style="transform: rotate(386.471deg); left: 41.4886px; top: -143.42px; opacity: 1;">
                                    </p>
                                <p class="futura_R"
                                    style="transform: rotate(365.294deg); left: -0.927797px; top: -155.488px; opacity: 1;">
                                    </p>
                                <p class="futura_R"
                                    style="transform: rotate(344.118deg); left: -44.8396px; top: -151.419px; opacity: 1;">
                                    </p>
                                <p class="futura_R"
                                    style="transform: rotate(322.941deg); left: -84.3162px; top: -131.762px; opacity: 1;">
                                    </p>
                                <p class="futura_R"
                                    style="transform: rotate(301.765deg); left: -114.026px; top: -99.1719px; opacity: 1;">
                                    </p>
                                <p class="futura_R"
                                    style="transform: rotate(280.588deg); left: -129.957px; top: -58.0499px; opacity: 1;">
                                    </p>
                                <p class="futura_R"
                                    style="transform: rotate(259.412deg); left: -129.957px; top: -13.9501px; opacity: 1;">
                                    </p>
                                <p class="futura_R"
                                    style="transform: rotate(238.235deg); left: -114.026px; top: 27.1719px; opacity: 1;">
                                    </p>
                                <p class="futura_R"
                                    style="transform: rotate(217.059deg); left: -84.3162px; top: 59.7621px; opacity: 1;">
                                    </p>
                                <p class="futura_R"
                                    style="transform: rotate(195.882deg); left: -44.8396px; top: 79.4191px; opacity: 1;">
                                    </p>
                                <p class="futura_R"
                                    style="transform: rotate(174.706deg); left: -0.927797px; top: 83.4881px; opacity: 1;">
                                    </p>
                                <p class="futura_R"
                                    style="transform: rotate(153.529deg); left: 41.4886px; top: 71.4196px; opacity: 1;">
                                    </p>
                                <p class="futura_R"
                                    style="transform: rotate(132.353deg); left: 76.6811px; top: 44.8435px; opacity: 1;">
                                    </p>
                                <p class="futura_R"
                                    style="transform: rotate(111.176deg); left: 99.8967px; top: 7.349px; opacity: 1;">
                                    </p>
                                <p class="futura_R"
                                    style="transform: rotate(90deg); left: 108px; top: -36px; opacity: 1;">
                                    </p>
                            </div>
                            <div class="circle circle5" style="transform: rotate(135deg); transform-origin: 50% 50%; ">
                                <p class="futura_R"
                                    style="transform: rotate(422.308deg); left: 115.506px; top: -102.92px; opacity: 1;">
                                    </p>
                                <p class="futura_R"
                                    style="transform: rotate(394.615deg); left: 69.8013px; top: -154.51px; opacity: 1;">
                                    </p>
                                <p class="futura_R"
                                    style="transform: rotate(366.923deg); left: 5.35728px; top: -178.95px; opacity: 1;">
                                    </p>
                                <p class="futura_R"
                                    style="transform: rotate(339.231deg); left: -63.0631px; top: -170.642px; opacity: 1;">
                                    </p>
                                <p class="futura_R"
                                    style="transform: rotate(311.538deg); left: -119.786px; top: -131.49px; opacity: 1;">
                                    </p>
                                <p class="futura_R"
                                    style="transform: rotate(283.846deg); left: -151.816px; top: -70.4615px; opacity: 1;">
                                    </p>
                                <p class="futura_R"
                                    style="transform: rotate(256.154deg); left: -151.816px; top: -1.53854px; opacity: 1;">
                                    </p>
                                <p class="futura_R"
                                    style="transform: rotate(228.462deg); left: -119.786px; top: 59.4897px; opacity: 1;">
                                    </p>
                                <p class="futura_R"
                                    style="transform: rotate(200.769deg); left: -63.0631px; top: 98.6423px; opacity: 1;">
                                    </p>
                                <p class="futura_R"
                                    style="transform: rotate(173.077deg); left: 5.35728px; top: 106.95px; opacity: 1;">
                                    </p>
                                <p class="futura_R"
                                    style="transform: rotate(145.385deg); left: 69.8013px; top: 82.5097px; opacity: 1;">
                                    </p>
                                <p class="futura_R"
                                    style="transform: rotate(117.692deg); left: 115.506px; top: 30.9201px; opacity: 1;">
                                    </p>
                                <p class="futura_R"
                                    style="transform: rotate(90deg); left: 132px; top: -36px; opacity: 1;">
                                    </p>
                            </div>
                        </div>
                    </div>
                    <h3 class="card_name">(湯牌標題)</h3>
                    <div class="card_item_box">
                        <div class="card_item card_item1">
                            <div class="card_item_image">
                                <img src="./images/item2_2.png">
                            </div>
                            <h4 class="card_item_name"></h4>
                        </div>
                        <div class="card_item card_item2">
                            <div class="card_item_image">
                                <img src="./images/item3_1.png">
                            </div>
                            <h4 class="card_item_name"></h4>
                        </div>
                        <div class="card_item card_item3">
                            <div class="card_item_image">
                                <img src="./images/item1_2.png">
                            </div>
                            <h4 class="card_item_name"></h4>
                        </div>
                        <div class="card_item card_item4">
                            <div class="card_item_image">
                                <img src="./images/item3_3.png">
                            </div>
                            <h4 class="card_item_name"></h4>
                        </div>
                        <div class="clear"></div>
                    </div>
                </div>
            </div>

            <!-- 選擇完成按鈕 -->
            <div id="btnSubmitCardWrapper">
                <button id="btnSubmitCard">製作完成</button>
            </div>
        </div>
    </section>

    <!-- 製作完成燈箱 -->
    <section id="scrSubmitLightbox">
        <div id="submitLightboxContent">
            <h3>湯牌製作成功！</h3>
            <div class="submitLightboxLinkSet">
                <i class="far fa-user-circle"></i>
                <p>前往查看您的湯牌</p>
                <a class="lightboxLinks" href="member.php">會員專區</a>
            </div>
            <div class="submitLightboxLinkSet">
                <i class="far fa-calendar-plus"></i>
                <p>使用湯牌預定湯屋</p>
                <a class="lightboxLinks" href="reservation.php">預約訂房</a>
            </div>
            <div class="submitLightboxLinkSet">
                <i class="far fa-edit"></i>
                <p>再次製作新的專屬湯牌</p>
                <button class="lightboxLinks" id="newCardBtn">繼續製作</button>
            </div>
        </div>
    </section>

    <!-- 欄位驗證燈箱 -->
    <section id="alertLightbox">
        <div id="alertLightboxToggle"></div>
        <span>我是燈箱提示文字</span>
    </section>
    <div id="kasumi_top_container"></div>
</body>
<script type="text/javascript" src="js/jquery-3.3.1.min.js"></script>
<script type="text/javascript" src="js/card.js"></script>
<script type="text/javascript" src="js/Chart.js"></script>
<script type="text/javascript" src="js/radar.js"></script>
<script type="text/javascript" src="js/slick.js"></script>
<script type="text/javascript" src="js/tinycolor.js"></script>
<script type="text/javascript" src="js/colourpicker.full.js"></script>
<script type="text/javascript" src="js/kale.js"></script>
<script type="text/javascript" src="js/header.js"></script>
<script type="text/javascript" src="js/kasumi_custom.js"></script>
<script>    

    // 提示文字用燈箱關閉
    document.getElementById("alertLightboxToggle").addEventListener("click",function(){
        document.getElementById("alertLightbox").style.display = "none";
        document.getElementById("mask").style.display= "none";
    })

    // 桌機 小百科打開按鈕
    document.getElementById("btnShowWiki").addEventListener("click",function(){
        document.getElementById("scrWiki").style.left = `0`;
        document.getElementById("mask").style.display = `block`;
        this.style.display = `none`;
        document.getElementById("btnCloseWiki").style.display = `flex`;
    })

    // 桌機 小百科收起按鈕
    document.getElementById("btnCloseWiki").addEventListener("click",function(){
        document.getElementById("scrWiki").style.left = `-100vw`;
        document.getElementById("mask").style.display = `none`;
        this.display = `none`;
        setTimeout(function(){document.getElementById("btnShowWiki").style.display = `flex`}, 900);
    })

    itemsPickArr = document.querySelectorAll('#items_input input');

    // 時段限定藥材限制單選
    function itemTimeInputCkd(){
        timeItemArr = document.querySelectorAll('.items_time input');
        for(i=0;i<timeItemArr.length;i++){
            if(timeItemArr[i] !== this){
                timeItemArr[i].checked = false;
            }
        }
    }

    var sumA = 0;
    var sumB = 0;
    var sumC = 0;
    // 藥材選項事件
    function itemChange(){
        // 計數器
        totalAmount = 0;

        // 藥材選取換圖
        for(i=0;i<itemsPickArr.length;i++){
            if(itemsPickArr[i].checked==true){
                totalAmount ++;
                //藥材圖片改變
                document.querySelectorAll('#items_input img')[i].src = document.querySelectorAll('#items_input img')[i].src.replace('-s','-c');
            }else{
                document.querySelectorAll('#items_input img')[i].src = document.querySelectorAll('#items_input img')[i].src.replace('-c','-s');
            }
        }
        
        // 更改選擇數目
        document.getElementById('total_amount').innerText = `${totalAmount} 項`;
        
        //選取4項時，將其他按鈕disabled
        if(totalAmount == 4){
            for(i=0;i<itemsPickArr.length;i++){
                if(itemsPickArr[i].checked==false){
                    itemsPickArr[i].disabled=true;
                }
            }
        }else{
            for(i=0;i<itemsPickArr.length;i++){
                itemsPickArr[i].disabled=false;
            }
        }

        // 更改合計價格
        totalPrice = 0;
        for(i=0;i<itemsPickArr.length;i++){
            if(itemsPickArr[i].checked==true){
                totalPrice += parseInt(itemsPickArr[i].dataset.price);
            }
        }
        document.getElementById('total_price').innerText = `${totalPrice} 元`;

        // 雷達變動
        sumA = 0;
        sumB = 0;
        sumC = 0;
        sumTotal = 0;
        for(i=0;i<document.querySelectorAll('#items_input input').length;i++){
            if(document.querySelectorAll('#items_input input')[i].checked==true){
                sumA += parseInt(document.querySelectorAll('#items_input input')[i].dataset.pointa);
                sumB += parseInt(document.querySelectorAll('#items_input input')[i].dataset.pointb);
                sumC += parseInt(document.querySelectorAll('#items_input input')[i].dataset.pointc);
            }
        }
        sumTotal = sumA + sumB + sumC;

        if(sumTotal == 0){
            graphDataNew = [0,0,0]
        }else{
            graphDataNew = [(sumA/sumTotal), (sumB/sumTotal), (sumC/sumTotal)];
        }
        
        chartRadar.data.datasets[0].data = graphDataNew;
        chartRadar.update();

        // 桌機版本湯水顏色變動

        springWater = document.getElementById('bottomWave');
        springHeight = 50*totalAmount;
        springWater.style.height = `${springHeight}px`;
        springColor = '';

        if(totalAmount!==0){
            springWater.style.opacity = `1`;
            document.getElementById("mrSpringStand").style.opacity = `0`;
        }else{
            springWater.style.opacity = `0`;
            document.getElementById("mrSpringStand").style.opacity = `1`;
        }

        if(totalAmount==1){
            for(i=0;i<12;i++){
                if(document.querySelectorAll('#items_input input')[i].checked==true){
                    springColor += `${document.querySelectorAll('#items_input input')[i].dataset.color}`;
                }
            }
            springWater.style.background = `${springColor}`;
        }else{
            for(i=0;i<12;i++){
                if(document.querySelectorAll('#items_input input')[i].checked==true){
                    springColor += `,${document.querySelectorAll('#items_input input')[i].dataset.color}`;
                }
            }
            springWater.style.background = `linear-gradient(180deg${springColor})`;
        }
    };

    // 時段藥材input註冊
    for(i=0;i<document.querySelectorAll('.items_time input').length;i++){
        document.querySelectorAll('.items_time input')[i].addEventListener('change',itemTimeInputCkd);
    }

    // 藥材選取input註冊
    for(i=0;i<itemsPickArr.length;i++){
        itemsPickArr[i].addEventListener('change', itemChange);
    };

    // 接收SESSION中的推薦藥材並點選對應的label
<?php 
if(!isset($_SESSION["consultantItems"])){
    $_SESSION["consultantItems"] = array();
}
?>
    consultantItems = <?php echo json_encode($_SESSION["consultantItems"]); ?>;
    if(consultantItems.length>0){
        document.getElementById("mask").style.display = "block";
        document.querySelector("#alertLightbox span").innerText = "已為您選取藥材";
        document.getElementById("alertLightbox").style.display = "flex";
    };
    if(consultantItems.length>0){
        for(let i=0;i<consultantItems.length;i++){
            document.querySelector(`label[for="item${consultantItems[i]}"]`).click();
        }
    }

<?php $_SESSION["consultantItems"] = array(); ?>


    // 繼續製作按鈕
    $("#newCardBtn").click(function(){
        // window.location.href = 'custom.php';
        //關閉燈箱
        $("#scrSubmitLightbox").css("display","none");
        //清空所有藥材選單checkbox
        for(let i=0;i<document.querySelectorAll("#items_input input").length;i++){
            if(document.querySelectorAll("#items_input input")[i].checked == true){
                document.querySelectorAll("#items_input input")[i].nextElementSibling.click();
            }
        }
        
        //湯牌製作燈箱內容reset
        for(let i in document.querySelectorAll("#options input[type='text']")){
            document.querySelectorAll("#options input[type='text']")[i].value = ``;
        }

        for(let i in document.querySelectorAll(".draw .circle p")){
            document.querySelectorAll(".draw .circle p")[i].innerText = ``;
        }

        document.getElementsByClassName("card_name")[0].innerText = `(湯牌標題)`;

        document.getElementById("font0").selected = true;
        for(let i in document.querySelectorAll(".draw .circle p")){
            
            document.querySelectorAll(".draw .circle p")[i].style.fontFamily = document.getElementById("font0").value;
        }
    });

    // 湯牌燈箱底下完成鈕
    $("#btnSubmitCard").click(function(){
        var xhrMember = new  XMLHttpRequest();

        xhrMember.onreadystatechange=function (){
            if( xhrMember.readyState == 4){
                if( xhrMember.status == 200 ){
                    // console.log(xhrMember.responseText);
                    if(xhrMember.responseText=='1'){
                        // 判斷內容是否填妥
        if( document.getElementById("cardTitleInput").value == `` || document.getElementById("cardTextInput").value == ``){
            document.getElementById("mask").style.display = "block";
            document.querySelector("#alertLightbox span").innerText = '請輸入湯牌標題及徽章文字';
            document.getElementById("alertLightbox").style.display = "flex";
            return;            
        }

        // 找出被選的那個時段藥材
        var cardTimeItem = '';
        for(key in document.querySelectorAll('.items_time input')){
            if(document.querySelectorAll('.items_time input')[key].checked == true){
                
                cardTimeItem = document.querySelectorAll('.items_time input')[key].value;
                // console.log(cardTimeItem);
            }
        };
        if(cardTimeItem == ''){
            cardTimeItem = 0;
        }

        // Ajax送出湯牌資料
        var xhr = new  XMLHttpRequest();

        xhr.onreadystatechange=function (){
            if( xhr.readyState == 4){
                if( xhr.status == 200 ){
                // document.getElementById("showPanel").innerHTML = xhr.responseText;  
                }else{
                alert( xhr.status );
                }
            }
        }

        var newCardInfo = {};

        // 湯牌資料
        newCardInfo.memNo = 1;
        newCardInfo.cardName = document.getElementById("cardTitleInput").value;
        newCardInfo.cardText = document.getElementById("cardTextInput").value;
        newCardInfo.cardFont = document.getElementById("cardFontSelect").value;
        newCardInfo.cardTextColor1 = document.getElementById("colourpicker_1").value;
        newCardInfo.cardTextColor2 = document.getElementById("colourpicker_2").value;
        newCardInfo.cardTextColor3 = document.getElementById("colourpicker_3").value;
        newCardInfo.cardTextColor4 = document.getElementById("colourpicker_4").value;
        newCardInfo.cardTextColor5 = document.getElementById("colourpicker_5").value;
        newCardInfo.cardTextColor6 = document.getElementById("colourpicker_6").value;
        newCardInfo.cardPrice = totalPrice;
        newCardInfo.cardTimeItem = cardTimeItem;
        // 湯牌所選藥材陣列
        itemsCheckedArr = [];
        for(key in document.querySelectorAll('#items_input input')){
            if( document.querySelectorAll('#items_input input')[key].checked == true){
                itemsCheckedArr.push( document.querySelectorAll('#items_input input')[key].value );
            }
        }
        while(itemsCheckedArr.length<4){
            itemsCheckedArr.push(null);
        };

        newCardInfo.carditem1 = itemsCheckedArr[0];
        newCardInfo.carditem2 = itemsCheckedArr[1];
        newCardInfo.carditem3 = itemsCheckedArr[2];
        newCardInfo.carditem4 = itemsCheckedArr[3];
        // console.log(newCardInfo.carditem1, newCardInfo.carditem2, newCardInfo.carditem3, newCardInfo.carditem4);

        // 根據雷達數據決定湯牌療效
        var effectType = 0;
        if(sumA > sumB && sumA > sumC){
            effectType = 1;
        }else if(sumB > sumA && sumB > sumC){
            effectType = 2;
        }else{
            effectType = 3
        }
        newCardInfo.effecttypeNo = effectType;

        var jsonStr = JSON.stringify(newCardInfo);
        // console.log(newCardInfo.cardTextColor1,newCardInfo.cardTextColor2);

        var url = "addCard.php?jsonStr=" + jsonStr;
        
        xhr.open("Get", url, true);
        xhr.send( null );
        // console.log(url);


        // 湯牌燈箱關閉、提示燈箱打開、網站往上捲
        $("#scrCardLightbox").css("display","none");
        if(document.body.clientWidth<769){
            $("#scrSubmitLightbox").css("display","block");
            $("html").animate({scrollTop: 0}, 500 );
        }else{
            $("#scrSubmitLightbox").css("display","flex");
        }
                    }else{
                        
                        document.getElementById("mask").style.display = "block";
                        document.querySelector("#alertLightbox span").innerText = '請先登入會員';
                        document.getElementById("alertLightbox").style.display = "flex";
                    }
                }else{
                    alert( xhrMember.status );
                }
            }
        }
        var url = "login_or_not.php";
        xhrMember.open("Get", url, true);
        xhrMember.send( null );       

    });

    // 客製頁底下送出鈕(769以上)
    $("#btnSubmitItems").click(function(){
        //沒有選擇時停用
        var itemsInputCheckedCount = 0;
        for(var i in $("#items_input input")){
            if($("#items_input input")[i].checked == true){
                itemsInputCheckedCount++;
            }
        }

        if(itemsInputCheckedCount==0){
            document.getElementById("mask").style.display = "block";
            document.querySelector("#alertLightbox span").innerText = `尚未選取藥材`
            document.getElementById("alertLightbox").style.display = "flex";
            return;
        }

        //有選擇時打開湯牌編輯燈箱
        $("#scrCardLightbox").css("display","flex");
        $("#scrSubmitLightbox").css("display","none");
        $("html").animate({scrollTop: 0}, 500 );
        // 把被選取的藥材放入湯牌中
        // 先取得被選取藥材陣列

        checkedItemArr = [];
        for(i=0;i<$("#items_input input").length;i++){
            if($("#items_input input")[i].checked==true){
                checkedItemArr.push($("#items_input input")[i]);
            }
        }

        for(i=0;i<document.getElementsByClassName("card_item").length;i++){
            document.getElementsByClassName(`card_item${i+1}`)[0].style.display = "none";
        }

        for(i=0;i<checkedItemArr.length;i++){
            // 選取了幾項就呈現幾項
            document.getElementsByClassName(`card_item${i+1}`)[0].style.display = "block";
            // 換圖及換標題
            document.getElementsByClassName(`card_item${i+1}`)[0].children[0].children[0].src = checkedItemArr[i].nextElementSibling.children[0].src.replace('-c','-s');
            document.getElementsByClassName(`card_item${i+1}`)[0].children[1].innerText = checkedItemArr[i].nextElementSibling.children[1].innerText;
        }
    
        // 徽章顏色編輯色塊reset 
        if(document.getElementById("cardTextInput").value.length==0){
            document.getElementById("colourpicker_1").style.display = "none";
            document.getElementById("colourpicker_2").style.display = "none";
            document.getElementById("colourpicker_3").style.display = "none";
            document.getElementById("colourpicker_4").style.display = "none";
            document.getElementById("colourpicker_5").style.display = "none";
            document.getElementById("colourpicker_6").style.display = "none";
        }
   
    });

    // 客志頁底下送出按鈕(768以下)
    $("#btnSubmitItems_formobile").click(function(){
        //沒有選擇時停用
        var itemsInputCheckedCount = 0;
        for(var i in $("#items_input input")){
            if($("#items_input input")[i].checked == true){
                itemsInputCheckedCount++;
            }
        }

        if(itemsInputCheckedCount==0){
            document.getElementById("mask").style.display = "block";
            document.querySelector("#alertLightbox span").innerText = `尚未選取藥材`
            document.getElementById("alertLightbox").style.display = "flex";
            return;
        }

        // 湯牌燈箱打開、網站往上捲
        $("#scrCardLightbox").css("display","block");
        $("html").animate({scrollTop: 0}, 500 );
        // 把被選取的藥材放入湯牌中
        // 先取得被選取藥材陣列


        checkedItemArr = [];
        for(i=0;i<$("#items_input input").length;i++){
            if($("#items_input input")[i].checked==true){
                checkedItemArr.push($("#items_input input")[i]);
            }
        }

        for(i=0;i<document.getElementsByClassName("card_item").length;i++){
            document.getElementsByClassName(`card_item${i+1}`)[0].style.display = "none";
        }

        for(i=0;i<checkedItemArr.length;i++){
            // 選取了幾項就呈現幾項
            document.getElementsByClassName(`card_item${i+1}`)[0].style.display = "block";
            // 換圖及換標題
            document.getElementsByClassName(`card_item${i+1}`)[0].children[0].children[0].src = checkedItemArr[i].nextElementSibling.children[0].src;
            document.getElementsByClassName(`card_item${i+1}`)[0].children[1].innerText = checkedItemArr[i].nextElementSibling.children[1].innerText;
        }
    
        // 徽章顏色編輯色塊reset 
        if(document.getElementById("cardTextInput").value.length==0){
            document.getElementById("colourpicker_1").style.display = "none";
            document.getElementById("colourpicker_2").style.display = "none";
            document.getElementById("colourpicker_3").style.display = "none";
            document.getElementById("colourpicker_4").style.display = "none";
            document.getElementById("colourpicker_5").style.display = "none";
            document.getElementById("colourpicker_6").style.display = "none";
        }
    });

    // 湯牌燈箱關閉
    $("#lightboxToggle").click(function(){
        $("#scrCardLightbox").css("display","none");
    });

    // 手機版湯牌標籤切換功能
    $(".option").click(function(){
        if(document.body.clientWidth<769){
            // 點選別人把標籤內容打開
            if(this.nextElementSibling.style.display !== "flex"){
                $(".cardInputWrapper").css("display","none");
                $(".option").children("span").css("display","none");
                $(this).siblings(".cardInputWrapper").css("display","flex");
                $(this).children("span").css("display","block");
            }else{ //點到自己把自己收起來
                $(this).siblings(".cardInputWrapper").css("display","none");
                $(this).children("span").css("display","none");
            }
        }
    });

    // 手機版切換百科客製
    document.getElementById('goWikiBtn').addEventListener('click',function(){
        document.getElementById('scrCustom').style.display = 'none';
        document.getElementById('scrWiki').style.display = '';
    })
    document.getElementById('goCustomBtn').addEventListener('click',function(){
        document.getElementById('scrWiki').style.display = 'none';
        document.getElementById('scrCustom').style.display = '';
    })

    //手機版版面調整 讓兩個燈箱高度等於客製頁
    window.onload = function(){
        if(document.body.clientWidth<769){
            document.getElementById('scrCardLightbox').style.height = `${document.body.scrollHeight}px`;
            document.getElementById('scrSubmitLightbox').style.height = `${document.body.scrollHeight}px`;
        }    
    }

    // 手機-一般藥材選擇 螢幕寬度小於769時啟用slick套件、否則用circleCarousel
    if(document.body.clientWidth<769){
        // 手機-一般藥材選擇slick
        $('.items_normal').slick({
            infinite: false,
            slidesToShow: 3,
            slidesToScroll: 3,
            arrows: true,
            dots: true
        });
    }else{
        //	create by nasir farhadi
        //	email : nasirfarhadi92@gmail.com
        //	Github : nasirfarhadi92
        let i=2;

        $(document).ready(function(){
            var radius = 200;
            var fields = $('.itemDot');
            var container = $('.wikiNav');
            var width = container.width();
            radius = width/2.5;

            var height = container.height();
            var angle = 0, step = (2*Math.PI) / fields.length;
            fields.each(function() {
                var x = Math.round(width/2 + radius * Math.cos(angle) - $(this).width()/2);
                var y = Math.round(height/2 + radius * Math.sin(angle) - $(this).height()/2);
                
                $(this).css({
                    left: x + 'px',
                    top: y + 'px'
                });
                angle += step;
            });
            
            
            $('.itemDot').click(function(){
                
                var dataTab= $(this).data("tab");
                $('.itemDot').removeClass('active');
                $(this).addClass('active');
                $('.CirItem').removeClass('active');
                $( '.CirItem'+ dataTab).addClass('active');
                i=dataTab;
                
                $('#wikiNav').css({
                    "transform":"rotate("+(360-(i-1)*(360/fields.length))+"deg)",
                    "transition":"2s"
                });
                $('.itemDot').css({
                    "transform":"rotate("+((i-1)*(360/fields.length))+"deg)",
                    "transition":"1s"
                });                                
            });
            
            setInterval(function(){
                var dataTab= $('.wikiNav.active').data("tab");
                if(dataTab>12||i>12){
                dataTab=1;
                i=1;
                }
                $('.itemDot').removeClass('active');
                $('[data-tab="'+i+'"]').addClass('active');
                $('.CirItem').removeClass('active');
                $( '.CirItem'+i).addClass('active');
                i++;                
                
                $('#wikiNav').css({
                    "transform":"rotate("+(360-(i-2)*(360/fields.length))+"deg)",
                    "transition":"2s"
                });
                $('.itemDot').css({
                    "transform":"rotate("+((i-2)*(360/fields.length))+"deg)",
                    "transition":"1s"
                });                
            }, 4000);
            
        });
    };

    // 手機-小百科slick
    if(document.body.clientWidth<769){
        $('.wikiInfo').slick({
            slidesToShow: 1,
            slidesToScroll: 1,
            arrows: false,
            fade: true,
            asNavFor: '.wikiNav'
        });
        $('.wikiNav').slick({
            slidesToShow: 3,
            slidesToScroll: 1,
            asNavFor: '.wikiInfo',
            dots: true,
            centerMode: true,
            focusOnSelect: true
        });
    }

    // 字體option自動變更css設定、寫進value
    fontArr = document.querySelectorAll("#cardFontSelect option");
    for(i=0;i<fontArr.length;i++){
        fontArr[i].style.fontFamily = fontArr[i].value;   
    }

</script>
 <script src="js/header.js"></script>
</html>