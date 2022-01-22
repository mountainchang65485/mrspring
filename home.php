<?php 
    ob_start();
    session_start();
    $_SESSION["where"] = $_SERVER['REQUEST_URI'];
?>

<?php
//抓問題分數
try {
    require_once("php/connectBooks.php");
    $sql_quetion = "select * from question";
    $quetion = $pdo->query($sql_quetion);
    $quetionRows = $quetion->fetchAll(PDO::FETCH_ASSOC);

    $jsonStr_ques = json_encode($quetionRows);
} catch (PDOException $e) {
    echo $e->getMessage();
}
?>
<?php
//抓結果
try {
    require_once("php/connectBooks.php");
    $sql_medicine = "select * from item where itemInterval != 'NULL' and itemStatus != 0 order by effectTypeNo , itemInterval";
    $medicine = $pdo->query($sql_medicine);
    $medicineRows = $medicine->fetchAll(PDO::FETCH_ASSOC);

    $jsonStr_medicine = json_encode($medicineRows);
} catch (PDOException $e) {
    echo $e->getMessage();
}
?>
<!-- 湯牌PHP -->
<?php
try{
    require_once("php/connectBooks.php");
    $sq5 = "
    select * from member as m
    natural join effecttype
    natural join (
        select artNo,effecttypeNo,artTitle,artStatus,memNo,artText,date_format(artTime,'%Y-%m-%d') artTime,artTime artTime1,artLikeCount,artMesCount,cardno,cardName,cardText,cardFont,cardTextColor1,cardTextColor2,cardTextColor3,cardTextColor4,cardTextColor5,cardTextColor6,item1name,item1No,item1type,item1pointA,item1pointB,item1pointC,item1Img2Url,item2No,item2name,item2type,item2pointA,item2pointB,item2pointC,item2Img2Url,item3name,item3No,item3type,item3pointA,item3pointB,item3pointC,item3Img2Url,item4name,item4No,item4Img2Url,item4type,item4pointA,item4pointB,item4pointC 
        from article a
        natural join (
            select cardno,effecttypeNo,cardText,cardFont,cardTextColor1,cardTextColor2,cardTextColor3,cardTextColor4,cardTextColor5,cardTextColor6,cardName,item1No,item1name,item1type,item1pointA,item1pointB,item1pointC,item1Img2Url,item2name,item2No,item2type,item2pointA,item2pointB,item2pointC,item2Img2Url,item3name,item3No,item3type,item3pointA,item3pointB,item3pointC,item3Img2Url,item4name,item4No,item4Img2Url,item4type,item4pointA,item4pointB,item4pointC
            from card
            natural join (
                select itemNo item1No,a.effectTypeNo item1type,a.pointA item1pointA,a.pointB item1pointB,a.pointC item1pointC,a.itemImg2Url item1Img2Url,a.itemname item1name,b.cardno
                from carditem1 b
                left outer join item a
                on a.itemno = b.item1no)as a
            natural join (
                select itemNo item2No,a.effectTypeNo item2type,a.pointA item2pointA,a.pointB item2pointB,a.pointC item2pointC,a.itemImg2Url item2Img2Url,a.itemname item2name,b.cardno
                from carditem2 b
                left outer join item a
                on a.itemno = b.item2no)as b
            natural join (
                select itemNo item3No,a.effectTypeNo item3type,a.pointA item3pointA,a.pointB item3pointB,a.pointC item3pointC,a.itemImg2Url item3Img2Url,a.itemname item3name,b.cardno
                from carditem3 b
                left outer join item a
                on a.itemno = b.item3no)as c
            natural join (
                select itemNo item4No,a.effectTypeNo item4type,a.pointA item4pointA,a.pointB item4pointB,a.pointC item4pointC,a.itemImg2Url item4Img2Url,a.itemname item4name,b.cardno
                from carditem4 b
                left outer join item a
                on a.itemno = b.item4no)as d) as a
    )as a
        where artStatus <> 0
        order by a.artLikeCount desc , a.artMesCount desc
        limit 0,3;
    
    ";//forum by Like count top3
    	


  
	$hot_article = $pdo->query($sq5);
  
  
}catch(PDOException $e){
  $errMsg .= "錯誤原因 : ".$e -> getMessage(). "<br>";
  $errMsg .= "錯誤行號 : ".$e -> getLine(). "<br>";
}
?>

<!-- 登入燈箱 -->


<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>湯先生 Mr.Spring</title>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/2.0.2/TweenMax.min.js"></script>
    <script src="https://cdn.jsdelivr.net/pixi.js/3.0.7/pixi.js"></script>
    <link rel="stylesheet" href="css/fonts.css">
    <link rel="stylesheet" href="css/reset.css">
    <link rel="stylesheet" href="css/share.css">
    <link rel="stylesheet" href="css/card.css">
    <link rel="stylesheet" href="css/hot_forum.css">
    <link rel="stylesheet" href="css/footer.css">
    <link rel="stylesheet" href="css/signin.css">
    <link rel="stylesheet" href="css/firstPage.css">
    <link rel="stylesheet" href="css/header.css">
    <style>
        .egg{
            width:10px;
            height:10px;
        }
    </style>
</head>

<body>
    <!-- <h1>首頁請用這支</h1> -->
    <!-- 小遊戲連結 -->
    <button class="getCoupon">
        <div id="wave_for_coupon">
            <div class="little_wave">
                <img class="" src="images/wave2.svg" alt="">
                <img src="images/wave2.svg" alt="">
                <img src="images/wave2.svg" alt="">
            </div>
        </div>

        <img id="peach" src="images/getCoupon2.svg" alt="優惠券小遊戲">
    </button>

    <!-- 導覽列 -->
    <header>
        <nav id="nav_bar">
            <!-- <span id="memName"></span> -->


            <script src="js/g4CheckLogin.js"></script>
            
            
            <!-- <input type="hidden" name="memId" id="memId"> -->

            <ul id="banner">
                <a class="flag" href="custom.php">
                    <h2>客製湯頭</h2>
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

    
    <!-- 第一屏 -->
    <div class="mt_first_page">
        <div id="kasumi_top_container"></div>
        <div class="mt_bg_wrap">
            <div class="mt_cloud">
                <div class="cloud_large">
                    <img src="images/cloud_large.png" alt="cloud">
                    <img src="images/cloud_large.png" alt="cloud">
                    <img src="images/cloud_large.png" alt="cloud">
                </div>
                <!-- <div class="bg_mt">
                    <img src="images/fjMountain.png" alt="fujiMountain">
                    <img src="images/first_page_trees.png" alt="trees">
                </div> -->
                <div id="mt_water">
                    <img id="fj" src="images/fjMountain.png" alt="fujiMountain">

                    <div id="water_color_change"></div>
                    <div id="water_color_nochange"></div>
                    <div class="wrap" style="position:relative;">
                        <section class="introduce">

                            <div class="content">
                                <div class="content_frame_wrap">
                                    <div id="content_frame" style="opacity: 0;">
                                        <img id="text_bubble" src="images/texture01.png" alt="湯頭介紹">
                                        <article class="sup_info">
                                            <figure id="spring_herb">

                                                <h3 id="spring_name"></h3>

                                                <a href="custom.php"><img class="intro_pic_small" src="images/herb01.svg"
                                                        alt="湯頭介紹"></a>
                                                <a href="custom.php"><img class="intro_pic_small" src="images/herb02.svg"
                                                        alt="湯頭介紹"></a>
                                                <a href="custom.php"><img class="intro_pic_small" src="images/herb03.svg"
                                                        alt="湯頭介紹"></a>
                                            </figure>
                                            <p class="paragraph"> </p>
                                            <br>
                                            <p class="paragraph"></p>



                                            <div class="custom_button">
                                                <div style="text-align:center;">
                                                    <a href="custom.php" class="btn_s" style="color:#ceae81;">馬上客製</a>
                                                    <a href="#second_page" class="btn_s" style="color:#ceae81;">我要諮詢</a>

                                                </div>
                                            </div>
                                        </article>
                                    </div>
                                </div>
                                <div class="herb">
                                    <figure class="herb_cross">
                                        <h3 class="hurb_name">舒筋緩骨</h3>
                                        <img class="cross" src="images/herbCross01.png" alt="舒筋緩骨">
                                        <img class="sepia_cross" src="images/herbCross01_red.png" alt="舒筋緩骨">
                                    </figure>

                                    <figure id="herb_cross2">
                                        <h3 class="hurb_name">安定心神</h3>
                                        <img class="cross" src="images/herbCross02.png" alt="安定心神">
                                        <img class="sepia_cross" src="images/herbCross02_green.png" alt="安定心神">
                                    </figure>
                                    <figure class="herb_cross">
                                        <h3 class="hurb_name">養顏美容</h3>
                                        <img class="cross" src="images/herbCross03.png" alt="養顏美容">
                                        <img class="sepia_cross" src="images/herbCross03_bl02.png" alt="養顏美容">
                                    </figure>
                                </div>

                            </div>
                        </section>
                    </div>
                    <div class="monkey_animation">

                        <div id="monkey_wrap">
                            <div class="sk_wrap">
                                <div class="little_smoke">
                                    <div class="sk"></div>
                                    <div class="sk"></div>
                                    <div class="sk"></div>
                                </div>
                            </div>
                            <div id="wave01">
                                <div class="little_wave">
                                    <img src="images/wave1.svg" alt="">
                                    <img src="images/wave1.svg" alt="">
                                    <img src="images/wave1.svg" alt="">
                                </div>
                            </div>

                            <div id="wave02">
                                <div class="little_wave">
                                    <img src="images/wave2.svg" alt="">
                                    <img src="images/wave2.svg" alt="">
                                    <img src="images/wave2.svg" alt="">
                                </div>
                            </div>
                            <img id="slogon02" src="images/slogon2.svg" alt="來約泡湯吧!">
                            <img id="slogon01" src="images/slogon01.svg" alt="專業客製湯屋">
                            <img id="monkeyFace" src="images/monkeyFace01.svg" alt="">
                            <img id="mr_spring_for_firstpage" src="images/monkey01.svg" alt="湯先生">
                            <img id="monkeyEyes" src="images/monkeyEyesLemon.svg" alt="">


                            <div class="note" style="opacity: 0;">
                                <span>z</span>
                                <span>Z</span>
                                <span>z</span>
                                <span>Z</span>
                                <span>z</span>
                            </div>
                            <div class="sk_wrap02">
                                <div class="little_smoke">
                                    <div class="sk"></div>
                                    <div class="sk"></div>
                                    <div class="sk"></div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- 第二屏 -->
    <div id="second_page"  style="overflow:hidden;">
        
        <div class="cloud_large">
                <img src="images/cloud_l2.png" alt="">
                <img src="images/cloud_l2.png" alt="">
                <img src="images/cloud_l2.png" alt="">
       </div>
        <div class="my_second_page">
            <!-- 結果 -->
            <div class="showshower" id="showshower">
                <div class="col-12 col-md-8 an_shower_info">
                    <div class="shower_infoTitle">
                        <p>專屬推薦</p>
                        <p id="MedicinePush">根據諮詢的結果您對安定心神的需求最大，其次是養顏美容最後是舒筋活骨，因此我們為您推薦:</p>
                    </div>
                    <div class="showerMedicine">
                        <div class="an_MedicinePicWrap">
                            <img id="medicinePic1" src="images\itemPics\alchecked\item2-1.png" alt="檸檬">
                            <p id="medicineName1">檸檬</p>
                            <p id="medicineDic1">可預防和治療高血壓和心肌梗塞，檸檬酸有收縮、增固毛細血管。</p>
                        </div>
                        <div class="an_MedicinePicWrap">
                            <img id="medicinePic2" src="images\itemPics\alchecked\item3-2.png" alt="八角">
                            <p id="medicineName2">八角</p>
                            <p id="medicineDic2">促進消化液分泌，增加胃腸蠕動，有助於緩解痙攣、減輕疼痛。</p>
                        </div>
                        <div class="an_MedicinePicWrap">
                            <img id="medicinePic3" src="images\itemPics\alchecked\item1-1.png" alt="山茱萸">
                            <p id="medicineName3">山茱萸</p>
                            <p id="medicineDic3">此湯對血氣皆虛、精神不振有很好療效，可補肝腎，滋陰明目。</p>
                        </div>
                    </div>
                    <div class="an_Medicine">
                        <!-- <div class="Medicine_btn_s">
                            <a href="index.html#second_page" class="Medicine_btmLink">重新測驗</a>
                        </div> -->
                        <div class="Medicine_btn_s">
                            <a id="go_custom_with_session" class="Medicine_btmLink">來去客製</a>
                        </div>
                    </div>
                </div>
            </div>
            <!-- 搗藥桌子 -->
            <div class="an_table">
                <!-- 搗藥猴子 -->
                <img class="monkeyMedPic" src="images\monkeyMi.gif" alt="搗藥猴子">
            </div>
            <div class="an_monkeyMedicine">
                <!-- 猴子櫃子 -->
                <div class="col-lg-5 col-12 an_monkeyCabinet">
                    <div class="an_cabinet">
                        <!-- 抽屜一列 -->
                        <div class="drawerWrap">
                            <div class="drawer">
                                <img src="images\close_drawer.png" alt="抽屜">
                                <div class="extend"></div>
                            </div>
                            <div class="drawer">
                                <img src="images\close_drawer.png" alt="抽屜">
                                <div class="extend"></div>
                            </div>
                            <div class="drawer">
                                <img src="images\close_drawer.png" alt="抽屜">
                                <div class="extend"></div>
                            </div>
                        </div>
                        <div class="drawerWrap">
                            <div class="drawer">
                                <img src="images\close_drawer.png" alt="抽屜">
                                <div class="extend"></div>
                            </div>
                            <div class="drawer">
                                <img src="images\close_drawer.png" alt="抽屜">
                                <div class="extend"></div>
                            </div>
                            <div class="drawer">
                                <img src="images\close_drawer.png" alt="抽屜">
                                <div class="extend"></div>
                            </div>
                        </div>
                        <div class="drawerWrap">
                            <div class="drawer">
                                <img src="images\close_drawer.png" alt="抽屜">
                                <div class="extend"></div>
                            </div>
                            <div class="drawer">
                                <img src="images\close_drawer.png" alt="抽屜">
                                <div class="extend"></div>
                            </div>
                            <div class="drawer">
                                <img src="images\close_drawer.png" alt="抽屜">
                                <div class="extend"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--藥籤諮詢 -->
                <div class="col-lg-7 col-12 an_prescription " id="an_prescription">
                    <!-- 第二屏標題 -->
                    <div class="an_titleMedicine">
                        <div class="titleSquareMedicine">
                            <h2>湯先生抓藥</h2>
                        </div>
                    </div>
                    <div class="an_rescriptionWrap">
                        <!-- 進度表 -->
                        <div class="an_schedule">
                            <div class="an_circle">1</div>
                            <div class="an_scheduleLine"></div>
                            <div class="an_circle1" id="an_circle">2</div>
                            <div class="an_scheduleLine"></div>
                            <div class="an_circle1" id="an_circle">3</div>
                            <div class="an_scheduleLine"></div>
                            <div class="an_circle1" id="an_circle">4</div>
                            <div class="an_scheduleLine"></div>
                            <div class="an_circle1" id="an_circle">5</div>
                            <div class="an_scheduleLine"></div>
                            <div class="an_circle1" id="an_circle">6</div>
                        </div>
                        <!-- 諮詢問題 -->
                        <div class="an_rescriptionText">
                            <p id="qn">Q1</p>
                            <p id="qus"></p>
                        </div>

                        <!-- 諮詢問題答案按鈕 -->
                        <div class="an_anser_wrap">
                            <div class="an_anser">
                                <div class="btn_a" id="ans1" data-point></div>
                            </div>
                            <div class="an_anser">
                                <div class="btn_a" id="ans2" data-point></div>
                            </div>
                            <div class="an_anser">
                                <div class="btn_a" id="ans3" data-point></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    
    <!-- 第三屏 -->
<div id="alert_wrap">
	<div id="alert">
		<p></p>
		<div class="btn_s">確定</div>
	</div>
</div>


<div class="third_page_big_wrap"  style="overflow:hidden;"> 
<div class="third_page_wrap" > 
<div class="third_page">
            <div class="cloud_large" id="third_page_cloud">
                <img src="images/cloud_large.png" alt="cloud">
                <img src="images/cloud_large.png" alt="cloud">
                <img src="images/cloud_large.png" alt="cloud">
            </div>
    


<div class="wrap forum_wrap">    
    <div class="cloud_large">
                <img src="images/cloud_l2.png" alt="cloud">
                <img src="images/cloud_l2.png" alt="cloud">
                <img src="images/cloud_l2.png" alt="cloud">
    </div>
            <div class="mt_title">
                <div class="titleSquare">
                    <h2 class="hot_forum_heading">熱門湯牌</h2>
                </div>
            </div>
    </div>
    <div class="hot_forum_wrap">
		<img src="images/prev.png" id="prev">
		<img src="images/next.png" id="next">
        <?php 
            $i=0;
            $radar=0;
            while($hot_articleRow = $hot_article->fetch(PDO::FETCH_ASSOC)){
	            $i++;
	            $radar++;
	            $pointA=$hot_articleRow['item1pointA']+$hot_articleRow['item2pointA']+$hot_articleRow['item3pointA'];
	            $pointB=$hot_articleRow['item1pointB']+$hot_articleRow['item2pointB']+$hot_articleRow['item3pointB'];
	            $pointC=$hot_articleRow['item1pointC']+$hot_articleRow['item2pointC']+$hot_articleRow['item3pointC'];
	            $total=$pointA+$pointB+$pointC;
	            $pointAprop=$pointA/$total;
	            $pointBprop=$pointB/$total;
	            $pointCprop=$pointC/$total;
	            $cardTextArr = str_split($hot_articleRow['cardText']);
	            $null = count($cardTextArr);
	            if($null<6){
	            	for($x=0;$x<6-$null;$x++){
	            		$cardTextArr[]="";
	            	}
	        }


        ?>
				<div class="hot_forum_box hot_forum_box<?php echo $i; ?>">
					<form class="readMore" action="forum_article.php" method="post">
						<input type="hidden" name="artNo" value="<?php echo $hot_articleRow['artNo'] ?>">

					</form>
					<div class="card card<?php echo $i;?> zoom_out">
						<img class="knot" src="images/knot<?php echo $hot_articleRow['effectTypeNo'] ?>.png">
						<div class="front">
						<div class="draw">
							<div class="drawingArea" style="display: block;">
									<div class="circle circle0" style="transform: rotate(120deg); transform-origin: 50% 50%; color: <?php echo $hot_articleRow['cardTextColor1'] ?>;">
											<p class="futura_R"
													style="transform: rotate(378deg); left: -4.58359px; top: -58.8254px; opacity: 1;font-family: <?php echo $hot_articleRow['cardFont'] ?>;"><?php echo $cardTextArr[0] ?>
													</p>
											<p class="futura_R"
													style="transform: rotate(306deg); left: -31.4164px; top: -50.1068px; opacity: 1;font-family: <?php echo $hot_articleRow['cardFont'] ?>;"><?php echo $cardTextArr[0] ?>
													</p>
											<p class="futura_R"
													style="transform: rotate(234deg); left: -31.4164px; top: -21.8932px; opacity: 1;font-family: <?php echo $hot_articleRow['cardFont'] ?>;"><?php echo $cardTextArr[0] ?>
													</p>
											<p class="futura_R"
													style="transform: rotate(162deg); left: -4.58359px; top: -13.1746px; opacity: 1;font-family: <?php echo $hot_articleRow['cardFont'] ?>;"><?php echo $cardTextArr[0] ?>
													</p>
											<p class="futura_R"
													style="transform: rotate(90deg); left: 12px; top: -36px; opacity: 1;font-family: <?php echo $hot_articleRow['cardFont'] ?>;"><?php echo $cardTextArr[0] ?>
													</p>
									</div>
									<div class="circle circle1" style="transform: rotate(123deg); transform-origin: 50% 50%; color: <?php echo $hot_articleRow['cardTextColor2'] ?>;">
											<p class="futura_R"
													style="transform: rotate(330deg); left: -36px; top: -77.5692px; opacity: 1;font-family: <?php echo $hot_articleRow['cardFont'] ?>;"><?php echo $cardTextArr[1] ?>
													</p>
											<p class="futura_R"
													style="transform: rotate(210deg); left: -36px; top: 5.56922px; opacity: 1;font-family: <?php echo $hot_articleRow['cardFont'] ?>;"><?php echo $cardTextArr[1] ?>
													</p>
											<p class="futura_R"
													style="transform: rotate(90deg); left: 36px; top: -36px; opacity: 1;font-family: <?php echo $hot_articleRow['cardFont'] ?>;"><?php echo $cardTextArr[1] ?>
													</p>
									</div>
									<div class="circle circle2" style="transform: rotate(126deg); transform-origin: 50% 50%; color: <?php echo $hot_articleRow['cardTextColor3'] ?>;">
													<p class="futura_R"
															style="transform: rotate(417.273deg); left: 48.5703px; top: -74.9261px; opacity: 1;font-family: <?php echo $hot_articleRow['cardFont'] ?>;"><?php echo $cardTextArr[2] ?>
															</p>
													<p class="futura_R"
															style="transform: rotate(384.545deg); left: 17.9099px; top: -101.494px; opacity: 1;font-family: <?php echo $hot_articleRow['cardFont'] ?>;"><?php echo $cardTextArr[2] ?>
															</p>
													<p class="futura_R"
															style="transform: rotate(351.818deg); left: -22.2467px; top: -107.267px; opacity: 1;font-family: <?php echo $hot_articleRow['cardFont'] ?>;"><?php echo $cardTextArr[2] ?>
															</p>
													<p class="futura_R"
															style="transform: rotate(319.091deg); left: -59.15px; top: -90.414px; opacity: 1;font-family: <?php echo $hot_articleRow['cardFont'] ?>;"><?php echo $cardTextArr[2] ?>
															</p>
													<p class="futura_R"
															style="transform: rotate(286.364deg); left: -81.0835px; top: -56.2847px; opacity: 1;font-family: <?php echo $hot_articleRow['cardFont'] ?>;"><?php echo $cardTextArr[2] ?>
															</p>
													<p class="futura_R"
															style="transform: rotate(253.636deg); left: -81.0835px; top: -15.7153px; opacity: 1;font-family: <?php echo $hot_articleRow['cardFont'] ?>;"><?php echo $cardTextArr[2] ?>
															</p>
													<p class="futura_R"
															style="transform: rotate(220.909deg); left: -59.15px; top: 18.414px; opacity: 1;font-family: <?php echo $hot_articleRow['cardFont'] ?>;"><?php echo $cardTextArr[2] ?>
															</p>
													<p class="futura_R"
															style="transform: rotate(188.182deg); left: -22.2467px; top: 35.2671px; opacity: 1;font-family: <?php echo $hot_articleRow['cardFont'] ?>;"><?php echo $cardTextArr[2] ?>
															</p>
													<p class="futura_R"
															style="transform: rotate(155.455deg); left: 17.9099px; top: 29.4935px; opacity: 1;font-family: <?php echo $hot_articleRow['cardFont'] ?>;"><?php echo $cardTextArr[2] ?>
															</p>
													<p class="futura_R"
															style="transform: rotate(122.727deg); left: 48.5703px; top: 2.92614px; opacity: 1;font-family: <?php echo $hot_articleRow['cardFont'] ?>;"><?php echo $cardTextArr[2] ?>
															</p>
													<p class="futura_R"
															style="transform: rotate(90deg); left: 60px; top: -36px; opacity: 1;font-family: <?php echo $hot_articleRow['cardFont'] ?>;"><?php echo $cardTextArr[2] ?>
															</p>
									</div>
									<div class="circle circle3" style="transform: rotate(129deg); transform-origin: 50% 50%; color: <?php echo $hot_articleRow['cardTextColor4'] ?>;">
													<p class="futura_R"
															style="transform: rotate(398.571deg); left: 47.855px; top: -111.056px; opacity: 1;font-family: <?php echo $hot_articleRow['cardFont'] ?>;"><?php echo $cardTextArr[3] ?>
															</p>
													<p class="futura_R"
															style="transform: rotate(347.143deg); left: -33.362px; top: -129.593px; opacity: 1;font-family: <?php echo $hot_articleRow['cardFont'] ?>;"><?php echo $cardTextArr[3] ?>
															</p>
													<p class="futura_R"
															style="transform: rotate(295.714deg); left: -98.493px; top: -77.6528px; opacity: 1;font-family: <?php echo $hot_articleRow['cardFont'] ?>;"><?php echo $cardTextArr[3] ?>
															</p>
													<p class="futura_R"
															style="transform: rotate(244.286deg); left: -98.493px; top: 5.65284px; opacity: 1;font-family: <?php echo $hot_articleRow['cardFont'] ?>;"><?php echo $cardTextArr[3] ?>
															</p>
													<p class="futura_R"
															style="transform: rotate(192.857deg); left: -33.362px; top: 57.5931px; opacity: 1;font-family: <?php echo $hot_articleRow['cardFont'] ?>;"><?php echo $cardTextArr[3] ?>
															</p>
													<p class="futura_R"
															style="transform: rotate(141.429deg); left: 47.855px; top: 39.0558px; opacity: 1;font-family: <?php echo $hot_articleRow['cardFont'] ?>;"><?php echo $cardTextArr[3] ?>
															</p>
													<p class="futura_R"
															style="transform: rotate(90deg); left: 84px; top: -36px; opacity: 1;font-family: <?php echo $hot_articleRow['cardFont'] ?>;"><?php echo $cardTextArr[3] ?>
															</p>
									</div>
									<div class="circle circle4" style="transform: rotate(132deg); transform-origin: 50% 50%; color: <?php echo $hot_articleRow['cardTextColor5'] ?>;">
											<p class="futura_R"
													style="transform: rotate(428.824deg); left: 99.8967px; top: -79.349px; opacity: 1;font-family: <?php echo $hot_articleRow['cardFont'] ?>;"><?php echo $cardTextArr[4] ?>
													</p>
											<p class="futura_R"
													style="transform: rotate(407.647deg); left: 76.6811px; top: -116.843px; opacity: 1;font-family: <?php echo $hot_articleRow['cardFont'] ?>;"><?php echo $cardTextArr[4] ?>
													</p>
											<p class="futura_R"
													style="transform: rotate(386.471deg); left: 41.4886px; top: -143.42px; opacity: 1;font-family: <?php echo $hot_articleRow['cardFont'] ?>;"><?php echo $cardTextArr[4] ?>
													</p>
											<p class="futura_R"
													style="transform: rotate(365.294deg); left: -0.927797px; top: -155.488px; opacity: 1;font-family: <?php echo $hot_articleRow['cardFont'] ?>;"><?php echo $cardTextArr[4] ?>
													</p>
											<p class="futura_R"
													style="transform: rotate(344.118deg); left: -44.8396px; top: -151.419px; opacity: 1;font-family: <?php echo $hot_articleRow['cardFont'] ?>;"><?php echo $cardTextArr[4] ?>
													</p>
											<p class="futura_R"
													style="transform: rotate(322.941deg); left: -84.3162px; top: -131.762px; opacity: 1;font-family: <?php echo $hot_articleRow['cardFont'] ?>;"><?php echo $cardTextArr[4] ?>
													</p>
											<p class="futura_R"
													style="transform: rotate(301.765deg); left: -114.026px; top: -99.1719px; opacity: 1;font-family: <?php echo $hot_articleRow['cardFont'] ?>;"><?php echo $cardTextArr[4] ?>
													</p>
											<p class="futura_R"
													style="transform: rotate(280.588deg); left: -129.957px; top: -58.0499px; opacity: 1;font-family: <?php echo $hot_articleRow['cardFont'] ?>;"><?php echo $cardTextArr[4] ?>
													</p>
											<p class="futura_R"
													style="transform: rotate(259.412deg); left: -129.957px; top: -13.9501px; opacity: 1;font-family: <?php echo $hot_articleRow['cardFont'] ?>;"><?php echo $cardTextArr[4] ?>
													</p>
											<p class="futura_R"
													style="transform: rotate(238.235deg); left: -114.026px; top: 27.1719px; opacity: 1;font-family: <?php echo $hot_articleRow['cardFont'] ?>;"><?php echo $cardTextArr[4] ?>
													</p>
											<p class="futura_R"
													style="transform: rotate(217.059deg); left: -84.3162px; top: 59.7621px; opacity: 1;font-family: <?php echo $hot_articleRow['cardFont'] ?>;"><?php echo $cardTextArr[4] ?>
													</p>
											<p class="futura_R"
													style="transform: rotate(195.882deg); left: -44.8396px; top: 79.4191px; opacity: 1;font-family: <?php echo $hot_articleRow['cardFont'] ?>;"><?php echo $cardTextArr[4] ?>
													</p>
											<p class="futura_R"
													style="transform: rotate(174.706deg); left: -0.927797px; top: 83.4881px; opacity: 1;font-family: <?php echo $hot_articleRow['cardFont'] ?>;"><?php echo $cardTextArr[4] ?>
													</p>
											<p class="futura_R"
													style="transform: rotate(153.529deg); left: 41.4886px; top: 71.4196px; opacity: 1;font-family: <?php echo $hot_articleRow['cardFont'] ?>;"><?php echo $cardTextArr[4] ?>
													</p>
											<p class="futura_R"
													style="transform: rotate(132.353deg); left: 76.6811px; top: 44.8435px; opacity: 1;font-family: <?php echo $hot_articleRow['cardFont'] ?>;"><?php echo $cardTextArr[4] ?>
													</p>
											<p class="futura_R"
													style="transform: rotate(111.176deg); left: 99.8967px; top: 7.349px; opacity: 1;font-family: <?php echo $hot_articleRow['cardFont'] ?>;"><?php echo $cardTextArr[4] ?>
													</p>
											<p class="futura_R"
													style="transform: rotate(90deg); left: 108px; top: -36px; opacity: 1;font-family: <?php echo $hot_articleRow['cardFont'] ?>;"><?php echo $cardTextArr[4] ?>
													</p>
									</div>
									<div class="circle circle5" style="transform: rotate(135deg); transform-origin: 50% 50%; color: <?php echo $hot_articleRow['cardTextColor6'] ?>;">
											<p class="futura_R"
													style="transform: rotate(422.308deg); left: 115.506px; top: -102.92px; opacity: 1;font-family: <?php echo $hot_articleRow['cardFont'] ?>;"><?php echo $cardTextArr[5] ?>
													</p>
											<p class="futura_R"
													style="transform: rotate(394.615deg); left: 69.8013px; top: -154.51px; opacity: 1;font-family: <?php echo $hot_articleRow['cardFont'] ?>;"><?php echo $cardTextArr[5] ?>
													</p>
											<p class="futura_R"
													style="transform: rotate(366.923deg); left: 5.35728px; top: -178.95px; opacity: 1;font-family: <?php echo $hot_articleRow['cardFont'] ?>;"><?php echo $cardTextArr[5] ?>
													</p>
											<p class="futura_R"
													style="transform: rotate(339.231deg); left: -63.0631px; top: -170.642px; opacity: 1;font-family: <?php echo $hot_articleRow['cardFont'] ?>;"><?php echo $cardTextArr[5] ?>
													</p>
											<p class="futura_R"
													style="transform: rotate(311.538deg); left: -119.786px; top: -131.49px; opacity: 1;font-family: <?php echo $hot_articleRow['cardFont'] ?>;"><?php echo $cardTextArr[5] ?>
													</p>
											<p class="futura_R"
													style="transform: rotate(283.846deg); left: -151.816px; top: -70.4615px; opacity: 1;font-family: <?php echo $hot_articleRow['cardFont'] ?>;"><?php echo $cardTextArr[5] ?>
													</p>
											<p class="futura_R"
													style="transform: rotate(256.154deg); left: -151.816px; top: -1.53854px; opacity: 1;font-family: <?php echo $hot_articleRow['cardFont'] ?>;"><?php echo $cardTextArr[5] ?>
													</p>
											<p class="futura_R"
													style="transform: rotate(228.462deg); left: -119.786px; top: 59.4897px; opacity: 1;font-family: <?php echo $hot_articleRow['cardFont'] ?>;"><?php echo $cardTextArr[5] ?>
													</p>
											<p class="futura_R"
													style="transform: rotate(200.769deg); left: -63.0631px; top: 98.6423px; opacity: 1;font-family: <?php echo $hot_articleRow['cardFont'] ?>;"><?php echo $cardTextArr[5] ?>
													</p>
											<p class="futura_R"
													style="transform: rotate(173.077deg); left: 5.35728px; top: 106.95px; opacity: 1;font-family: <?php echo $hot_articleRow['cardFont'] ?>;"><?php echo $cardTextArr[5] ?>
													</p>
											<p class="futura_R"
													style="transform: rotate(145.385deg); left: 69.8013px; top: 82.5097px; opacity: 1;font-family: <?php echo $hot_articleRow['cardFont'] ?>;"><?php echo $cardTextArr[5] ?>
													</p>
											<p class="futura_R"
													style="transform: rotate(117.692deg); left: 115.506px; top: 30.9201px; opacity: 1;font-family: <?php echo $hot_articleRow['cardFont'] ?>;"><?php echo $cardTextArr[5] ?>
													</p>
											<p class="futura_R"
													style="transform: rotate(90deg); left: 132px; top: -36px; opacity: 1;font-family: <?php echo $hot_articleRow['cardFont'] ?>;"><?php echo $cardTextArr[5] ?>
													</p>
									</div>
							</div>
						</div>      
							<h3 class="card_name"><?php echo $hot_articleRow['cardName']?></h3>
							<div class="card_item_box">
								<div class="card_item card_item1">
									<div class="card_item_image">
										<img src="<?php echo $hot_articleRow['item1Img2Url']?>">
									</div>
									<h4 class="card_item_name"><?php echo $hot_articleRow['item1name']?></h4>
								</div>
								<div class="card_item card_item2">
									<div class="card_item_image">
										<img src="<?php echo $hot_articleRow['item2Img2Url']?>">
									</div>
									<h4 class="card_item_name"><?php echo $hot_articleRow['item2name']?></h4>
								</div>
								<div class="card_item card_item3">
									<div class="card_item_image">
										<img src="<?php echo $hot_articleRow['item3Img2Url']?>">
									</div>
									<h4 class="card_item_name"><?php echo $hot_articleRow['item3name']?></h4>
								</div>
								<div class="card_item card_item4">
									<div class="card_item_image">
										<img src="<?php echo $hot_articleRow['item4Img2Url']?>">
									</div>
									<h4 class="card_item_name"><?php echo $hot_articleRow['item4name']?></h4>
								</div>
								<div class="clear"></div>
							</div>
							<div class="card_btn_box">
								<button class="btn_s keep_btn" artno="<?php echo $hot_articleRow['artNo']?>" href="php/keep_card.php?<?php echo $hot_articleRow['cardno']?>">收藏它</button>
        <script>
            
$(".card_btn_box .keep_btn").off(click).bind('click',function(){
	var artNo=$(this).attr('artno');
	var xhr = new  XMLHttpRequest();
	xhr.onreadystatechange=function (){
			if( xhr.readyState == 4){
					if( xhr.status == 200 ){
							if(xhr.responseText==1){
									// 原程式後續function
									$.ajax({
										url: 'php/keep_card.php',
										data: {artNo:artNo},
										type: 'GET',
										async: false,
										success: function(data){
											$('#alert p').text(data);
											$('#alert_wrap').css({
												"display":"block",
											});
											$('#alert_wrap .btn_s').click(function(){
												$('#alert_wrap').css({
													"display":"none",
												});
											});
											
										},

										error: function(data){
											// console.log(123);
										}
								});
							}else{
                                // 出現要求登入提示
                                $('#alert_wrap p').text("請登入會員");
                                $('#alert_wrap').css({
                                    "display":"block",
                                });
                                $('#alert_wrap .btn_s').click(function(){
                                    $('#alert_wrap').css({
                                        "display":"none",
                                    });
                                });
							}
					}else{
					alert( xhr.status );
					}
			}
	}
	var url = "php/login_or_not.php?";

	xhr.open("Get", url, true);
	xhr.send( null );
	event.stopPropagation(); 

	// console.log("artNo : ",artNo);

});
        </script>			
        
						
								<button class="btn_s btn_to_custom">
									<form id="to_custom" action="php/forum_to_custom.php">
										<input type="hidden" name="item1No" value="<?php echo $hot_articleRow['item1No']?>">
										<input type="hidden" name="item2No" value="<?php echo $hot_articleRow['item2No']?>">
										<input type="hidden" name="item3No" value="<?php echo $hot_articleRow['item3No']?>">
										<input type="hidden" name="item4No" value="<?php echo $hot_articleRow['item4No']?>">
									</form>
									去客製
								</button>
<script>
$('.btn_to_custom').click(function(){
	$('#to_custom').submit();
	event.stopPropagation() ;
});
</script>	
						
							</div>
						</div>
					</div>

					<div class="hot_forum_hidden ">
						<div class="hot_forum">

							<div class="hot_user_data">
								<div class="user_photo">
									<img src="<?php echo $hot_articleRow['memImgUrl']?>">
								</div>
								<h4 class="user_name"><?php echo $hot_articleRow['memNickname']?></h4>
							</div>
							<h3 class="forum_title">									
								<?php echo $hot_articleRow['artTitle']?>
							</h3>
							<div class="hot_forum_content">
								<div class="content_l">
									
									<div class="hot_forum_data">
										<p class="time"><?php echo $hot_articleRow['artTime']?></p>
										<p class="like">
											<img src="images/solid_heart.png">
										</p>
										<p><?php echo $hot_articleRow['artLikeCount']?></p>
										<p class="msg_count">
											<img src="images/msg_count_icon.png">
										</p>
										<p><?php echo $hot_articleRow['artMesCount']?></p>
										<div class="clear"></div>
									</div>
									<p class="article"><?php echo $hot_articleRow['artText']?></p>
								</div>
								<div class="content_r">
									<div class="radar_wrapper">
										<div id="pointA<?php echo $i ?>" hidden><?php echo $pointAprop ?></div>
										<div id="pointB<?php echo $i ?>" hidden><?php echo $pointBprop ?></div>
										<div id="pointC<?php echo $i ?>" hidden><?php echo $pointCprop ?></div>
									    <canvas id="chartRadar<?php echo $radar;?>" width="300" height="300"></canvas>
									</div>
								</div>
							</div>
							<form action="forum_article.php" method="post">
								<input type="hidden" name="artNo" value="<?php echo $hot_articleRow['artNo'] ?>">
								<input class="btn_s" type="submit" name="submit" value="查看更多">
							</form>
						</div>
					</div>
				</div>	

<?php	
}
?>   
</div>
</div>
    

 <!-- 第四屏 -->
 <div class="my_fourth_page" style="overflow:hidden;">
    
       <div class="fourth_page_wrap">
            <div class="cloud_large">
                <img src="images/cloud_l2.png" alt="">
                <img src="images/cloud_l2.png" alt="">
                <img src="images/cloud_l2.png" alt="">
       </div>

            <div class="cloud_large">
                <img src="images/cloud_l2.png" alt="">
                <img src="images/cloud_l2.png" alt="">
                <img src="images/cloud_l2.png" alt="">
            </div>

        <div class="an_map">
            <!-- 左半邊 -->
            <div class="col-12 col-md-7 mapWrap">
                <!-- 地圖選單群 -->
                <div class="titleWrap">
                    <!-- 地圖標題 -->
                    <div class="an_title">
                        <div class="titleSquare">
                            <h2 class="mapttt">尋找湯先生</h2>
                        </div>
                    </div>
                    <!-- 各分店 -->
                    <div class="an_roomtype">
                        <div class="an_roomtypeIcon">
                            <div class="rommtypeIcon01" id="sopMap01" onclick="showInfo(this)">
                                <!-- <img src="img\icon01.png" alt="中央店"> -->
                                <h3 class="branch">中央店</h3>
                            </div>
                            <div class="rommtypeIcon02" id="sopMap02" onclick="showInfo(this)">
                                <!-- <img src="img\icon01.png" alt="中央店"> -->
                                <h3 class="branch">桃園店</h3>
                            </div>
                            <div class="rommtypeIcon03" id="sopMap03" onclick="showInfo(this)">
                                <!-- <img src="img\icon01.png" alt="中央店"> -->
                                <h3 class="branch">北投店</h3>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- 店家資訊 -->
                <div class="room_info_mobile">
                    <img src="images\map-placeholder.png" alt="座標圖">
                    <p id="adress_m">桃園市中壢區300號</p>
                    <img src="images\phone.png" alt="電話">
                    <p id="phone_m">03-3258778</p>
                </div>
                <!-- 雲地圖 -->
                <div class="cloud_map">
                    <!-- <iframe width="100%" height="500px" frameborder="0" style="border:0" zoom="2"
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1808.4819060454072!2d121.18812335820543!3d24.967345827554638!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x346823eb2609f805%3A0xa6a73a9ed1bee882!2z5Lit5aSu5aSn5a245b6M6ZaA5qmf6LuK5YGc6LuK5aC0!5e0!3m2!1szh-TW!2stw!4v1554538344894!5m2!1szh-TW!2stw">
                    </iframe> -->
                    <div id="mapBoard"></div>
                </div>
            </div>
            <!--右半邊-->
            <div class="col-12 col-md-5 roomPicWrap">
                <!-- 分店幻燈片 -->
                <div class="slideshow-container" style="overflow: hidden;">
                    <div class="mySlides fade" style="position: relative;">
                        <img class="an_roompic" id="an_roompic01" src="images\01.PNG" width='100%'>
                        <div class="text">中央店</div>
                    </div>

                    <div class="mySlides fade" style="position: relative;">
                        <img class="an_roompic" src="images\02.PNG" width='100%'>
                        <div class="text">桃園店</div>
                    </div>

                    <div class="mySlides fade" style="position: relative;">
                        <img class="an_roompic" src="images\03.PNG" width='100%'>
                        <div class="text">北投店</div>
                    </div>
                    <div class="dotWrap">
                        <span class="dot" onclick="currentSlide(1)"></span>
                        <span class="dot" onclick="currentSlide(2)"></span>
                        <span class="dot" onclick="currentSlide(3)"></span>
                    </div>
                </div>
                <!-- 桌機分店資訊 -->
                <div class="room_info">
                    <img src="images\map-placeholder.png" alt="座標圖">
                    <p id="adress_c">桃園市中壢區300號</p>
                    <img src="images\phone.png" alt="電話">
                    <p id="phone_c">03-3258778</p>
                </div>
                <!-- 手機幻燈片左右切換 -->
                <a class="prev" onclick="plusSlides(-1)">❮</a>
                <a class="next" onclick="plusSlides(1)">❯</a>
            </div>
        </div>
        <div class="an_roomc" >
            <a href="reservation.php" class="btn_s" style="z-index: 50;">
                立即訂房
            </a>
        </div>
    </div>
</div>

<!-- 猴子機器人 -->
<div class="chatbot">
    
    <div class="monkeyBotWrap" id="monkeyBotWrap">
        <img class="monkeyBot" id="monkeyBot" src="images\monkeyBot.png" alt="猴子機器">
    </div>
</div>
<div class="chatbotTextWrap" id="chatbotTextWrap" style="display:none;">
<a href="surprise.html"><div class="egg"></div></a>
    <!-- 叉叉 -->
    <div id="close_btn">
        <img src="images\X.png" alt="關閉鍵">
    </div>
    <!-- <div class="botTitle"> -->
    <h2>湯先生客服</h2>
    <!-- </div> -->
    <!-- 對話框 -->
    <div id="chatBot-content" class="clearfix">
        <div id="chatBot-container" class="clearfix">
            <p id="chatBot-content-A" class="chatBot-content-A">HI! 很高興為您服務，您以點擊下方關鍵或是直接輸入詢問內容!</p>
            <div style="clear:both"></div>
        </div>
    </div>
    <ul class="chatBot-keyword" id="chatBot-keyword">
    </ul>
    <div class="chatBot-text-Wrap">
        <button type="submit" id="chatBot-search" class="nextBTN">送出</button>
        <input type="text" class="chatBot-text" id="chatBot-text" placeholder="輸入你的問題" name="userkey">
        <div id="UserText"></div>
    </div>
</div>


 <!-- footer -->
    <footer>
        <!-- <div class="cloud_front">
            <div class="cloud_large">
                <img src="images/cloud_l2.png" alt="">
                <img src="images/cloud_l2.png" alt="">
                <img src="images/cloud_l2.png" alt="">
            </div>
        </div> -->
        <div class="footer_container">
            <div class="footer_row">
                <div class="footer_row01">
                    <figure class="logo">
                        <h1><img style="width:100px;" src="images/Logo_browen.svg" alt=""></h1>
                    </figure>
                    <div class="about_us">
                        <p>感謝您的蒞臨!
                            湯先生專業客製溫泉一直以提供專業及親切的服務為信念，期許能為每一位賓客提供最盡善盡美的服務品質，
                            對於每一次的意見及建議，將是本酒店提供專業服務的最佳能量，我們會持續朝著營造高品質服務目標努力。
                            謹代表本酒店全體同仁致上最真摯之感謝!!
                            更期待與您在相見!!</p>
                    </div>

                </div>

                <div class="store_info">
                    <div class="store_info_colunm">
                        <div class="store_info_wrap">
                            <a href=""><img class="store_info_icon" src="images/mail.png" alt=""></a>
                            <p>mrspring@gmail.info</p>
                        </div>
                        <div class="store_info_wrap">
                            <a href=""><img class="store_info_icon" src="images/facebook.png" alt=""></a>
                            <div class="footer_search_bar">
                                <p style="margin-right:5px;">臉書搜尋&nbsp;:&nbsp;湯先生</p><img src="images/search-solid.svg"
                                    alt="">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="all_rights">
            <h4>Non commercial use&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Copyright © 2019 Mr.Spring All rights
                reserved</h4>
        </div>

    </footer>





<!--js ================================================================== -->

    
    <script src="js/cloudGo.js"></script>
    <script src="js/kasumi.js"></script>
    <script src="js/header.js"></script>
    <!-- <script src="js/login.js"></script> -->
    <script src="js/loginOrNot.js"></script>
    <script src="js/map.js"></script>
    <script src="js/slide.js"></script>
    <script src="js/Chart.js"></script>
    <script src="js/forum.js"></script>
    <script src="js/radar.js"></script>
    
    <script type="text/javascript" src="js/jquery.easing.1.3.js"></script>
    <script type="text/javascript" src="js/hot_forum_radar.js"></script>
    <!-- <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCrMA9a22m_ft2x_W8UDhDpfI2GS7k54kg&callback=initMap">
    </script> -->
    <script async defer
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBYyjU45YbaPkzsTS_4e7sJHSW4tx59W08&callback=initMap">
    </script>
    <script src="js/chatbot.js"></script>
    <!-- <script src="js/waveGo.js"></script> -->
    <script>
        let quesJsonStr = <?php echo $jsonStr_ques ?>;
        console.log(quesJsonStr);
        // 問題描述
        qusP = document.getElementById("qus");
        // 選項們
        ansBtnArr = document.getElementsByClassName("btn_a");
        ansBtn1 = document.getElementById("ans1");
        ansBtn2 = document.getElementById("ans2");
        ansBtn3 = document.getElementById("ans3");
        // 當前題目計數器、各數值計分表啟動
        questionCount = 0;
        totalPointA = 0;
        totalPointB = 0;
        totalPointC = 0;

        // 讓第一題取得內容
        qusP.innerText = quesJsonStr[questionCount].quesText;
        ansBtn1.innerText = quesJsonStr[questionCount].ans1Text;
        ansBtn2.innerText = quesJsonStr[questionCount].ans2Text;
        ansBtn3.innerText = quesJsonStr[questionCount].ans3Text;
        // 在js中記錄個選項分數
        ansBtn1.dataset.point = parseFloat(quesJsonStr[questionCount].ans1Score);
        ansBtn2.dataset.point = parseFloat(quesJsonStr[questionCount].ans2Score);
        ansBtn3.dataset.point = parseFloat(quesJsonStr[questionCount].ans3Score);

        var prevNumber = -1;

        for (i = 0; i < ansBtnArr.length; i++) {
            ansBtnArr[i].addEventListener("click", MrSpringAnswer)
        }

        function MrSpringAnswer() {
            // 計數器增加
            questionCount++;
            // 紀錄分數
            if (questionCount == 1 || questionCount == 2) {
                totalPointA += parseFloat(this.dataset.point);
            } else if (questionCount == 3 || questionCount == 4) {
                totalPointB += parseFloat(this.dataset.point);
            } else if (questionCount == 5 || questionCount == 6) {
                totalPointC += parseFloat(this.dataset.point);
            }
            if (questionCount == 6) {
                //跑動畫，答完6題後
                // document.getElementById(str).style.color = "white";
                var boxOne = document.getElementsByClassName('an_prescription')[0];
                var boxtwo = document.getElementsByClassName('an_cabinet')[0];
                var boxthree = document.getElementsByClassName('monkeyMedPic')[0];
                boxOne.classList.add('an_prescription_animation');
                boxtwo.classList.add('an_cabinet_animation');
                boxthree.classList.add('an_monkey_animation');
                $("#showshower").css("display", "flex").hide(0).fadeIn(2000);

                //藥材結果
                let medicineJsonStr = <?php echo $jsonStr_medicine ?>;
                console.log(medicineJsonStr);
                var comparison = [totalPointA, totalPointB, totalPointC];
                var i = j = t = 0;
                // 分數排序，大到小
                var MedicinePush = document.getElementById('MedicinePush');
                var medicinePic1 = document.getElementById('medicinePic1');
                var medicinePic2 = document.getElementById('medicinePic2');
                var medicinePic3 = document.getElementById('medicinePic3');

                var medicineName1 = document.getElementById('medicineName1');
                var medicineName2 = document.getElementById('medicineName2');
                var medicineName3 = document.getElementById('medicineName3');

                var medicineDic1 = document.getElementById('medicineDic1');
                var medicineDic2 = document.getElementById('medicineDic2');
                var medicineDic3 = document.getElementById('medicineDic3');

                if (totalPointA > totalPointB && totalPointA > totalPointC) {
                    if (totalPointB > totalPointC) {
                        //abc
                        MedicinePush.innerText = '根據諮詢的結果您對舒筋活骨的需求最大，其次是安定心神最後是養顏美容，因此我們為您推薦:';

                        medicinePic1.src = medicineJsonStr[0].itemImg4Url;
                        medicineName1.innerText = medicineJsonStr[0].itemName;
                        medicineDic1.innerText = medicineJsonStr[0].itemText;
                        medicineNo1 = medicineJsonStr[0].itemNo;

                        medicinePic2.src = medicineJsonStr[4].itemImg4Url;
                        medicineName2.innerText = medicineJsonStr[4].itemName;
                        medicineDic2.innerText = medicineJsonStr[4].itemText;
                        medicineNo2 = medicineJsonStr[4].itemNo;

                        medicinePic3.src = medicineJsonStr[8].itemImg4Url;
                        medicineName3.innerText = medicineJsonStr[8].itemName;
                        medicineDic3.innerText = medicineJsonStr[8].itemText;
                        medicineNo3 = medicineJsonStr[8].itemNo;
                    } else {
                        //acb
                        MedicinePush.innerText = '根據諮詢的結果您對舒筋活骨的需求最大，其次是養顏美容最後是安定心神，因此我們為您推薦:';

                        medicinePic1.src = medicineJsonStr[0].itemImg4Url;
                        medicineName1.innerText = medicineJsonStr[0].itemName;
                        medicineDic1.innerText = medicineJsonStr[0].itemText;
                        medicineNo1 = medicineJsonStr[0].itemNo;

                        medicinePic2.src = medicineJsonStr[7].itemImg4Url;
                        medicineName2.innerText = medicineJsonStr[7].itemName;
                        medicineDic2.innerText = medicineJsonStr[7].itemText;
                        medicineNo2 = medicineJsonStr[7].itemNo;

                        medicinePic3.src = medicineJsonStr[5].itemImg4Url;
                        medicineName3.innerText = medicineJsonStr[5].itemName;
                        medicineDic3.innerText = medicineJsonStr[5].itemText;
                        medicineNo3 = medicineJsonStr[5].itemNo;
                    }
                } else if (totalPointB > totalPointA && totalPointB > totalPointC) {
                    if (totalPointA > totalPointC) {
                        //bac
                        MedicinePush.innerText = '根據諮詢的結果您對安定心神的需求最大，其次是舒筋活骨最後是養顏美容，因此我們為您推薦:';

                        medicinePic1.src = medicineJsonStr[3].itemImg4Url;
                        medicineName1.innerText = medicineJsonStr[3].itemName;
                        medicineDic1.innerText = medicineJsonStr[3].itemText;
                        medicineNo1 = medicineJsonStr[3].itemNo;

                        medicinePic2.src = medicineJsonStr[1].itemImg4Url;
                        medicineName2.innerText = medicineJsonStr[1].itemName;
                        medicineDic2.innerText = medicineJsonStr[1].itemText;
                        medicineNo2 = medicineJsonStr[7].itemNo;

                        medicinePic3.src = medicineJsonStr[8].itemImg4Url;
                        medicineName3.innerText = medicineJsonStr[8].itemName;
                        medicineDic3.innerText = medicineJsonStr[8].itemText;
                        medicineNo3 = medicineJsonStr[8].itemNo;
                    } else {
                        //bca
                        MedicinePush.innerText = '根據諮詢的結果您對安定心神的需求最大，其次是養顏美容最後是舒筋活骨，因此我們為您推薦:';

                        medicinePic1.src = medicineJsonStr[3].itemImg4Url;
                        medicineName1.innerText = medicineJsonStr[3].itemName;
                        medicineDic1.innerText = medicineJsonStr[3].itemText;
                        medicineNo1 = medicineJsonStr[3].itemNo;

                        medicinePic2.src = medicineJsonStr[4].itemImg4Url;
                        medicineName2.innerText = medicineJsonStr[4].itemName;
                        medicineDic2.innerText = medicineJsonStr[4].itemText;
                        medicineNo2 = medicineJsonStr[4].itemNo;

                        medicinePic3.src = medicineJsonStr[2].itemImg4Url;
                        medicineName3.innerText = medicineJsonStr[2].itemName;
                        medicineDic3.innerText = medicineJsonStr[2].itemText;
                        medicineNo3 = medicineJsonStr[2].itemNo;
                    }
                } else if (totalPointC > totalPointA && totalPointC > totalPointB) {
                    if (totalPointA > totalPointB) {
                        //cab
                        MedicinePush.innerText = '根據諮詢的結果您對養顏美容的需求最大，其次是舒筋活骨最後是安定心神，因此我們為您推薦:';

                        medicinePic1.src = medicineJsonStr[6].itemImg4Url;
                        medicineName1.innerText = medicineJsonStr[6].itemName;
                        medicineDic1.innerText = medicineJsonStr[6].itemText;
                        medicineNo1 = medicineJsonStr[6].itemNo;

                        medicinePic2.src = medicineJsonStr[1].itemImg4Url;
                        medicineName2.innerText = medicineJsonStr[1].itemName;
                        medicineDic2.innerText = medicineJsonStr[1].itemText;
                        medicineNo2 = medicineJsonStr[1].itemNo;

                        medicinePic3.src = medicineJsonStr[5].itemImg4Url;
                        medicineName3.innerText = medicineJsonStr[5].itemName;
                        medicineDic3.innerText = medicineJsonStr[5].itemText;
                        medicineNo3 = medicineJsonStr[5].itemNo;
                    } else {
                        //cba
                        MedicinePush.innerText = '根據諮詢的結果您對養顏美容的需求最大，其次是安定心神最後是舒筋活骨，因此我們為您推薦:';

                        medicinePic1.src = medicineJsonStr[6].itemImg4Url;
                        medicineName1.innerText = medicineJsonStr[6].itemName;
                        medicineDic1.innerText = medicineJsonStr[6].itemText;
                        medicineNo1 = medicineJsonStr[6].itemNo;

                        medicinePic2.src = medicineJsonStr[4].itemImg4Url;
                        medicineName2.innerText = medicineJsonStr[4].itemName;
                        medicineDic2.innerText = medicineJsonStr[4].itemText;
                        medicineNo2 = medicineJsonStr[4].itemNo;

                        medicinePic3.src = medicineJsonStr[2].itemImg4Url;
                        medicineName3.innerText = medicineJsonStr[2].itemName;
                        medicineDic3.innerText = medicineJsonStr[2].itemText;
                        medicineNo3 = medicineJsonStr[2].itemNo;
                    }
                } else {
                    //有等於的時候
                    MedicinePush.innerText = '根據諮詢的結果您最近身心靈處於需要深入滋補狀況，因此我們為您推薦綜合配方如下:';

                    medicinePic1.src = medicineJsonStr[0].itemImg4Url;
                    medicineName1.innerText = medicineJsonStr[0].itemName;
                    medicineDic1.innerText = medicineJsonStr[0].itemText;
                    medicineNo1 = medicineJsonStr[0].itemNo;


                    medicinePic2.src = medicineJsonStr[3].itemImg4Url;
                    medicineName2.innerText = medicineJsonStr[3].itemName;
                    medicineDic2.innerText = medicineJsonStr[3].itemText;
                    medicineNo2 = medicineJsonStr[3].itemNo;

                    medicinePic3.src = medicineJsonStr[6].itemImg4Url;
                    medicineName3.innerText = medicineJsonStr[6].itemName;
                    medicineDic3.innerText = medicineJsonStr[6].itemText;
                    medicineNo3 = medicineJsonStr[6].itemNo;
                }

                url_with_session = "save_consult.php?";
                url_with_session += `medicineNo1=${medicineNo1}&`;
                url_with_session += `medicineNo2=${medicineNo2}&`;
                url_with_session += `medicineNo3=${medicineNo3}`;

                document.getElementById("go_custom_with_session").addEventListener("click", function() {
                    // document.location.href = url_with_session;
                    window.location = url_with_session;
                });


                return;
            }

            // 改變題目、選項文字、分數
            qusP.innerText = quesJsonStr[questionCount].quesText;
            ansBtn1.innerText = quesJsonStr[questionCount].ans1Text;
            ansBtn2.innerText = quesJsonStr[questionCount].ans2Text;
            ansBtn3.innerText = quesJsonStr[questionCount].ans3Text;
            ansBtn1.dataset.point = parseFloat(quesJsonStr[questionCount].ans1Score);
            ansBtn2.dataset.point = parseFloat(quesJsonStr[questionCount].ans2Score);
            ansBtn3.dataset.point = parseFloat(quesJsonStr[questionCount].ans3Score);

            // 改變題號、進度條樣式
            document.getElementsByClassName("an_circle1")[questionCount - 1].style.backgroundImage = "url('images/cir.png')";
            document.getElementById('qn').innerText = `Q${questionCount+1}`;

            // 櫃子
            if (prevNumber != -1) {
                document.getElementsByClassName('extend')[prevNumber].style.width = "0";
            }
            var extendnumber = Math.floor(Math.random() * 8);
            var extend = document.getElementsByClassName('extend')[extendnumber];
            extend.style.width = '30px';
            prevNumber = extendnumber;
        }
    </script>
    <!-- 客製存session -->
    <?php
    require_once("php/connectBooks.php");
    ?>



    
</body>
</html>