<?php 
	 
	 $_SESSION["where"] = $_SERVER['REQUEST_URI'];
?>
<?php 
if(isset($_SESSION['memNo'])){
	header('location:forum.php');
}
try{
  require_once("php/j_connect.php");
  	$sql = "select *
			from card c
			left outer  join (
				select a.effectTypeNo item1type,a.pointA item1pointA,a.pointB item1pointB,a.pointC item1pointC,a.itemImg2Url item1Img2Url,a.itemname item1name,b.cardno
				from carditem1 b
				left outer join item a
				on a.itemno = b.item1no)as a using(cardNo)
			left outer  join (
				select a.effectTypeNo item2type,a.pointA item2pointA,a.pointB item2pointB,a.pointC item2pointC,a.itemImg2Url item2Img2Url,a.itemname item2name,b.cardno
				from carditem2 b
				left outer join item a
				on a.itemno = b.item2no)as b using(cardNo)
			left outer  join (
				select a.effectTypeNo item3type,a.pointA item3pointA,a.pointB item3pointB,a.pointC item3pointC,a.itemImg2Url item3Img2Url,a.itemname item3name,b.cardno
				from carditem3 b
				left outer join item a
				on a.itemno = b.item3no)as c using(cardNo)
			left outer  join (
				select a.effectTypeNo item4type,a.pointA item4pointA,a.pointB item4pointB,a.pointC item4pointC,a.itemImg2Url item4Img2Url,a.itemname item4name,b.cardno
				from carditem4 b
				left outer join item a
				on a.itemno = b.item4no)as d using(cardNo)
			where memNo = ".$_SESSION['memNo']." and cardStatus <> 0;";
			//mem_card
		$sql2 = "select *
				from card c
				left outer  join (
					select a.effectTypeNo item1type,a.pointA item1pointA,a.pointB item1pointB,a.pointC item1pointC,a.itemImg2Url item1Img2Url,a.itemname item1name,b.cardno
					from carditem1 b
					left outer join item a
					on a.itemno = b.item1no)as a using(cardNo)
				left outer  join (
					select a.effectTypeNo item2type,a.pointA item2pointA,a.pointB item2pointB,a.pointC item2pointC,a.itemImg2Url item2Img2Url,a.itemname item2name,b.cardno
					from carditem2 b
					left outer join item a
					on a.itemno = b.item2no)as b using(cardNo)
				left outer  join (
					select a.effectTypeNo item3type,a.pointA item3pointA,a.pointB item3pointB,a.pointC item3pointC,a.itemImg2Url item3Img2Url,a.itemname item3name,b.cardno
					from carditem3 b
					left outer join item a
					on a.itemno = b.item3no)as c using(cardNo)
				left outer  join (
					select a.effectTypeNo item4type,a.pointA item4pointA,a.pointB item4pointB,a.pointC item4pointC,a.itemImg2Url item4Img2Url,a.itemname item4name,b.cardno
					from carditem4 b
					left outer join item a
					on a.itemno = b.item4no)as d using(cardNo)
				where memNo = ".$_SESSION['memNo']." and cardStatus <> 0;";
	
	$mem_card = $pdo -> query($sql);
	$mem_card_num = $pdo -> query($sql);
	$mem_card_numRow = $mem_card_num->fetchAll(PDO::FETCH_ASSOC);


}catch(PDOException $e){
	$errMsg .= "???????????? : ".$e -> getMessage(). "<br>";
	$errMsg .= "???????????? : ".$e -> getLine(). "<br>";
}





 ?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta charset="UTF-8">
	<title>????????? Mr.Spring - ?????????????????????</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="css/fonts.css">
	<link rel="stylesheet" type="text/css" href="css/forum.css">
	<link rel="stylesheet" type="text/css" href="css/share.css">
	<link rel="stylesheet" type="text/css" href="css/card.css">
    <link rel="stylesheet" href="css/lightbox.css">
	<link rel="stylesheet" href="css/slick.css">
	<link rel="stylesheet" href="css/signin.css">
    <link rel="stylesheet" href="css/header.css">
	<script src="js/jquery-3.3.1.min.js"></script>
</head>
<?php
if(count($mem_card_numRow)==0){
	echo "??????????????????!??????2????????????";
	header("Refresh:2;url=forum.php");
}else{
	

?>
<body>
	 <!-- ????????? -->
	 <header>
        <nav id="nav_bar">
            <!-- <span id="memName"></span> -->


            <script src="js/g4CheckLogin.js"></script>
            
            
            <!-- <input type="hidden" name="memId" id="memId"> -->

            <ul id="banner">
                <a class="flag" href="custom.php">
                    <h2>????????????</h2>
                </a>
                <a class="flag" href="reservation.php">
                    <h2>????????????</h2>
                </a>
                <a class="flag" href="home.php">
                    <h1> <img id="mrSpringLogo_w" style="width:118.7px; " src="images/mrSpringLogo_W.svg" alt="?????????">
                        <img id="mrSpringLogo" style="width:110px;" src="images/mrSpringLogo.svg" alt="?????????"></h1>
                </a>
                <a class="flag" href="forum.php">
                    <h2 class="headerNow">????????????</h2>
                </a>
                <a class="flag" id="headerMemberLink">
                    <h2>????????????</h2>
                </a>
            </ul>
        </nav>

        

        <div id="nav_wrapper">
            <h1 id="mt_logo">
                <a href="home.php"><img src="images/logoHorizon.svg" alt="Mr.Spring Logo"></a>
            </h1>
            <!-- <div class="nav_icon_wrap">
                <span class="loginTextWarp">
                     <span class="loginTextS" style="color:rgb(200, 169, 125);">??????</span>
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
                <img id="LoginHere" src="images/account.svg" alt="????????????" style=" margin:auto;">
             </span>
                <span id="loginText" style="color:rgb(200, 169, 125);">??????</span>
            </div>
        <div class="overlay" id="overlay">

            <nav class="overlay-menu">
                <ul>
                    <li><a href="home.php">Home</a></li>
                    <li><a href="custom.php">????????????</a></li>
                    <li><a href="reservation.php">????????????</a></li>
                    <li><a href="forum.php">????????????</a></li>
                    <li><a id="MobileHeaderMemberLink">????????????</a></li>
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
    
    <!-- ??????????????? -->
    <div id="lightBox" style=" z-index: 1000; position:fixed; display:none;">

        <!-- ?????? -->
        <div id="login" class="table_wrap">
            
        <div style="text-align:center;">

                <!-- ??????logo -->
                <figure id="login_img" class="Login_pic">
                    <img src="images/Logo_browen.svg" alt="?????????">
                </figure>

                <!-- ??????????????? -->
                <form id="signin_img" class="Login_pic" enctype="multipart/form-data" action="signinUpload.php" method="post">
                    <label class="signin_label">
                        <input type="file" name="memUpFile" id="upFile" >
                        <div class="imgPreview"><img id="imgPreview" src="images/Logo_browen.svg" alt="????????????">
                            <i class="fas fa-camera"></i></div>
                    </label>
        </div>

            <!--?????????????????????  -->
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
                <p id="login_test" class="Login_title">????????????</p>
                </div>
            <div id="t1">
                <table  id="tableLogin" class="table_data">

                    <tr>
                        <td>
                            <label>??????</label>
                            <input type="text" id="memId" name="memId"  placeholder="example123">
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label>??????</label>
                            <input type="password" id="memPsw" name="memPsw" placeholder="******">
                        </td>
                    </tr>
                </table>
            </div>

            <div id="t2">
                <table   id="table_signin" class="table_data">
                    
                    <tr>
                        <td>
                            <label>??????</label>
                            <input type="text" id="memId_s" name="memId_s" placeholder="??????2~10?????????" maxlength="10"
                                minlength="2" autocomplete="off"  pattern="[A-z0-9]{2-10}">
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label>??????</label>
                            <input type="password" id="memPsw_s" name="memPsw_s" placeholder="******" maxlength="10"
                                autocomplete="off" >
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label>??????</label>
                            <input type="text" name="memFirstName" id="memLastName" placeholder="???" maxlength="10"
                                autocomplete="off" >
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <label>??????</label>
                            <input type="text" name="memLastName" id="memFirstName" placeholder="??????" maxlength="10"
                                autocomplete="off" >
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <label>??????</label>
                            <input type="text" name="memNickname" id="memNickname" placeholder="???????????????" maxlength="10"
                                autocomplete="off" >
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <label>?????????</label>
                            <input type="text" name="twId" id="twId" placeholder="S123456789" maxlength="10"
                                autocomplete="off" >
                        </td>
                    </tr>

                    
                    <tr>
                        <td>
                            <label>??????</label>
                            <input type="email" name="memEmail" id="memEmail" placeholder="mrspring@email.com"
                                autocomplete="off" >
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label>??????</label>
                            <input type="tel" name="memTel" id="memTel" placeholder="0912345678" maxlength="10"
                                autocomplete="off" >
                        </td>
                    </tr>
                </table>
            </div>

            <div class="btn_wrap">
            <div style="text-align:center;">
            <input type="button" name="login" for="form_table" class="btn_s btnLogin" id="btnLogin" value="??????"
                        style="color:rgb(112, 95, 69); border:1.5px solid rgb(145, 123, 91);">
                    <input type="submit" name="sign" for="signin_img" class="btn_s btnLogin" id="btn_signin" value="??????"
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
                <!-- <span>??????</span> -->
                    
                    <button class="btn_s" id="btnLoginCancel" value="??????">
                        <div class="x_x">
                            <span class="top"></span>
                            <span class="bottom"></span>
                        </div>
                    </button>
                    </div>
            </div>
            <div style="text-align:center;">
                <button type="button" id="test_btn" class="first_time" onclick="memberFunction()">???????????????????</button>
            </div>
        </div>

        <!-- ???????????????????????????============================================================================ -->

        
        
    </div>

    <div>



    </div>
    <div id="gowhere"style="display:none;">
        <div id="gowhere_container">
        
            <div style="text-align:center;">
                    <p id="login_test" class="Login_title">??????????</p>
            </div>


            <div class="btn_wrap">
                <div style="text-align:center;">
                    <input type="button" name="login" for="form_table" class="btn_s btnLogin" id="btnLoginAfter"
                        value="???????????????" style="color:rgb(112, 95, 69); border:1.5px solid rgb(145, 123, 91);">
                    <input type="button" name="sign" for="signin_img" class="btn_s btnLogin" id="btn_signinAfter"
                        value="??????"
                        style="color:rgb(112, 95, 69);margin:auto; border:1.5px solid rgb(145, 123, 91);">
                    


                    <!-- <script>
                        document.getElementById("btn_signin").onclick= function(){
                            document.getElementById("signin_img").submit();
                        }
                    </script> -->
                    <!-- <span>??????</span> -->

                    <button class="btn_s" id="btnLoginCancelAfter" value="??????">
                        <div class="x_x">
                            <span class="top"></span>
                            <span class="bottom"></span>
                        </div>
                    </button>
                </div>
            </div>
        </div>
          
    </div>

    <!-- ??????js -->
        <script>
            function memberFunction() {
                var w = document.getElementById('btnLogin');
                w.innerHTML = "??????"
                var x = document.getElementById('login_test');
                x.innerHTML = "????????????";
                var y = document.getElementById('test_btn');
                // y.innerHTML = "?????????????????????";
                if (y.innerHTML == '?????????????????????') {
                    y.innerHTML = '???????????????????';
                    x.innerHTML = "????????????";
                    // w.innerHTML = "??????";
                    document.getElementById('t2').style.display = 'none';
                    document.getElementById('t1').style.display = 'block';
                    document.getElementById('signin_img').style.display = 'none';
                    document.getElementById('login_img').style.display = 'block';
                    document.getElementById('btnLogin').style.display = 'block';
                    document.getElementById('btn_signin').style.display = 'none';

                } else {
                    y.innerHTML = "?????????????????????";
                    document.getElementById('t2').style.display = 'block';
                    document.getElementById('t1').style.display = 'none';
                    document.getElementById('signin_img').style.display = 'block';
                    document.getElementById('login_img').style.display = 'none';
                    document.getElementById('btnLogin').style.display = 'none';
                    document.getElementById('btn_signin').style.display = 'block';
                }
            }
        </script>
    

    <!-- ?????????SESSION -->
    <script>
    function $id(id){
    	return document.getElementById(id);
    }	
        function showLoginForm(){
          //????????????bar????????? spanLogin ????????????????????????
          //?????????????????????????????????????????????(lightBox)
          //???????????????
          //?????????bar????????????????????????????????? 
          //spanLogin??????????????????
          //????????????????????????????????????
          
          if($id('loginText').innerHTML == "??????"){
            $id('lightBox').style.display = 'block';
            $id("LoginHere").src = "images/account.svg";
            $id("LoginHere").style.width = "100%";
          }else{ //??????????????????
            $id('gowhere').style.display = 'block';
            $id('btnLoginAfter').onclick = G4goMember;
            $id('btn_signinAfter').onclick = G4LogOut;
            function G4goMember(){
                location.href = "member.php";
            }

            function G4LogOut(){
                $id('loginText').innerHTML = '??????';
                $id("LoginHere").src = "images/account.svg";
                $id("LoginHere").style.width = "100%";
                //???session?????????
                var xhr = new XMLHttpRequest();
                xhr.onload = function(){  //?????????????????????????????????????????????
                  if( xhr.status == 200){
                    // alert(xhr.responseText); 
                  }
                }
                xhr.open("get", "php/loginOut.php",true);
                xhr.send(null);
                $id('gowhere').style.display = 'none';
                location.href = `${sessionStorage.getItem('URL')}`;
            }
            
          }

        }//showLoginForm

        function sendForm(){
          //=====??????Ajax ???server???,?????????????????????, ???????????????    
          var xhr = new XMLHttpRequest();
          xhr.onload = function(){
            // console.log(123);
            if(xhr.status == 200){
              if( xhr.responseText == "notFound"){
                alert("????????????");
              }else{
                // $id("memName").innerHTML = memInfo.memFirstName;
                // $id('loginText').innerHTML = "??????";
                console.log(xhr.responseText)
                $id("LoginHere").src = xhr.responseText;
                $id("loginText").innerHTML = "??????";
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


          //???????????????????????????????????????????????????
          $id('lightBox').style.display = 'none';
          $id('memId').value = '';
          $id('memPsw').value = '';

        }

        function cancelLogin(){
          //????????????????????????????????????????????????????????????
          $id('lightBox').style.display = 'none';
          $id('memId').value = '';
          $id('memPsw').value = '';
        //   $id("loginHereWrap").style.border = "unset";
        }

        
        function cancelLogOut(){
          //????????????????????????????????????????????????????????????
          $id('gowhere').style.display = 'none';
        }


    window.addEventListener("load", function(){
       //???????????????....
        //.....??????????????????
        // var xhr = new XMLHttpRequest();
        // xhr.onload = function(){
        //   if( xhr.status == 200){
        //     if( xhr.responseText != "notFound"){ //?????????
        //     //   $id("memName").innerHTML = xhr.responseText;
        //       $id("loginText").innerHTML = "??????";
        //       $id("LoginHere").style.width = "50px";
        //       $id("loginHereWrap").style.borderColor = "rgb(200, 169, 125)";
        //     }
        //   }
        // }
        // xhr.open("get", "php/afterLogin.php", true);
        // xhr.send(null);  

        //?????????????????????....
        //===??????spanLogin.onclick ????????????????????? showLoginForm

        $id('memPic').onclick = showLoginForm;

        //===??????btnLogin.onclick ????????????????????? sendForm
        $id('btnLogin').onclick = sendForm;

        //===??????btnLoginCancel.onclick ????????????????????? cancelLogin
        $id('btnLoginCancel').onclick = cancelLogin;

        $id("btnLoginCancelAfter").onclick=cancelLogOut;

    })  

    </script>
	<!-- ========================???????????????============================= -->
	<div id="alert_wrap">
		<div id="alert">
			<p></p>
			<div class="btn_s">??????</div>
		</div>
	</div>
	<div class="forum_bg bg article_publish_bg">
		<div class="forum_wrap article_publish_wrap">
			<div class="article_publish">
			<button class="add_card btn_s springCard">????????????</button>
			<div class="selected_card_data">
				??????????????????
			</div>
			<section id="lightbox_wrapper">
		        <div id="lightbox">
		            <!-- <div id="lightboxToggle"></div> -->
		            <div id="lightbox_radar_mask"></div>
		            <div id="lightbox_radar">
	            		<div id="lightbox_radar_close" class="btn_s">??????</div>
	            		<div id="lightbox_radar_wrapper">
					        <canvas id="chartRadar" width="300" height="300"></canvas>
					    </div>
	            	</div>
		            <div class="chooseCard_d">
		                <h3>????????????</h3>
		                <div id="lightbox_filter_mask"></div>
		                <div class="lightbox_filter">
		                	<img src="images/filter.png">
		            		<select id="lightbox_filter_select">
		            			<option value="1">????????????</option>
		            			<option value="2">????????????</option>
		            			<option value="3">???????????????</option>
							</select>
<script>
$(document).ready(function(){
	$('#lightbox_filter_select').change(function(){
		console.log($(this).val());
		if($(this).val()==1){
			$('.cards').css('display','block');
		}else if($(this).val()==2){
			for(var i=0;i<$('.cards').length;i++){
				if($('.cards').eq(i).hasClass('keep')){
					$('.cards').eq(i).css('display','none');
				}else{
					$('.cards').eq(i).css('display','block');
				}
			}
		}else if($(this).val()==3){
			for(var i=0;i<$('.cards').length;i++){
				if($('.cards').eq(i).hasClass('keep')){
					$('.cards').eq(i).css('display','block');
				}else{
					$('.cards').eq(i).css('display','none');
				}
			}
		}
	});
});
</script>
		            	</div>
		                <label for="lightbox_radar" id="lightbox_radar_btn"><img src="images/info_icon.png"></label>
		            	
		                <!-- <div class="select-box">
		                    <label for="select-box1" class="label select-box1"><span class="label-desc">????????????</span> </label>
		                    <select id="select-box1" class="select">
		                        <option value="Choice 1">????????????</option>
		                        <option value="Choice 2">????????????</option>
		                        <option value="Choice 3">???????????????</option>
		                    </select>  
						</div> -->
						<script>
$(document).ready(function(){
	$('#select-box1').change(function(){
		console.log($(this).val());
		if($(this).val()==1){
			$('.cards').css('display','block');
		}else if($(this).val()==2){
			for(var i=0;i<$('.cards').length;i++){
				if($('.cards').eq(i).hasClass('keep')){
					$('.cards').eq(i).css('display','none');
				}else{
					$('.cards').eq(i).css('display','block');
				}
			}
		}else if($(this).val()==3){
			for(var i=0;i<$('.cards').length;i++){
				if($('.cards').eq(i).hasClass('keep')){
					$('.cards').eq(i).css('display','block');
				}else{
					$('.cards').eq(i).css('display','none');
				}
			}
		}
	});
});
</script>
<?php
if(count($mem_card_numRow)>0){
?>
		                <div class="chooseCardArea_d">
		                    <div class="responsive">



<?php



	$i=0;
	while ($mem_cardRow = $mem_card->fetch(PDO::FETCH_ASSOC)) {
	$i++;
	$cardTextArr = str_split($mem_cardRow['cardText']);
	$null = count($cardTextArr);
	if($null<6){
		for($x=0;$x<6-$null;$x++){
			$cardTextArr[]="";
		}
	}
	if($mem_cardRow['artNo']!=""||$mem_cardRow['artNo']!=null){
		$keep = "keep";
	}else{
		$keep = "";
	}
	?>	

								<div class="cards <?php echo $keep ?>">
		                            <div class="card card<?php echo $i ?>" cardNo="<?php echo $mem_cardRow['cardNo'] ?>" cardPrice="<?php echo $mem_cardRow['cardPrice'] ?>">
										<img class="knot" src="images/knot<?php echo $mem_cardRow['effectTypeNo'] ?>.png" alt="knot">
										<div class="front">
										<div class="draw">
											<div class="drawingArea" style="display: block;">
													<div class="circle circle0" style="transform: rotate(120deg); transform-origin: 50% 50%; color: <?php echo $mem_cardRow['cardTextColor1'] ?>;">
															<p class="futura_R"
																	style="transform: rotate(378deg); left: -4.58359px; top: -58.8254px; opacity: 1;font-family: <?php echo $mem_cardRow['cardFont'] ?>;"><?php echo $cardTextArr[0] ?>
																	</php>
															<p class="futura_R"
																	style="transform: rotate(306deg); left: -31.4164px; top: -50.1068px; opacity: 1;font-family: <?php echo $mem_cardRow['cardFont'] ?>;"><?php echo $cardTextArr[0] ?>
																	</p>
															<p class="futura_R"
																	style="transform: rotate(234deg); left: -31.4164px; top: -21.8932px; opacity: 1;font-family: <?php echo $mem_cardRow['cardFont'] ?>;"><?php echo $cardTextArr[0] ?>
																	</p>
															<p class="futura_R"
																	style="transform: rotate(162deg); left: -4.58359px; top: -13.1746px; opacity: 1;font-family: <?php echo $mem_cardRow['cardFont'] ?>;"><?php echo $cardTextArr[0] ?>
																	</p>
															<p class="futura_R"
																	style="transform: rotate(90deg); left: 12px; top: -36px; opacity: 1;font-family: <?php echo $mem_cardRow['cardFont'] ?>;"><?php echo $cardTextArr[0] ?>
																	</p>
													</div>
													<div class="circle circle1" style="transform: rotate(123deg); transform-origin: 50% 50%; color: <?php echo $mem_cardRow['cardTextColor2'] ?>;">
															<p class="futura_R"
																	style="transform: rotate(330deg); left: -36px; top: -77.5692px; opacity: 1;font-family: <?php echo $mem_cardRow['cardFont'] ?>;"><?php echo $cardTextArr[1] ?>
																	</p>
															<p class="futura_R"
																	style="transform: rotate(210deg); left: -36px; top: 5.56922px; opacity: 1;font-family: <?php echo $mem_cardRow['cardFont'] ?>;"><?php echo $cardTextArr[1] ?>
																	</p>
															<p class="futura_R"
																	style="transform: rotate(90deg); left: 36px; top: -36px; opacity: 1;font-family: <?php echo $mem_cardRow['cardFont'] ?>;"><?php echo $cardTextArr[1] ?>
																	</p>
													</div>
													<div class="circle circle2" style="transform: rotate(126deg); transform-origin: 50% 50%; color: <?php echo $mem_cardRow['cardTextColor3'] ?>;">
																	<p class="futura_R"
																			style="transform: rotate(417.273deg); left: 48.5703px; top: -74.9261px; opacity: 1;font-family: <?php echo $mem_cardRow['cardFont'] ?>;"><?php echo $cardTextArr[2] ?>
																			</p>
																	<p class="futura_R"
																			style="transform: rotate(384.545deg); left: 17.9099px; top: -101.494px; opacity: 1;font-family: <?php echo $mem_cardRow['cardFont'] ?>;"><?php echo $cardTextArr[2] ?>
																			</p>
																	<p class="futura_R"
																			style="transform: rotate(351.818deg); left: -22.2467px; top: -107.267px; opacity: 1;font-family: <?php echo $mem_cardRow['cardFont'] ?>;"><?php echo $cardTextArr[2] ?>
																			</p>
																	<p class="futura_R"
																			style="transform: rotate(319.091deg); left: -59.15px; top: -90.414px; opacity: 1;font-family: <?php echo $mem_cardRow['cardFont'] ?>;"><?php echo $cardTextArr[2] ?>
																			</p>
																	<p class="futura_R"
																			style="transform: rotate(286.364deg); left: -81.0835px; top: -56.2847px; opacity: 1;font-family: <?php echo $mem_cardRow['cardFont'] ?>;"><?php echo $cardTextArr[2] ?>
																			</p>
																	<p class="futura_R"
																			style="transform: rotate(253.636deg); left: -81.0835px; top: -15.7153px; opacity: 1;font-family: <?php echo $mem_cardRow['cardFont'] ?>;"><?php echo $cardTextArr[2] ?>
																			</p>
																	<p class="futura_R"
																			style="transform: rotate(220.909deg); left: -59.15px; top: 18.414px; opacity: 1;font-family: <?php echo $mem_cardRow['cardFont'] ?>;"><?php echo $cardTextArr[2] ?>
																			</p>
																	<p class="futura_R"
																			style="transform: rotate(188.182deg); left: -22.2467px; top: 35.2671px; opacity: 1;font-family: <?php echo $mem_cardRow['cardFont'] ?>;"><?php echo $cardTextArr[2] ?>
																			</p>
																	<p class="futura_R"
																			style="transform: rotate(155.455deg); left: 17.9099px; top: 29.4935px; opacity: 1;font-family: <?php echo $mem_cardRow['cardFont'] ?>;"><?php echo $cardTextArr[2] ?>
																			</p>
																	<p class="futura_R"
																			style="transform: rotate(122.727deg); left: 48.5703px; top: 2.92614px; opacity: 1;font-family: <?php echo $mem_cardRow['cardFont'] ?>;"><?php echo $cardTextArr[2] ?>
																			</p>
																	<p class="futura_R"
																			style="transform: rotate(90deg); left: 60px; top: -36px; opacity: 1;font-family: <?php echo $mem_cardRow['cardFont'] ?>;"><?php echo $cardTextArr[2] ?>
																			</p>
													</div>
													<div class="circle circle3" style="transform: rotate(129deg); transform-origin: 50% 50%; color: <?php echo $mem_cardRow['cardTextColor4'] ?>;">
																	<p class="futura_R"
																			style="transform: rotate(398.571deg); left: 47.855px; top: -111.056px; opacity: 1;font-family: <?php echo $mem_cardRow['cardFont'] ?>;"><?php echo $cardTextArr[3] ?>
																			</p>
																	<p class="futura_R"
																			style="transform: rotate(347.143deg); left: -33.362px; top: -129.593px; opacity: 1;font-family: <?php echo $mem_cardRow['cardFont'] ?>;"><?php echo $cardTextArr[3] ?>
																			</p>
																	<p class="futura_R"
																			style="transform: rotate(295.714deg); left: -98.493px; top: -77.6528px; opacity: 1;font-family: <?php echo $mem_cardRow['cardFont'] ?>;"><?php echo $cardTextArr[3] ?>
																			</p>
																	<p class="futura_R"
																			style="transform: rotate(244.286deg); left: -98.493px; top: 5.65284px; opacity: 1;font-family: <?php echo $mem_cardRow['cardFont'] ?>;"><?php echo $cardTextArr[3] ?>
																			</p>
																	<p class="futura_R"
																			style="transform: rotate(192.857deg); left: -33.362px; top: 57.5931px; opacity: 1;font-family: <?php echo $mem_cardRow['cardFont'] ?>;"><?php echo $cardTextArr[3] ?>
																			</p>
																	<p class="futura_R"
																			style="transform: rotate(141.429deg); left: 47.855px; top: 39.0558px; opacity: 1;font-family: <?php echo $mem_cardRow['cardFont'] ?>;"><?php echo $cardTextArr[3] ?>
																			</p>
																	<p class="futura_R"
																			style="transform: rotate(90deg); left: 84px; top: -36px; opacity: 1;font-family: <?php echo $mem_cardRow['cardFont'] ?>;"><?php echo $cardTextArr[3] ?>
																			</p>
													</div>
													<div class="circle circle4" style="transform: rotate(132deg); transform-origin: 50% 50%; color: <?php echo $mem_cardRow['cardTextColor5'] ?>;">
															<p class="futura_R"
																	style="transform: rotate(428.824deg); left: 99.8967px; top: -79.349px; opacity: 1;font-family: <?php echo $mem_cardRow['cardFont'] ?>;"><?php echo $cardTextArr[4] ?>
																	</p>
															<p class="futura_R"
																	style="transform: rotate(407.647deg); left: 76.6811px; top: -116.843px; opacity: 1;font-family: <?php echo $mem_cardRow['cardFont'] ?>;"><?php echo $cardTextArr[4] ?>
																	</p>
															<p class="futura_R"
																	style="transform: rotate(386.471deg); left: 41.4886px; top: -143.42px; opacity: 1;font-family: <?php echo $mem_cardRow['cardFont'] ?>;"><?php echo $cardTextArr[4] ?>
																	</p>
															<p class="futura_R"
																	style="transform: rotate(365.294deg); left: -0.927797px; top: -155.488px; opacity: 1;font-family: <?php echo $mem_cardRow['cardFont'] ?>;"><?php echo $cardTextArr[4] ?>
																	</p>
															<p class="futura_R"
																	style="transform: rotate(344.118deg); left: -44.8396px; top: -151.419px; opacity: 1;font-family: <?php echo $mem_cardRow['cardFont'] ?>;"><?php echo $cardTextArr[4] ?>
																	</p>
															<p class="futura_R"
																	style="transform: rotate(322.941deg); left: -84.3162px; top: -131.762px; opacity: 1;font-family: <?php echo $mem_cardRow['cardFont'] ?>;"><?php echo $cardTextArr[4] ?>
																	</p>
															<p class="futura_R"
																	style="transform: rotate(301.765deg); left: -114.026px; top: -99.1719px; opacity: 1;font-family: <?php echo $mem_cardRow['cardFont'] ?>;"><?php echo $cardTextArr[4] ?>
																	</p>
															<p class="futura_R"
																	style="transform: rotate(280.588deg); left: -129.957px; top: -58.0499px; opacity: 1;font-family: <?php echo $mem_cardRow['cardFont'] ?>;"><?php echo $cardTextArr[4] ?>
																	</p>
															<p class="futura_R"
																	style="transform: rotate(259.412deg); left: -129.957px; top: -13.9501px; opacity: 1;font-family: <?php echo $mem_cardRow['cardFont'] ?>;"><?php echo $cardTextArr[4] ?>
																	</p>
															<p class="futura_R"
																	style="transform: rotate(238.235deg); left: -114.026px; top: 27.1719px; opacity: 1;font-family: <?php echo $mem_cardRow['cardFont'] ?>;"><?php echo $cardTextArr[4] ?>
																	</p>
															<p class="futura_R"
																	style="transform: rotate(217.059deg); left: -84.3162px; top: 59.7621px; opacity: 1;font-family: <?php echo $mem_cardRow['cardFont'] ?>;"><?php echo $cardTextArr[4] ?>
																	</p>
															<p class="futura_R"
																	style="transform: rotate(195.882deg); left: -44.8396px; top: 79.4191px; opacity: 1;font-family: <?php echo $mem_cardRow['cardFont'] ?>;"><?php echo $cardTextArr[4] ?>
																	</p>
															<p class="futura_R"
																	style="transform: rotate(174.706deg); left: -0.927797px; top: 83.4881px; opacity: 1;font-family: <?php echo $mem_cardRow['cardFont'] ?>;"><?php echo $cardTextArr[4] ?>
																	</p>
															<p class="futura_R"
																	style="transform: rotate(153.529deg); left: 41.4886px; top: 71.4196px; opacity: 1;font-family: <?php echo $mem_cardRow['cardFont'] ?>;"><?php echo $cardTextArr[4] ?>
																	</p>
															<p class="futura_R"
																	style="transform: rotate(132.353deg); left: 76.6811px; top: 44.8435px; opacity: 1;font-family: <?php echo $mem_cardRow['cardFont'] ?>;"><?php echo $cardTextArr[4] ?>
																	</p>
															<p class="futura_R"
																	style="transform: rotate(111.176deg); left: 99.8967px; top: 7.349px; opacity: 1;font-family: <?php echo $mem_cardRow['cardFont'] ?>;"><?php echo $cardTextArr[4] ?>
																	</p>
															<p class="futura_R"
																	style="transform: rotate(90deg); left: 108px; top: -36px; opacity: 1;font-family: <?php echo $mem_cardRow['cardFont'] ?>;"><?php echo $cardTextArr[4] ?>
																	</p>
													</div>
													<div class="circle circle5" style="transform: rotate(135deg); transform-origin: 50% 50%; color: <?php echo $mem_cardRow['cardTextColor6'] ?>;">
															<p class="futura_R"
																	style="transform: rotate(422.308deg); left: 115.506px; top: -102.92px; opacity: 1;font-family: <?php echo $mem_cardRow['cardFont'] ?>;"><?php echo $cardTextArr[5] ?>
																	</p>
															<p class="futura_R"
																	style="transform: rotate(394.615deg); left: 69.8013px; top: -154.51px; opacity: 1;font-family: <?php echo $mem_cardRow['cardFont'] ?>;"><?php echo $cardTextArr[5] ?>
																	</p>
															<p class="futura_R"
																	style="transform: rotate(366.923deg); left: 5.35728px; top: -178.95px; opacity: 1;font-family: <?php echo $mem_cardRow['cardFont'] ?>;"><?php echo $cardTextArr[5] ?>
																	</p>
															<p class="futura_R"
																	style="transform: rotate(339.231deg); left: -63.0631px; top: -170.642px; opacity: 1;font-family: <?php echo $mem_cardRow['cardFont'] ?>;"><?php echo $cardTextArr[5] ?>
																	</p>
															<p class="futura_R"
																	style="transform: rotate(311.538deg); left: -119.786px; top: -131.49px; opacity: 1;font-family: <?php echo $mem_cardRow['cardFont'] ?>;"><?php echo $cardTextArr[5] ?>
																	</p>
															<p class="futura_R"
																	style="transform: rotate(283.846deg); left: -151.816px; top: -70.4615px; opacity: 1;font-family: <?php echo $mem_cardRow['cardFont'] ?>;"><?php echo $cardTextArr[5] ?>
																	</p>
															<p class="futura_R"
																	style="transform: rotate(256.154deg); left: -151.816px; top: -1.53854px; opacity: 1;font-family: <?php echo $mem_cardRow['cardFont'] ?>;"><?php echo $cardTextArr[5] ?>
																	</p>
															<p class="futura_R"
																	style="transform: rotate(228.462deg); left: -119.786px; top: 59.4897px; opacity: 1;font-family: <?php echo $mem_cardRow['cardFont'] ?>;"><?php echo $cardTextArr[5] ?>
																	</p>
															<p class="futura_R"
																	style="transform: rotate(200.769deg); left: -63.0631px; top: 98.6423px; opacity: 1;font-family: <?php echo $mem_cardRow['cardFont'] ?>;"><?php echo $cardTextArr[5] ?>
																	</p>
															<p class="futura_R"
																	style="transform: rotate(173.077deg); left: 5.35728px; top: 106.95px; opacity: 1;font-family: <?php echo $mem_cardRow['cardFont'] ?>;"><?php echo $cardTextArr[5] ?>
																	</p>
															<p class="futura_R"
																	style="transform: rotate(145.385deg); left: 69.8013px; top: 82.5097px; opacity: 1;font-family: <?php echo $mem_cardRow['cardFont'] ?>;"><?php echo $cardTextArr[5] ?>
																	</p>
															<p class="futura_R"
																	style="transform: rotate(117.692deg); left: 115.506px; top: 30.9201px; opacity: 1;font-family: <?php echo $mem_cardRow['cardFont'] ?>;"><?php echo $cardTextArr[5] ?>
																	</p>
															<p class="futura_R"
																	style="transform: rotate(90deg); left: 132px; top: -36px; opacity: 1;font-family: <?php echo $mem_cardRow['cardFont'] ?>;"><?php echo $cardTextArr[5] ?>
																	</p>
													</div>
											</div>
										</div>  
											<h3 class="card_name"><?php echo $mem_cardRow['cardName'] ?></h3>
											<div class="card_item_box">
												<div class="card_item card_item1">
													<div class="card_item_image">
														<img src="<?php echo $mem_cardRow['item1Img2Url'] ?>">
													</div>
													<h4 class="card_item_name card_item_name1"><?php echo $mem_cardRow['item1name'] ?></h4>
												</div>
												<div class="card_item card_item2">
													<div class="card_item_image">
														<img src="<?php echo $mem_cardRow['item2Img2Url'] ?>">
													</div>
													<h4 class="card_item_name card_item_name2"><?php echo $mem_cardRow['item2name'] ?></h4>
												</div>
												<div class="card_item card_item3">
													<div class="card_item_image">
														<img src="<?php echo $mem_cardRow['item3Img2Url'] ?>">
													</div>
													<h4 class="card_item_name card_item_name3"><?php echo $mem_cardRow['item3name'] ?></h4>
												</div>
												<div class="card_item card_item4">
													<div class="card_item_image">
														<img src="<?php echo $mem_cardRow['item4Img2Url'] ?>">
													</div>
													<h4 class="card_item_name card_item_name4"><?php echo $mem_cardRow['item4name'] ?></h4>
												</div>
												<div class="clear"></div>
											</div>
										</div>
									</div>
		                        </div>



	<?php 
	}
}
	?>
		                       	
		                        
		                        
		                    </div>
		                    <!-- control arrows -->
		                    <div class="prev">
		                        <div class="arrow_left"></div>
		                        <!-- <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span> -->
		                    </div>
		                    <div class="next">
		                        <div class="arrow_right"></div>
		                        <!-- <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span> -->
		                    </div>
		                </div>
		            </div>
		            <div class="radar_box">
	                	<div id="radar_wrapper">
					        <canvas id="chartRadar2" width="300" height="300"></canvas>
					    </div>
	                </div>

		            <a href="forum_article_publish.php#publish_r"><div class="nextStepBtn_d">
		            	    <div id="nextStep" class="btn_b nextStep">??????</div>
		            	</div></a>
		        </div>
			</section>
<?php 
?>
				<div class="publish_l">
					<div class="publish_card"  id="add_card">
						<div class="plus_wrap">
							<div class="plus"></div>
						</div>
					</div>
				</div>
				<div class="publish_r" id="publish_r">
					<form action="php/add_article.php" id="addArt">
						<input type="text" maxlength="10" name="article_title" placeholder="???????????????(???????????????)">
						<textarea maxlength="250" placeholder="?????????????????????(??????250???)" name="article_text"></textarea>
						<input type="hidden" name="cardNO" id="cardNo">
					</form>
					<button id="addArtBtn" class="btn_l">????????????</button> 
				</div>
			</div>
		</div>
	</div>

	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.5.5/slick.min.js"></script>
	<script src="js/Chart.js"></script>
	<script src="js/article_poblish_radar.js"></script>
	<script type="text/javascript" src="js/article_poblish.js"></script>
	<script src="js/header.js"></script>

</body>
<?php 
}
?>
</html>