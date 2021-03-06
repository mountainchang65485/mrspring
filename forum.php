<?php
	$_SESSION["where"] = $_SERVER['REQUEST_URI'];
?>

<?php
try{
  require_once("php/j_connect.php");
 	$sql = "
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
				order by a.artTime1 desc;
						
							";//forum by time


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

  $sql2 = "select itemNo,itemName from item;";  //filter mobile
  $sql3 = "select effectTypeNo,effectTypeName from effectType;"; //filter PC

  
	$hot_article = $pdo->query($sq5);
	$article = $pdo->query($sql);


  $item1 = $pdo->query($sql2);
  $item2 = $pdo->query($sql2);


  $effectType1 = $pdo->query($sql3);
  $effectType2 = $pdo->query($sql3);
  
  
}catch(PDOException $e){
  $errMsg .= "???????????? : ".$e -> getMessage(). "<br>";
  $errMsg .= "???????????? : ".$e -> getLine(). "<br>";
}

?>





<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title>????????? Mr.Spring - ?????????????????????</title>
	<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
	<link rel="stylesheet" type="text/css" href="css/share.css">
	<link rel="stylesheet" type="text/css" href="css/hot_forum.css">
	<link rel="stylesheet" type="text/css" href="css/forum.css">
	<link rel="stylesheet" type="text/css" href="css/card.css">
	<link rel="stylesheet" type="text/css" href="css/fonts.css">
  <link rel="stylesheet" href="css/signin.css">
	<link rel="stylesheet" type="text/css" href="css/header.css">
	
	<script type="text/javascript" src="js/jquery-3.3.1.min.js"></script>
	<script type="text/javascript" src="js/jquery-ui.min.js"></script>
	<script src="js/Chart.js"></script>
	<script src="js/forum.js"></script>

		



</head>
<body>
<script>
	sessionStorage.setItem('URL', `${location.href}`);
</script>
 
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
                location.href = `${location.href}`;
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
    



<!-- ============================================================= -->
	<div id="mobile_filter_mask"></div>
	<div id="mobile_filter">
		<label for="filter_ctrl" id="filter_btn">??????</label>
		<label for="sort_ctrl" id="sort_btn">??????</label>
		<!-- <label id="search_btn" for="mobile_search"><img src="images/search_icon.png"></label>
		<input id="mobile_search" type="text" name="search"> -->
	</div>
	<div id="alert_wrap">
		<div id="alert">
			<p></p>
			<div class="btn_s">??????</div>
		</div>
	</div>
	<div id="filter_wrap">
		<div class="sort_wrap">
			<h4>????????????</h4>
			<ul id="sort_wrap">
				<li sort=1><span>?????????</span><img class="checked" src="images/check.png"></li>
				<li sort=2><span>????????????</span><img src="images/check.png"></li>
				<li sort=3><span>????????????</span><img src="images/check.png"></li>
			</ul>
		</div>
		<div class="filter_kind">
			<h4>????????????</h4>
			<ul id="filter_kind">
<?php
while($effectTypeRow1 = $effectType1->fetch(PDO::FETCH_ASSOC)){
?>
				<li><span class="type<?php echo $effectTypeRow1['effectTypeNo']?>"><?php echo $effectTypeRow1['effectTypeName']?></span><img src="images/check.png"></li>
<?php
}
?>
			</ul>
		</div>
		<div class="filter_item">
			<h4>????????????</h4>
			<ul id="filter_item">
<?php 
while($itemRow1 = $item1->fetch(PDO::FETCH_ASSOC)){
?>
				<li itemno="<?php echo $itemRow1['itemNo']?>"><span><?php echo $itemRow1['itemName']?></span><img src="images/check.png"></li>
<?php	
}
?>
				
			</ul>
		</div>
	</div>


	<!-- <script>
$(document).ready(function(){
		
		var filterArr = ["artTime","","","",""];
		
		$('.sort_wrap li').click(function(){
			var sort = $(this).attr("sort");
			if(sort==1){
				sort = "artTime1";
			}else if(sort==2){
				sort="artLikeCount";
			}else{
				sort="artMesCount";
			}
			filterArr[0]=sort;
			console.log(filterArr);
			$.ajax({
						url: 'php/forum_box.php',
            data: {
							filter:JSON.stringify(filterArr)
						},
            type: 'POST',
            async: false,
            success: function(data){
								var obj = jQuery.parseJSON(data);
								console.log(obj);
								forumStr="";
								for(let i=0;i<obj.length;i++){
									forumStr+=
									`
									<div class="forum type${obj[i].effectTypeNo} item${obj[i].item1No} item${obj[i].item2No} item${obj[i].item3No} item${obj[i].item4No}">
									<div hidden class="artNo">${obj[i].artNo}</div>	
									<div class="user_photo"><img src="${obj[i].memImgUrl}" alt="user"></div>
										<div class="forum_data">
											<p class="user_name">${obj[i].memNickname}</p>
											<p class="time">${obj[i].artTime}</p>
											<p class="forum_item">
												<a href="#fourm_search"><span class="item_kind${obj[i].item1type}">${obj[i].item1name}</span></a>
												<a href="#fourm_search"><span class="item_kind${obj[i].item2type}">${obj[i].item2name}</span></a>
												<a href="#fourm_search"><span class="item_kind${obj[i].item3type}">${obj[i].item3name}</span></a>
												<a href="#fourm_search"><span class="item_kind${obj[i].item4type}">${obj[i].item4name}</span></a>
											</p>
										</div>
										<div class="clear"></div>
										<div class="forum_content">
											<form class="readMore" action="forum_article.php" method="post">
												<input type="hidden" name="artNo" value="${obj[i].artNo}">
											</form>
											<div class="forum_title">
												<h3>${obj[i].artTitle}</h3>
												<h4 class="forum_kind_title${obj[i].effectTypeNo} forum_kind_title"><img src="images/knot${obj[i].effectTypeNo}.png">${obj[i].effectTypeName}</h4>
												<div class="clear"></div>
											</div>
											<p>${obj[i].artText}</p>
											<div class="forum_count">
										
												<div class="like">
													<img src="images/solid_heart.png">
													<p>${obj[i].artLikeCount}</p>
												</div>
												
												<div class="msg_count">
													<img src="images/msg_count_icon.png">
													<p>${obj[i].artMesCount}</p>
												</div>
												<div class="clear"></div>
											</div>
										</div>
									</div>
									`;
				
									
							}
							$('.forum_box').html(forumStr);
            },
						
            error: function(data){
						}
						
				
      });
		});
		var item2Num = 0;
		$('#filter_item li').click(function(){

			var itemNo = $(this).attr('itemno');
			
			console.log(item2Num);
			if($(this).children('img').hasClass('checked')){
				item2Num--;
				filterArr.splice(filterArr.indexOf(`and (item1No = ${itemNo} or item2No = ${itemNo} or item3No = ${itemNo} or item4No = ${itemNo} )`,0),1,"");
				
			}else{
				if(item2Num<4){
					item2Num++;
					filterArr[item2Num]=`and (item1No = ${itemNo} or item2No = ${itemNo} or item3No = ${itemNo} or item4No = ${itemNo} )`;
				}
			}

			console.log(filterArr);
			$.ajax({
						url: 'php/forum_box.php',
            data: {
							filter:JSON.stringify(filterArr)
						},
            type: 'POST',
            async: false,
            success: function(data){
					var obj = jQuery.parseJSON(data);
					// console.log(obj);
					forumStr="";
					for(let i=0;i<obj.length;i++){
						forumStr+=
						`
						<div class="forum type${obj[i].effectTypeNo} item${obj[i].item1No} item${obj[i].item2No} item${obj[i].item3No} item${obj[i].item4No}">
						<div hidden class="artNo">${obj[i].artNo}</div>	
						<div class="user_photo"><img src="${obj[i].memImgUrl}" alt="user"></div>
							<div class="forum_data">
								<p class="user_name">${obj[i].memNickname}</p>
								<p class="time">${obj[i].artTime}</p>
								<p class="forum_item">
									<a href="#fourm_search"><span class="item_kind${obj[i].item1type}">${obj[i].item1name}</span></a>
									<a href="#fourm_search"><span class="item_kind${obj[i].item2type}">${obj[i].item2name}</span></a>
									<a href="#fourm_search"><span class="item_kind${obj[i].item3type}">${obj[i].item3name}</span></a>
									<a href="#fourm_search"><span class="item_kind${obj[i].item4type}">${obj[i].item4name}</span></a>
								</p>
							</div>
							<div class="clear"></div>
							<div class="forum_content">
								<form class="readMore" action="forum_article.php" method="post">
									<input type="hidden" name="artNo" value="${obj[i].artNo}">
								</form>
								<div class="forum_title">
									<h3>${obj[i].artTitle}</h3>
									<h4 class="forum_kind_title${obj[i].effectTypeNo} forum_kind_title"><img src="images/knot${obj[i].effectTypeNo}.png">${obj[i].effectTypeName}</h4>
									<div class="clear"></div>
								</div>
								<p>${obj[i].artText}</p>
								<div class="forum_count">
							
									<div class="like">
										<img src="images/solid_heart.png">
										<p>${obj[i].artLikeCount}</p>
									</div>
									
									<div class="msg_count">
										<img src="images/msg_count_icon.png">
										<p>${obj[i].artMesCount}</p>
									</div>
									<div class="clear"></div>
								</div>
							</div>
						</div>
						`;
	
					$('.forum_box').html(forumStr);
				}
            },
						
            error: function(data){
			}
						
				
      });
			// console.log(filterArr);
		});

		$(".forum").click(function(){
			var artNo = $(this).children(".artNo").text();
			window.location=`forum_article.php?artNo=${artNo}`;
		});
});


</script> -->

	<div class="bg forum_bg">
		<div class="wrap forum_wrap">
			<h2 class="hot_forum_heading">????????????</h2>
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
								<button class="btn_s keep_btn" artno="<?php echo $hot_articleRow['artNo']?>" href="php/keep_card.php?<?php echo $hot_articleRow['cardno']?>">?????????</button>
<script>
$(".card_btn_box .keep_btn").bind('click',function(){
	var artNo=$(this).attr('artno');
	var xhr = new  XMLHttpRequest();
	xhr.onreadystatechange=function (){
			if( xhr.readyState == 4){
					if( xhr.status == 200 ){
							if(xhr.responseText==1){
									// ???????????????function
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
									// ????????????????????????
											$('#alert_wrap p').text("???????????????");
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
									?????????
								</button>
<script>
	$('.btn_to_custom').click(function(){
		$('#to_custom').submit();
		event.stopPropagation() 
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
							<form action="forum_article.php" method="get">
								<input type="hidden" name="artNo" value="<?php echo $hot_articleRow['artNo'] ?>">
								<input class="btn_s" type="submit" name="submit" value="????????????">
							</form>
						</div>
					</div>
				</div>	

<?php	
}
?>

					
			</div>
			<button href="forum_article_publish.php" class="btn_l" id="art_publish_btn">????????????</button>
<script>
$(document).ready(function(){
		$('#art_publish_btn').click(function(){
		var xhr = new  XMLHttpRequest();
		xhr.onreadystatechange=function (){
				if( xhr.readyState == 4){
						if( xhr.status == 200 ){
								if(xhr.responseText==1){
										// ???????????????function
										
											window.location = "forum_article_publish.php";
										
								}else{
										// ????????????????????????
										$('#alert_wrap p').text("???????????????");
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
	});
});
</script>
			<div class="forum_filter">
				<div class="mask"></div>
				<div class="kind_of_forum">
					<!-- <div class="count">0</div> -->
					<ul id="kind_of_forum_box">
						<li>????????????</li>
<?php 
$i=0;
while($effectTypeRow2 = $effectType2->fetch(PDO::FETCH_ASSOC)){
$i++;
?>
						<li>
							<label for="kind" class="type<?php echo $effectTypeRow2['effectTypeNo']?>">
								<?php echo $effectTypeRow2['effectTypeName']?>
							</label>
							<img class="" src="images/check.png">
						</li>
						

<?php 
}
?>
					</ul>
				</div>
				<div class="item_of_forum">
					<!-- <div class="count">0</div> -->
					<ul id="item_of_forum_box">
						<li>????????????</li>
<?php
$i=0;
while($itemRow2 = $item2->fetch(PDO::FETCH_ASSOC)){
$i++;

?>
						<li>
							<label itemno="<?php echo $itemRow2['itemNo']?>" class="item<?php echo $itemRow2['itemNo']?>" for="item<?php echo $i; ?>"><?php echo $itemRow2['itemName']?></label><img src="images/check.png">
						</li>
<?php  
}
?>
						
					</ul>
				</div>
				<div class="sort_forum">
					<span>
						<input type="radio" name="sort" id="sort1" sort="1" checked>
						<label for="sort1" class="sortbtn" >?????????</label>
					</span>
					<span>
						<input type="radio" name="sort" id="sort2" sort="2">
						<label for="sort2" class="sortbtn" >????????????</label>
					</span>
					<span>
						<input type="radio" name="sort" id="sort3" sort="3">
						<label for="sort3" class="sortbtn">????????????</label>
					</span>
				</div>
			</div>

			<div class="clear"></div>
				

			<div class="forum_box">


<script>
$(document).ready(function(){
		var forumStr="";
		$.ajax({
				url: './php/forum_box.php',
				type: 'POST',
				async: false,
				success: function(data){
						var obj = jQuery.parseJSON(data);
						for(let i=0;i<obj.length;i++){
							forumStr+=
							`
							<div class="forum type${obj[i].effectTypeNo} item${obj[i].item1No} item${obj[i].item2No} item${obj[i].item3No} item${obj[i].item4No}">
							<div hidden class="artNo">${obj[i].artNo}</div>	
							<div class="user_photo"><img src="${obj[i].memImgUrl}" alt="user"></div>
								<div class="forum_data">
									<p class="user_name">${obj[i].memNickname}</p>
									<p class="time">${obj[i].artTime}</p>
									<p class="forum_item">
										<a href="#fourm_search"><span class="item_kind${obj[i].item1type}">${obj[i].item1name}</span></a>
										<a href="#fourm_search"><span class="item_kind${obj[i].item2type}">${obj[i].item2name}</span></a>
										<a href="#fourm_search"><span class="item_kind${obj[i].item3type}">${obj[i].item3name}</span></a>
										<a href="#fourm_search"><span class="item_kind${obj[i].item4type}">${obj[i].item4name}</span></a>
									</p>
								</div>
								<div class="clear"></div>
								<div class="forum_content">
									<form class="readMore" action="forum_article.php" method="post">
										<input type="hidden" name="artNo" value="${obj[i].artNo}">
									</form>
									<div class="forum_title">
										<h3>${obj[i].artTitle}</h3>
										<h4 class="forum_kind_title${obj[i].effectTypeNo} forum_kind_title"><img src="images/knot${obj[i].effectTypeNo}.png">${obj[i].effectTypeName}</h4>
										<div class="clear"></div>
									</div>
									<p>${obj[i].artText}</p>
									<div class="forum_count">
								
										<div class="like">
											<img src="images/solid_heart.png">
											<p>${obj[i].artLikeCount}</p>
										</div>
										
										<div class="msg_count">
											<img src="images/msg_count_icon.png">
											<p>${obj[i].artMesCount}</p>
										</div>
										<div class="clear"></div>
									</div>
								</div>
							</div>
							`;
		
							$('.forum_box').html(forumStr);
							$(".forum_content").off('click').click(function (){
								$(this).children(".readMore").submit();
							});
						}
				},

				error: function(data){
				}
		});
		var filterArr = ["artTime","","","",""];
		
		$('.sort_forum .sortbtn').click(function(){
			var sort = $(this).siblings("input").attr("sort");
			if(sort==1){
				sort = "artTime1";
			}else if(sort==2){
				sort="artLikeCount";
			}else{
				sort="artMesCount";
			}
			filterArr[0]=sort;
			console.log(filterArr);
			$.ajax({
						url: 'php/forum_box.php',
            data: {
							filter:JSON.stringify(filterArr)
						},
            type: 'POST',
            async: false,
            success: function(data){
								var obj = jQuery.parseJSON(data);
								console.log(obj);
								forumStr="";
								for(let i=0;i<obj.length;i++){
									forumStr+=
									`
									<div class="forum type${obj[i].effectTypeNo} item${obj[i].item1No} item${obj[i].item2No} item${obj[i].item3No} item${obj[i].item4No}">
									<div hidden class="artNo">${obj[i].artNo}</div>	
									<div class="user_photo"><img src="${obj[i].memImgUrl}" alt="user"></div>
										<div class="forum_data">
											<p class="user_name">${obj[i].memNickname}</p>
											<p class="time">${obj[i].artTime}</p>
											<p class="forum_item">
												<a href="#fourm_search"><span class="item_kind${obj[i].item1type}">${obj[i].item1name}</span></a>
												<a href="#fourm_search"><span class="item_kind${obj[i].item2type}">${obj[i].item2name}</span></a>
												<a href="#fourm_search"><span class="item_kind${obj[i].item3type}">${obj[i].item3name}</span></a>
												<a href="#fourm_search"><span class="item_kind${obj[i].item4type}">${obj[i].item4name}</span></a>
											</p>
										</div>
										<div class="clear"></div>
										<div class="forum_content">
											<form class="readMore" action="forum_article.php" method="post">
												<input type="hidden" name="artNo" value="${obj[i].artNo}">
											</form>
											<div class="forum_title">
												<h3>${obj[i].artTitle}</h3>
												<h4 class="forum_kind_title${obj[i].effectTypeNo} forum_kind_title"><img src="images/knot${obj[i].effectTypeNo}.png">${obj[i].effectTypeName}</h4>
												<div class="clear"></div>
											</div>
											<p>${obj[i].artText}</p>
											<div class="forum_count">
										
												<div class="like">
													<img src="images/solid_heart.png">
													<p>${obj[i].artLikeCount}</p>
												</div>
												
												<div class="msg_count">
													<img src="images/msg_count_icon.png">
													<p>${obj[i].artMesCount}</p>
												</div>
												<div class="clear"></div>
											</div>
										</div>
									</div>
									`;
				
									$('.forum_box').html(forumStr);
									$(".forum_content").off('click').click(function (){
										$(this).children(".readMore").submit();
									});
							}
            },
						
            error: function(data){
						}
						
				
      });
		});
			var itemNum = 0;
		$('#item_of_forum_box li label').click(function(){
			var itemNo = $(this).attr('itemno');
			if($(this).siblings('img').hasClass('check')){
				itemNum++;
				if(itemNum<=4){
					filterArr[itemNum]=`and (item1No = ${itemNo} or item2No = ${itemNo} or item3No = ${itemNo} or item4No = ${itemNo} )`;
				}
			}else{
				itemNum--;
				filterArr.splice(filterArr.indexOf(`and (item1No = ${itemNo} or item2No = ${itemNo} or item3No = ${itemNo} or item4No = ${itemNo} )`,0),1,"");
			}

			console.log(filterArr);
			$.ajax({
						url: 'php/forum_box.php',
            data: {
							filter:JSON.stringify(filterArr)
						},
            type: 'POST',
            async: false,
            success: function(data){
								var obj = jQuery.parseJSON(data);
								console.log(obj);
								forumStr="";
								for(let i=0;i<obj.length;i++){
									forumStr+=
									`
									<div class="forum type${obj[i].effectTypeNo} item${obj[i].item1No} item${obj[i].item2No} item${obj[i].item3No} item${obj[i].item4No}">
									<div hidden class="artNo">${obj[i].artNo}</div>	
									<div class="user_photo"><img src="${obj[i].memImgUrl}" alt="user"></div>
										<div class="forum_data">
											<p class="user_name">${obj[i].memNickname}</p>
											<p class="time">${obj[i].artTime}</p>
											<p class="forum_item">
												<a href="#fourm_search"><span class="item_kind${obj[i].item1type}">${obj[i].item1name}</span></a>
												<a href="#fourm_search"><span class="item_kind${obj[i].item2type}">${obj[i].item2name}</span></a>
												<a href="#fourm_search"><span class="item_kind${obj[i].item3type}">${obj[i].item3name}</span></a>
												<a href="#fourm_search"><span class="item_kind${obj[i].item4type}">${obj[i].item4name}</span></a>
											</p>
										</div>
										<div class="clear"></div>
										<div class="forum_content">
											<form class="readMore" action="forum_article.php" method="post">
												<input type="hidden" name="artNo" value="${obj[i].artNo}">
											</form>
											<div class="forum_title">
												<h3>${obj[i].artTitle}</h3>
												<h4 class="forum_kind_title${obj[i].effectTypeNo} forum_kind_title"><img src="images/knot${obj[i].effectTypeNo}.png">${obj[i].effectTypeName}</h4>
												<div class="clear"></div>
											</div>
											<p>${obj[i].artText}</p>
											<div class="forum_count">
										
												<div class="like">
													<img src="images/solid_heart.png">
													<p>${obj[i].artLikeCount}</p>
												</div>
												
												<div class="msg_count">
													<img src="images/msg_count_icon.png">
													<p>${obj[i].artMesCount}</p>
												</div>
												<div class="clear"></div>
											</div>
										</div>
									</div>
									`;
				
									
							}
							$('.forum_box').html(forumStr);
							$(".forum_content").off('click').click(function (){
								$(this).children(".readMore").submit();
							});
            },
						
            error: function(data){
						}
						
				
      });
			// console.log(filterArr);
		});

		$(".forum").click(function(){
			var artNo = $(this).children(".artNo").text();
			window.location=`forum_article.php?artNo=${artNo}`;
		});


		var filterArr = ["artTime","","","",""];
		
		$('.sort_wrap li').click(function(){
			var sort = $(this).attr("sort");
			if(sort==1){
				sort = "artTime1";
			}else if(sort==2){
				sort="artLikeCount";
			}else{
				sort="artMesCount";
			}
			filterArr[0]=sort;
			console.log(filterArr);
			$.ajax({
						url: 'php/forum_box.php',
            data: {
							filter:JSON.stringify(filterArr)
						},
            type: 'POST',
            async: false,
            success: function(data){
								var obj = jQuery.parseJSON(data);
								console.log(obj);
								forumStr="";
								for(let i=0;i<obj.length;i++){
									forumStr+=
									`
									<div class="forum type${obj[i].effectTypeNo} item${obj[i].item1No} item${obj[i].item2No} item${obj[i].item3No} item${obj[i].item4No}">
									<div hidden class="artNo">${obj[i].artNo}</div>	
									<div class="user_photo"><img src="${obj[i].memImgUrl}" alt="user"></div>
										<div class="forum_data">
											<p class="user_name">${obj[i].memNickname}</p>
											<p class="time">${obj[i].artTime}</p>
											<p class="forum_item">
												<a href="#fourm_search"><span class="item_kind${obj[i].item1type}">${obj[i].item1name}</span></a>
												<a href="#fourm_search"><span class="item_kind${obj[i].item2type}">${obj[i].item2name}</span></a>
												<a href="#fourm_search"><span class="item_kind${obj[i].item3type}">${obj[i].item3name}</span></a>
												<a href="#fourm_search"><span class="item_kind${obj[i].item4type}">${obj[i].item4name}</span></a>
											</p>
										</div>
										<div class="clear"></div>
										<div class="forum_content">
											<form class="readMore" action="forum_article.php" method="post">
												<input type="hidden" name="artNo" value="${obj[i].artNo}">
											</form>
											<div class="forum_title">
												<h3>${obj[i].artTitle}</h3>
												<h4 class="forum_kind_title${obj[i].effectTypeNo} forum_kind_title"><img src="images/knot${obj[i].effectTypeNo}.png">${obj[i].effectTypeName}</h4>
												<div class="clear"></div>
											</div>
											<p>${obj[i].artText}</p>
											<div class="forum_count">
										
												<div class="like">
													<img src="images/solid_heart.png">
													<p>${obj[i].artLikeCount}</p>
												</div>
												
												<div class="msg_count">
													<img src="images/msg_count_icon.png">
													<p>${obj[i].artMesCount}</p>
												</div>
												<div class="clear"></div>
											</div>
										</div>
									</div>
									`;
				
									
							}
							$('.forum_box').html(forumStr);
							$(".forum_content").off('click').click(function (){
								$(this).children(".readMore").submit();
							});
            },
						
            error: function(data){
						}
						
				
      });
		});
		var item2Num = 0;
		$('#filter_item li').click(function(){

			var itemNo = $(this).attr('itemno');
			
			
			if($(this).children('img').hasClass('checked')){
				item2Num--;
				filterArr.splice(filterArr.indexOf(`and (item1No = ${itemNo} or item2No = ${itemNo} or item3No = ${itemNo} or item4No = ${itemNo} )`,0),1,"");
				
			}else{
				if(item2Num<4){
					item2Num++;
					filterArr[item2Num]=`and (item1No = ${itemNo} or item2No = ${itemNo} or item3No = ${itemNo} or item4No = ${itemNo} )`;
				}
				console.log(item2Num);
			}

			console.log(filterArr);
			$.ajax({
						url: 'php/forum_box.php',
            data: {
							filter:JSON.stringify(filterArr)
						},
            type: 'POST',
            async: false,
            success: function(data){
								var obj = jQuery.parseJSON(data);
								// console.log(obj);
								forumStr="";
								for(let i=0;i<obj.length;i++){
									forumStr+=
									`
									<div class="forum type${obj[i].effectTypeNo} item${obj[i].item1No} item${obj[i].item2No} item${obj[i].item3No} item${obj[i].item4No}">
									<div hidden class="artNo">${obj[i].artNo}</div>	
									<div class="user_photo"><img src="${obj[i].memImgUrl}" alt="user"></div>
										<div class="forum_data">
											<p class="user_name">${obj[i].memNickname}</p>
											<p class="time">${obj[i].artTime}</p>
											<p class="forum_item">
												<a href="#fourm_search"><span class="item_kind${obj[i].item1type}">${obj[i].item1name}</span></a>
												<a href="#fourm_search"><span class="item_kind${obj[i].item2type}">${obj[i].item2name}</span></a>
												<a href="#fourm_search"><span class="item_kind${obj[i].item3type}">${obj[i].item3name}</span></a>
												<a href="#fourm_search"><span class="item_kind${obj[i].item4type}">${obj[i].item4name}</span></a>
											</p>
										</div>
										<div class="clear"></div>
										<div class="forum_content">
											<form class="readMore" action="forum_article.php" method="post">
												<input type="hidden" name="artNo" value="${obj[i].artNo}">
											</form>
											<div class="forum_title">
												<h3>${obj[i].artTitle}</h3>
												<h4 class="forum_kind_title${obj[i].effectTypeNo} forum_kind_title"><img src="images/knot${obj[i].effectTypeNo}.png">${obj[i].effectTypeName}</h4>
												<div class="clear"></div>
											</div>
											<p>${obj[i].artText}</p>
											<div class="forum_count">
										
												<div class="like">
													<img src="images/solid_heart.png">
													<p>${obj[i].artLikeCount}</p>
												</div>
												
												<div class="msg_count">
													<img src="images/msg_count_icon.png">
													<p>${obj[i].artMesCount}</p>
												</div>
												<div class="clear"></div>
											</div>
										</div>
									</div>
									`;
				
									
							}
							$('.forum_box').html(forumStr);
							$(".forum_content").off('click').click(function (){
								$(this).children(".readMore").submit();
							});
            },
						
            error: function(data){
						}
						
				
      });
			// console.log(filterArr);
		});

		$(".forum").click(function(){
			var artNo = $(this).children(".artNo").text();
			window.location=`forum_article.php?artNo=${artNo}`;
		});
});


</script>



				
				
			</div>
		</div>
	</div>
	
    <footer>
			<div class="all_rights">
				<h4>Non commercial use&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Copyright ?? 2019 Mr.Spring All rights
					reserved</h4>
			</div>
	</footer>
    <script type="text/javascript" src="js/jquery.easing.1.3.js"></script>
    <script type="text/javascript" src="js/hot_forum_radar.js"></script>
    <script src="js/header.js"></script>
</body>
</html>