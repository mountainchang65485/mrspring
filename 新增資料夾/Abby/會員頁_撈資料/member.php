<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="X-UA-Compatible" content="ie=edge">
<title>Document</title>
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
<script src="node_modules/gsap/src/minified/TweenMax.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/pixi.js/3.0.7/pixi.js"></script>
    <link rel="stylesheet" href="css/fonts.css">
    <link rel="stylesheet" href="css/reset.css">
    <link rel="stylesheet" href="css/share.css">
    <link rel="stylesheet" href="css/header.css">
    <link rel="stylesheet" href="css/mem.css">
<style>
body{
    background-image: url(images/backGround.jpg);
}
</style>
</head>
<body>

<?php
    $errMsg="";

    try{
        $dsn="mysql:host=localhost;port=3306;dbname=mrspring;charset=utf8";
        $user="root";
        $password="bebe";
        $options= array(PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION, PDO::ATTR_CASE=>PDO::CASE_NATURAL);
        $pdo = new PDO($dsn, $user, $password, $options);
        $sql="select * from member where memNo=5";// $_SESSION[""]
        $member=$pdo->query($sql);

        $memRow = $member -> fetch();
        $memNo = $memRow['memNo'];
        $memImgUrl = $memRow['memImgUrl'];
        $memFirstName = $memRow['memFirstName'];
        $memLastName = $memRow['memLastName'];
        $memNickname = $memRow['memNickname'];
        $memId = $memRow['memId'];
        $memPsw = $memRow['memPsw'];
        $twId = $memRow['twId'];
        $memTel = $memRow['memTel'];
        $memEmail = $memRow['memEmail'];


    }catch(PDOException $e){
        $errMsg.="錯誤原因".$e->getMessage()."<br>";
        $errMsg.="錯誤行號".$e->getLine()."<br>";
    }

    echo $errMsg; 
    ?>
 
<section class="wrap"> <!--all 包含了照片資料按鈕-->
   <form action="updateMemberInfo.php" enctype="multipart/form-data"  method="post" >
        <div class="member_info"> <!--會員資料＆照片-->
    
<!-- 會員大頭貼 -->
        <div class="member_pic">
            <div class="member_imgPreview"><img id="imgPreview_pic" src="images/mem_photo/<?php echo $memImgUrl ?>" alt="上傳檔案"></div>
            <label class="member_edit_label">
                    <input type="file" name="memUpFile" id="member_upFile" >
                    <p class="edit_text">編輯大頭貼<i class="fas fa-pen"></i></p>    
            </label>
        </div>
      
        <!--瀏覽上傳的圖片  -->
        <script type="text/javascript">
            $('#member_upFile').change(function () {
                var file = $('#member_upFile')[0].files[0];
                var reader = new FileReader;
                reader.onload = function (e) {
                    $('#imgPreview_pic').attr('src', e.target.result);
                };
                reader.readAsDataURL(file);
            });

        </script>

<!--資料-->
        <div class="mem_info">
            <div class="table_bg">
                <img class="redknot" src="images/red_knot.png" alt="蝴蝶結">
                <table class="member_data">
                    <tr>
                        <td>
                            <div class="edit_data"><h4>會員編號：</h4><?php echo $memNo ?></div>
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <div class="edit_data"><h4>身分證：</h4><?php echo $twId ?></div>
                        </td>
                    </tr>
                    
                    <tr>
                        <td>
                            <div class="edit_data"> <h4>姓氏：</h4> 
                            <input type="text" name="mem_memFirstName" id="mem_memFirstName" readonly="readonly" value="<?php echo $memFirstName ?>"> <!--之後利用ＪＳ來清除不能點擊的特性-->
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div class="edit_data"> <h4>名字：</h4> 
                            <input type="text" name="mem_memLastName" id="mem_memLastName" readonly="readonly" value="<?php echo $memLastName ?>"> <!--之後利用ＪＳ來清除不能點擊的特性-->
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div class="edit_data"> <h4>暱稱：</h4> 
                            <input type="text" name="mem_memNickname" id="mem_memNickname" readonly="readonly" value="<?php echo $memNickname ?>">
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div class="edit_data"><h4>帳號：</h4>
                            <input type="text" name="mem_memId" id="mem_memId" readonly="readonly" value="<?php echo $memId ?>">
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div class="edit_data"> <h4>密碼：</h4> 
                            <input type="password" name="mem_memPsw" id="mem_memPsw" readonly="readonly" value="<?php echo $memPsw ?>">
                            </div>
                        </td>
                    </tr>

                    

                    <tr>
                        <td>
                            <div class="edit_data"> <h4>電話：</h4> 
                            <input type="tel" name="mem_memTel" id="mem_memTel" readonly="readonly" value="<?php echo $memTel ?>">
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div class="edit_data"> <h4>信箱：</h4> 
                            <input type="mail" name="mem_memEmail" id="mem_memEmail" readonly="readonly" value="<?php echo $memEmail ?>">

                            </div>
                        </td>
                    </tr>
                </table>
            </div>
            <div class="btn_edit">
            <input type="button" name="edit_it" class="btn_s  edit_it" id="btn_edit" value="修改資料">
            <input type="submit" name="updated_it" class="btn_s updated_it" id="updated_it" value="確認修改">
            </div>
        </div>
    </div>
    </form>

    <script>
        $('#btn_edit').click(function () {
            $('#btn_edit').hide();
            $('#updated_it').show();

            document.getElementById("mem_memFirstName").readOnly = false;
            document.getElementById("mem_memLastName").readOnly = false;
            document.getElementById("mem_memNickname").readOnly = false;            
            document.getElementById("mem_memId").readOnly = false;
            document.getElementById("mem_memPsw").readOnly = false;
            document.getElementById("mem_memTel").readOnly = false;
            document.getElementById("mem_memEmail").readOnly = false;

        });

        $('#updated_it').click(function () {
            $('#btn_edit').show();
            $('#updated_it').hide();
        });
    </script>

<!--按鈕們-->
    <ul class="menu">
        <li class="tablinks_reservation" onclick="openAction(event, 'reservation')"><a href="#">我的預約</a></li>
        <li class="meun_btn"><a href="#">我的湯牌</a>
          <ul>
            <li class="tablinks_card" onclick="openAction(event, 'card')"><a href="#">我的湯牌</a></li>
            <li class="tablinks_collection" onclick="openAction(event, 'collection')"><a href="#">我的收藏</a></li>
          </ul>
        </li>
        <li class="tablinks_post" onclick="openAction(event, 'post')"><a href="#">我的發表</a>     
        </li>
        <li class="tablinks_coupon" onclick="openAction(event, 'coupon')"><a href="#">我的酷碰</a></li>
    </ul>

    <div class="function_area">
        <!-- 我的預約 -->
        <div id="reservation" class="tabcontent reservation_area">
            <div class="reser_data">
                <img class="reser_dataImg" src="images/reservation.png" alt="">
                <div class="reser_container"> 
                    <div class="reser_img">
                        <img class="reser_pic" src="images/roompic.png" alt="房間照">
                    </div>
                    <div class="reser_text">
                        <div><p>分店：</p><p>煎餅分店</p></div>
                        <div><p>名稱：</p><p>超豪華山海墓園2人房</p></div>
                        <div><p>素材：</p><p>菊花、牛奶、彼岸花、玫瑰花</p></div>
                        <div><p>金額：</p><p>＄2000</p></div>
                        <div><p>時段：</p><p>9:00~12:00</p></div>
                        <div><p>日期：</p><p>2019/04/09</p></div>
                    </div>
                    <div class="reser_qrcode">
                        <img src="images/qrCode.png" alt="">
                    </div>
                </div>   
            </div> 
        </div>
            



        </div>
        <!-- 我的湯牌 -->
        <div id="card" class="card_area">
            <div class="card card1 zoom_in ">
                <img class="knot" src="images/red_knot.png">
                <div class="front">
                    <img class="badge" src="images/badge.png">
                    <h3 class="card_name">舒筋活骨湯1</h3>
                    <div class="card_item_box">
                        <div class="card_item card_item1">
                            <div class="card_item_image">
                                <img src="images/card_item.png">
                            </div>
                            <h4 class="card_item_name">紅色鼻屎</h4>
                        </div>
                        <div class="card_item card_item2">
                            <div class="card_item_image">
                                <img src="images/card_item.png">
                            </div>
                            <h4 class="card_item_name">紅地瓜</h4>
                        </div>
                        <div class="card_item card_item3">
                            <div class="card_item_image">
                                <img src="images/card_item.png">
                            </div>
                            <h4 class="card_item_name">紅色鼻屎</h4>
                        </div>
                        <div class="card_item card_item4">
                            <div class="card_item_image">
                                <img src="images/card_item.png">
                            </div>
                            <h4 class="card_item_name">枸杞</h4>
                        </div>
                        <div class="clear"></div>
                    </div>
                    <div class="card_btn_box">
                        <a class="btn_s" href="">編輯</a>
                        <a class="btn_s" href="">刪除</a>
                    </div>
                </div>
            </div>

            <div class="card card1 zoom_in ">
                <img class="knot" src="images/red_knot.png">
                <div class="front">
                    <img class="badge" src="images/badge.png">
                    <h3 class="card_name">舒筋活骨湯1</h3>
                    <div class="card_item_box">
                        <div class="card_item card_item1">
                            <div class="card_item_image">
                                <img src="images/card_item.png">
                            </div>
                            <h4 class="card_item_name">紅色鼻屎</h4>
                        </div>
                        <div class="card_item card_item2">
                            <div class="card_item_image">
                                <img src="images/card_item.png">
                            </div>
                            <h4 class="card_item_name">紅地瓜</h4>
                        </div>
                        <div class="card_item card_item3">
                            <div class="card_item_image">
                                <img src="images/card_item.png">
                            </div>
                            <h4 class="card_item_name">紅色鼻屎</h4>
                        </div>
                        <div class="card_item card_item4">
                            <div class="card_item_image">
                                <img src="images/card_item.png">
                            </div>
                            <h4 class="card_item_name">枸杞</h4>
                        </div>
                        <div class="clear"></div>
                    </div>
                    <div class="card_btn_box">
                        <a class="btn_s" href="">編輯</a>
                        <a class="btn_s" href="">刪除</a>
                    </div>
                </div>
            </div>

            <div class="card card1 zoom_in ">
                <img class="knot" src="images/red_knot.png">
                <div class="front">
                    <img class="badge" src="images/badge.png">
                    <h3 class="card_name">舒筋活骨湯1</h3>
                    <div class="card_item_box">
                        <div class="card_item card_item1">
                            <div class="card_item_image">
                                <img src="images/card_item.png">
                            </div>
                            <h4 class="card_item_name">紅色鼻屎</h4>
                        </div>
                        <div class="card_item card_item2">
                            <div class="card_item_image">
                                <img src="images/card_item.png">
                            </div>
                            <h4 class="card_item_name">紅地瓜</h4>
                        </div>
                        <div class="card_item card_item3">
                            <div class="card_item_image">
                                <img src="images/card_item.png">
                            </div>
                            <h4 class="card_item_name">紅色鼻屎</h4>
                        </div>
                        <div class="card_item card_item4">
                            <div class="card_item_image">
                                <img src="images/card_item.png">
                            </div>
                            <h4 class="card_item_name">枸杞</h4>
                        </div>
                        <div class="clear"></div>
                    </div>
                    <div class="card_btn_box">
                        <a class="btn_s" href="">編輯</a>
                        <a class="btn_s" href="">刪除</a>
                    </div>
                </div>
            </div>
        </div>

        <!-- 我的收藏 -->
        <div id="collection" class="collection_area">
            <div class="card card1 zoom_in ">
                <img class="knot" src="images/red_knot.png">
                <div class="front">
                    <img class="badge" src="images/badge.png">
                    <h3 class="card_name">舒筋活骨湯1</h3>
                    <div class="card_item_box">
                        <div class="card_item card_item1">
                            <div class="card_item_image">
                                <img src="images/card_item.png">
                            </div>
                            <h4 class="card_item_name">紅色鼻屎</h4>
                        </div>
                        <div class="card_item card_item2">
                            <div class="card_item_image">
                                <img src="images/card_item.png">
                            </div>
                            <h4 class="card_item_name">紅地瓜</h4>
                        </div>
                        <div class="card_item card_item3">
                            <div class="card_item_image">
                                <img src="images/card_item.png">
                            </div>
                            <h4 class="card_item_name">紅色鼻屎</h4>
                        </div>
                        <div class="card_item card_item4">
                            <div class="card_item_image">
                                <img src="images/card_item.png">
                            </div>
                            <h4 class="card_item_name">枸杞</h4>
                        </div>
                        <div class="clear"></div>
                    </div>
                    <div class="card_btn_box">
                        <a class="btn_s" href="">查看</a>
                        <a class="btn_s" href="">刪除</a>
                    </div>
                </div>
            </div>
    
            <div class="card card1 zoom_in ">
                <img class="knot" src="images/red_knot.png">
                <div class="front">
                    <img class="badge" src="images/badge.png">
                    <h3 class="card_name">舒筋活骨湯1</h3>
                    <div class="card_item_box">
                        <div class="card_item card_item1">
                            <div class="card_item_image">
                                <img src="images/card_item.png">
                            </div>
                            <h4 class="card_item_name">紅色鼻屎</h4>
                        </div>
                        <div class="card_item card_item2">
                            <div class="card_item_image">
                                <img src="images/card_item.png">
                            </div>
                            <h4 class="card_item_name">紅地瓜</h4>
                        </div>
                        <div class="card_item card_item3">
                            <div class="card_item_image">
                                <img src="images/card_item.png">
                            </div>
                            <h4 class="card_item_name">紅色鼻屎</h4>
                        </div>
                        <div class="card_item card_item4">
                            <div class="card_item_image">
                                <img src="images/card_item.png">
                            </div>
                            <h4 class="card_item_name">枸杞</h4>
                        </div>
                        <div class="clear"></div>
                    </div>
                    <div class="card_btn_box">
                        <a class="btn_s" href="">查看</a>
                        <a class="btn_s" href="">刪除</a>
                    </div>
                </div>
            </div>
    
            <div class="card card1 zoom_in ">
                <img class="knot" src="images/red_knot.png">
                <div class="front">
                    <img class="badge" src="images/badge.png">
                    <h3 class="card_name">舒筋活骨湯1</h3>
                    <div class="card_item_box">
                        <div class="card_item card_item1">
                            <div class="card_item_image">
                                <img src="images/card_item.png">
                            </div>
                            <h4 class="card_item_name">紅色鼻屎</h4>
                        </div>
                        <div class="card_item card_item2">
                            <div class="card_item_image">
                                <img src="images/card_item.png">
                            </div>
                            <h4 class="card_item_name">紅地瓜</h4>
                        </div>
                        <div class="card_item card_item3">
                            <div class="card_item_image">
                                <img src="images/card_item.png">
                            </div>
                            <h4 class="card_item_name">紅色鼻屎</h4>
                        </div>
                        <div class="card_item card_item4">
                            <div class="card_item_image">
                                <img src="images/card_item.png">
                            </div>
                            <h4 class="card_item_name">枸杞</h4>
                        </div>
                        <div class="clear"></div>
                    </div>
                    <div class="card_btn_box">
                        <a class="btn_s" href="">查看</a>
                        <a class="btn_s" href="">刪除</a>
                    </div>
                </div>
            </div>

        </div>


        <!-- 我的發表 -->
        <div id="post" class="tabcontent post_area">
            <table class="post_data">
                <thead>
                    <tr>
                        <th>標題</th>
                        <th class="post_title_medicine">藥材</th>
                        <th>日期</th>
                        <th>處理</th>
                    </tr>
                </thead>
                    <tr>
                        <td>這湯極好</td>
                        <td class="post_data_medicine">
                            <div class="color_green"><p>玫瑰</p></div>
                            <div class="color_green"><p>八角</p></div>
                            <div class="color_red"><p>菊花</p></div>
                            <div class="color_orange"><p>蒜頭</p></div>
                        </td>
                        <td>2019/04/03</td>
                        <td class="postImg"><i class="fas fa-pen"></i><i id="delete_icon" class="fas fa-trash-alt"></i></td>
                    </tr>
                    <tr>
                        <td class="post_data_title">這湯極好</td>
                        <td class="post_data_medicine">
                            <div class="color_green"><p>玫瑰</p></div>
                            <div class="color_green"><p>八角</p></div>
                            <div class="color_red"><p>菊花</p></div>
                            <div class="color_orange"><p>蒜頭</p></div>
                        </td>
                        <td>2019/04/03</td>
                        <td class="postImg"><i class="fas fa-pen"></i><i id="delete_icon" class="fas fa-trash-alt"></i></td>
                    </tr>
                    <tr>
                        <td>這湯極好</td>
                        <td class="post_data_medicine">
                            <div class="color_green"><p>玫瑰</p></div>
                            <div class="color_green"><p>八角</p></div>
                            <div class="color_red"><p>菊花</p></div>
                            <div class="color_orange"><p>蒜頭</p></div>
                        </td>
                        <td>2019/04/03</td>
                        <td class="postImg"><i class="fas fa-pen"></i><i id="delete_icon" class="fas fa-trash-alt"></i></td>
                    </tr>
                    <div class="clear"></div>
            </table>
        </div>
            
        <script>
        $('.deleteRow').click(function() { 
        $(this).closest("tr") 
        .remove(); 
 });
        </script>


        </div>

        <!-- 我的酷碰 -->
        <div id="coupon" class="tabcontent coupon_area">
            <div class="coupons">
                <div class="coupon_data">
                    <img class="coupon_dataImg" src="images/coupon.png" alt="">
                    <p class="coupon_num">$200</p>
                </div>
                <div class="coupon_total">
                    <p>總共有5張</p>
                </div>
            </div>
            <div class="coupons">
                <div class="coupon_data">
                    <img class="coupon_dataImg" src="images/coupon.png" alt="">
                    <p class="coupon_num">$500</p>
                </div>
                <div class="coupon_total">
                    <p>總共有1張</p>
                </div>
            </div>
            <div class="coupons">
                <div class="coupon_data">
                    <img class="coupon_dataImg" src="images/coupon.png" alt="">
                    <p class="coupon_num">85折</p>
                </div>
                <div class="coupon_total">
                    <p>總共有3張</p>
                </div>
            </div>
        </div>


        <script>

                $(document).ready(function () {
                    $('.tablinks_reservation').click(function () {
                        $('#reservation').css('display', 'flex');
                        $('#card').hide();
                        $('#collection').hide();
                        $('#post').hide();
                        $('#coupon').hide();
                    });

                    $('.tablinks_card').click(function () {
                        $('#reservation').hide();
                        $('#card').css('display', 'flex');
                        $('#collection').hide();
                        $('#post').hide();
                        $('#coupon').hide();
                    });
                    $('.tablinks_collection').click(function () {
                        $('#reservation').hide();
                        $('#card').hide();
                        $('#collection').css('display', 'flex');
                        $('#post').hide();
                        $('#coupon').hide();
                    });
                    $('.tablinks_post').click(function () {
                        $('#reservation').hide();
                        $('#card').hide();
                        $('#collection').hide();
                        $('#post').css('display', 'flex');
                        $('#coupon').hide();
                    });
                    $('.tablinks_coupon').click(function () {
                        $('#reservation').hide();
                        $('#card').hide();
                        $('#collection').hide();
                        $('#post').hide();
                        $('#coupon').css('display', 'flex');
                    });
                });
            </script>

</section>


 
</body>
</html>