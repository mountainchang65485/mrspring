<?php 
    $_SESSION["where"] = $_SERVER['REQUEST_URI'];
?>


<?php
try{
  require_once("php/j_connect.php");
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
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
	<title>Document</title>
	<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
	<link rel="stylesheet" type="text/css" href="css/share.css">
	<link rel="stylesheet" type="text/css" href="css/hot_forum.css">
	<link rel="stylesheet" type="text/css" href="css/forum.css">
	<link rel="stylesheet" type="text/css" href="css/card.css">
	<link rel="stylesheet" type="text/css" href="css/fonts.css">
  <link rel="stylesheet" href="css/signin.css">
  <link rel="stylesheet" href="css/header.css">
	<script type="text/javascript" src="js/jquery-3.3.1.min.js"></script>
	<script type="text/javascript" src="js/jquery-ui.min.js"></script>
	<script src="js/Chart.js"></script>
	<script src="js/forum.js"></script>
</head>

<body>
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


<!-- <-- ------------hotforum start-------------- --> 
<div id="alert_wrap">
	<div id="alert">
		<p></p>
		<div class="btn_s">確定</div>
	</div>
</div>
<div class="bg forum_bg">
<div class="wrap forum_wrap">
			<h2 class="hot_forum_heading">熱門湯牌</h2>
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
$(".card_btn_box .keep_btn").bind('click',function(){
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
								
								
								
								<button class="btn_s" href="">去客製</button>
						
							</div>
						</div>
					</div>

					<div class="hot_forum_hidden ">
						<div class="hot_forum">

							<div class="hot_user_data">
								<div class="user_photo">
									<img src="images/user_photo.png">
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
    
<!-- /*------------hotforum end-------------*/ -->

    <script type="text/javascript" src="js/hot_forum_radar.js"></script>
    <script src="js/header.js"></script>
</body>
</html>