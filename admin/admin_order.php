<?php
	try{
		require_once("Pancake_connectbooks.php");  
        $sql = "
            select branchName
            from branch;
            ";
        $branch_name = $pdo->query($sql);
        $branch_name2= $pdo->query($sql);
		// 優惠券管理
	}catch(PDOException $e){
		echo $e->getMessage();
	}
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title>湯先生 - 後端管理系統</title>
	<link rel="stylesheet" type="text/css" href="../css/admin.css">
	<!-- <link rel="stylesheet" type="text/css" href="css/font.css"> -->
	<link rel="stylesheet" type="text/css" href="../css/reset.css">
	<script type="text/javascript" src="../js/jquery-3.3.1.min.js"></script>
	<!-- <script type="text/javascript" src="../js/admin.js"></script> -->
	<style>
        textarea{
            line-height:1.5;
        }
        .navItemsTr th,.navItemsTr td{
            width:33.333%;
        }
        .item_wrap th{
            width:33.333%;
        }
	</style>
</head>
<body>
	<div class="admin_bg">
	</div>
	<div class="admin_wrap">
		<div class="admin_nav">
			<ul>
                <li class="navNow"><a href="admin_order.php">訂單管理</a></li>
				<li class="admin_nav_service"><a href="admin_branch.php">分店管理</a></li>
				<li><a href="admin_member.php">會員管理</a></li>
				<li><a href="admin_item.php">藥材管理</a></li>
				<li><a href="admin_robot_keyword.php">關鍵字管理</a></li>
				<li><a href="admin_robot_reply.php">回覆管理</a></li>
				<li><a href="admin_forum.php">討論區管理</a></li>
				<li><a href="admin_question.php">諮詢管理</a></li>
				<li><a href="admin_coupon.php">優惠券管理</a></li>
			</ul>
		</div>


		<!-- coupon -->
		<div class="admin_content admin_content_coupon">
			<div class="item_wrap">
                <table>
                    <tr>
                        <td style="padding:0;"><input id="date" style="width:100%;" type="date" value="<?php echo date("Y-m-d")?>"></td>
                        <td>
                            <select id="branch" name="branch">
<?php 
$i = 0;
while($branch_nameRow = $branch_name->fetch(PDO::FETCH_ASSOC)){
$i++;
?>   
                                <option value="<?php echo $i;?>"><?php echo $branch_nameRow['branchName']?></option>
<?php
}
?>
                            </select>
                        </td >
                        <td>
                            <button id="search">搜尋</button>
                        </td>
                    </tr>
                </table>
				<table>

					<tr>
						<th>編號</th>
						<th>名稱</th>
						<th>狀態</th>
                    </tr>
                    <table id="item_col">

                    </table>
<script>
$(document).ready(function(){
    $('#search').click(function(){
        var date = $('#date').val();
        var branch = $('#branch').val();
        str="";
        str2="";
        $.ajax({
            url: 'order_data.php',
            data: {
                date:date,
                branch:branch,
            },
            type: 'GET',
            async: false,
            success: function(data){
                function order_status(status){
                    if(status==1){
                        return "未入住";
                    }else if(status==2){
                        return "已入住";
                    }else{
                        return "取消訂單";
                    }
                }
                function orderResTime(time){
                    if(time==1){
                        return "早上";
                    }else if(time==2){
                        return "下午";
                    }else{
                        return "晚上";
                    }
                }

                // function order_staus(staus,stausValue){
                //     if(staus == 1 && stausValue == 1){
                //         return "selected='selected'";
                //     }else if(staus == 2 && stausValue == 2){
                //         return "selected='selected'";
                //     }else if(staus == 3 && stausValue == 3){
                //         return "selected='selected'";
                //     }
                // }

                var obj = jQuery.parseJSON(data);
                console.log(obj);

                for(let i=0;i<obj.length;i++){
                    var ordStatus="";
                    if(obj[i].orderStatus==1){
                        ordStatus+=`
                            <select name="orderStatus">
                                <option value="1" selected="true">未入住</option>
                                <option value="2">已入住</option>
                                <option value="3">取消訂單</option>
                            </select>
                        `;
                    }else if(obj[i].orderStatus==2){
                        ordStatus+=`
                            <select name="orderStatus">
                                <option value="1">未入住</option>
                                <option value="2" selected="true">已入住</option>
                                <option value="3">取消訂單</option>
                            </select>
                        `;
                    }else{
                        ordStatus+=`
                           <div>取消訂單</div>
                        `;
                    }

                    str+=`
                    <tr class="navItemsTr">
                            <td>${obj[i].orderNo}</td>
                            <td>${obj[i].memFirstName}${obj[i].memLastName}</td>
                            <td>${order_status(obj[i].orderStatus)}</td>
                    </tr>
                    `;
                    str2+=`
                        <form class="itemForms" action="order_update.php" method="get">
                        <input type="hidden" name="orderNo" value="${obj[i].orderNo}">
                        <table>
                            <tr>
                                <th>編號：</th>
                                <td>${obj[i].orderNo}</td>
                            </tr>
                            <tr>
                                <input type="hidden" name="orderResDate" value="${obj[i].orderResDate}">
                                <th>入住日期：</th>
                                <td>${obj[i].orderResDate}</td>
                            </tr>
                            <tr>
                                <th>姓名：</th>
                                <td>${obj[i].memFirstName}${obj[i].memLastName}</td>
                            </tr>
                            <tr>
                                <th>電話：</th>
                                <td>${obj[i].memTel}</td>
                            </tr>
                            <tr>
                                <input type="hidden" name="orderResTime" value="${obj[i].orderResTime}">
                                <th>入住時段：</th>
                                <td>${orderResTime(obj[i].orderResTime)}</td>
                            </tr>
                            
                            <tr>
                                <input type="hidden" name="branchNo" value="${obj[i].branchNo}">
                                <th>分店：</th>
                                <td>${obj[i].branchName}</td>
                            </tr>
                            <tr>
                                <th>分店：</th>
                                <td>
                                    
                                        ${ordStatus}
                                    
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    <div class="edit_btn">
                                        <input type="reset" name="rest" value="重置">
                                        <input type="submit" name="submit" value="儲存">
                                    </div>
                                </td>
                            </tr>
                        </table>
                    </form>
                    `;
                }
                // $('#thead').next().nextAll().remove();


                itemForms = document.getElementsByClassName("itemForms");
	            navItemsTr = document.getElementsByClassName("navItemsTr");


 
            },

            error: function(data){
            }
        });
        $('#item_col').html(str);
        $('.edit_wrap').html(str2);

        for(var i=0;i<navItemsTr.length;i++){
            navItemsTr[i].addEventListener("click", function(){
                for(var j = 0; j<navItemsTr.length; j++){
                    if(navItemsTr[j]==this){
                        itemForms[j].style.display = "block";
                    }else{
                        itemForms[j].style.display = "none";
                    }
                }
            })
        }
    });
});
</script>

				</table>
			</div>
			<div class="edit_wrap">
			
				
			</div>
			<div class="clear"></div>
		</div>
		
	</div>
</body>













<script>
	// 表單中的顏色選取變色


	// 點左邊導覽列開啟右邊的編輯表單
	itemForms = document.getElementsByClassName("itemForms");
	navItemsTr = document.getElementsByClassName("navItemsTr");

	for(var i=0;i<navItemsTr.length;i++){
		navItemsTr[i].addEventListener("click", function(){
			for(var j = 0; j<navItemsTr.length; j++){
				if(navItemsTr[j]==this){
					itemForms[j].style.display = "block";
				}else{
					itemForms[j].style.display = "none";
				}
			}
		})
	}

	
</script>
</html>