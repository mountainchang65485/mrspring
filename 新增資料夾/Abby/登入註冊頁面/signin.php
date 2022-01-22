<?php 
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css"
        integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
    <script src="node_modules/gsap/src/minified/TweenMax.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/pixi.js/3.0.7/pixi.js"></script>
    <link rel="stylesheet" href="css/fonts.css">
    <link rel="stylesheet" href="css/reset.css">
    <link rel="stylesheet" href="css/share.css">
    <link rel="stylesheet" href="css/signin.css">
</head>

<body>
    <!-- 燈箱：登入 -->
    <div id="lightBox" style=" z-index: 1000;">

        <!-- 登入 -->
        <div id="login" class="table_wrap">
            <center>

                <!-- 登入logo -->
                <figure id="login_img" class="Login_pic">
                    <img src="images/Logo_browen.svg" alt="湯先生">
                </figure>

                <!-- 註冊大頭貼 -->
                <form id="signin_img" class="Login_pic" enctype="multipart/form-data" action="signinUpload.php" method="post">
                    <label class="signin_label">
                        <input type="file" name="memUpFile" id="upFile" >
                        <div class="imgPreview"><img id="imgPreview" src="images/preset_pic.png" alt="上傳檔案">
                            <i class="fas fa-camera"></i></div>
                    </label>
            </center>

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


            <center>
                <p id="login_test" class="Login_title">會員登入</p>
            </center>
            <div id="t1">
                <table border="1" align="center" id="tableLogin" class="table_data">

                    <tr>
                        <td>
                            <p>帳號</p>
                            <input type="text" name="memId"  placeholder="example123">
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <p>密碼</p>
                            <input type="password" name="memPsw" placeholder="******">
                        </td>
                    </tr>
                </table>
            </div>

            <div id="t2">
                <table border="1" align="center" id="table_signin" class="table_data">
                    
                    <tr>
                        <td>
                            <p>帳號&nbsp&nbsp&nbsp&nbsp</p>
                            <input type="text" name="memId_s" placeholder="輸入2~10英數字" maxlength="10"
                                minlength="2" autocomplete="off"  pattern="[A-z0-9]{2-10}">
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <p>密碼&nbsp&nbsp&nbsp&nbsp</p>
                            <input type="password" name="memPsw_s" placeholder="******" maxlength="10"
                                autocomplete="off" >
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <p>姓氏&nbsp&nbsp&nbsp&nbsp</p>
                            <input type="text" name="memFirstName" id="memLastName" placeholder="湯" maxlength="10"
                                autocomplete="off" >
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <p>名字&nbsp&nbsp&nbsp&nbsp</p>
                            <input type="text" name="memLastName" id="memFirstName" placeholder="生生" maxlength="10"
                                autocomplete="off" >
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <p>暱稱&nbsp&nbsp&nbsp&nbsp</p>
                            <input type="text" name="memNickname" id="memNickname" placeholder="我是湯先生" maxlength="10"
                                autocomplete="off" >
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <p>身分證</p>
                            <input type="text" name="twId" id="twId" placeholder="S123456789" maxlength="10"
                                autocomplete="off" >
                        </td>
                    </tr>

                    
                    <tr>
                        <td>
                            <p>信箱&nbsp&nbsp&nbsp&nbsp</p>
                            <input type="email" name="memEmail" id="memEmail" placeholder="mrspring@email.com"
                                autocomplete="off" >
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <p>電話&nbsp&nbsp&nbsp&nbsp</p>
                            <input type="tel" name="memTel" id="memTel" placeholder="0912345678" maxlength="10"
                                autocomplete="off" >
                        </td>
                    </tr>
                </table>
            </div>

            <div class="btn_wrap">
                <center>
                    <input type="submit" name="login" for="form_table" class="btn_s btnLogin" id="btnLogin" value="登入"
                        style="color:rgb(112, 95, 69);">
                    <input type="submit" name="sign" for="form_table" class="btn_s btnLogin" id="btn_signin" value="送出"
                        style="color:rgb(112, 95, 69);">
                    <!-- <span>登入</span> -->
                    </form>
                    <button class="btn_s" id="btnLoginCancel" value="取消">
                        <div class="x_x">
                            <span class="top"></span>
                            <span class="bottom"></span>
                        </div>
                    </button>
                </center>
            </div>
            <center>
                <button type="button" id="test_btn" class="first_time" onclick="memberFunction()">還沒申請帳號?</button>
            </center>
        </div>


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

</body>

</html>