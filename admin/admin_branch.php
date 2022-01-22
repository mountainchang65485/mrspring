<?php
	try{
        require_once("Pancake_connectbooks.php");  
        
		// 優惠券管理
		$sql = "SELECT * from branch";
		$branch1 = $pdo->query($sql);

		$sql = "SELECT * from branch";
		$branch2 = $pdo->query($sql);
	
	}catch(PDOException $e){
		echo $e->getMessage();
	}
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title>湯先生 - 後端管理系統 - 諮詢題目管理</title>
	<link rel="stylesheet" type="text/css" href="../css/admin.css">
	<!-- <link rel="stylesheet" type="text/css" href="css/font.css"> -->
	<link rel="stylesheet" type="text/css" href="../css/reset.css">
	<script type="text/javascript" src="../js/jquery-3.3.1.min.js"></script>
	<!-- <script type="text/javascript" src="../js/admin.js"></script> -->
</head>
<body>
	<div class="admin_bg">
	</div>
	<div class="admin_wrap">
		<div class="admin_nav">
			<ul>
				<li><a href="admin_order.php">訂單管理</a></li>
				<li class="admin_nav_service navNow"><a href="admin_branch.php">分店管理</a></li>
				<li><a href="admin_member.php">會員管理</a></li>
				<li><a href="admin_item.php">藥材管理</a></li>
				<li><a href="admin_robot_keyword.php">關鍵字管理</a></li>
				<li><a href="admin_robot_reply.php">回覆管理</a></li>
				<li><a href="admin_forum.php">討論區管理</a></li>
				<li><a href="admin_question.php">諮詢管理</a></li>
				<li><a href="admin_coupon.php">優惠券管理</a></li>
			</ul>
		</div>

		<!-- advisory -->
		<div class="admin_content admin_content_advisory">
			<div class="item_wrap">
				<table>
					<tr>
						<th>編號：</th>
						<th>分店名稱：</th>
					</tr>
					<?php while( $branch1Row = $branch1->FETCH(PDO::FETCH_ASSOC)){ ?>
					<tr class="navItemsTr">
						<td><?php echo $branch1Row["branchNo"]?></td>
						<td><?php echo $branch1Row["branchName"]?></td>
					</tr>
					<?php 
					}
					?>
				</table>
			</div>
			<div class="edit_wrap">
				<?php 
				while($branch2Row = $branch2->FETCH(PDO::FETCH_ASSOC)){
				?>
				<form class="itemForms" action="branch_update.php" method="POST" enctype="multipart/form-data">
					<input type="hidden" name="branchNo" value="<?php echo $branch2Row["branchNo"]; ?>">
					<table>
						<tr>
							<th>分店名稱：</th>
							<td><input type="text" name="branchName" value="<?php echo $branch2Row["branchName"]; ?>"></td>
						</tr>
						<tr>
							<th>分店地址：</th>
							<td><?php echo $branch2Row["branchAddress"]; ?></td>
						</tr>
						<tr>
							<th>分店電話：</th>
							<td><input type="tel" name="branchTel" value="<?php echo $branch2Row["branchTel"]; ?>"></td>
						</tr>
						<tr>
							<th>分店介紹：</th>
							<td><textarea name="branchDescription"><?php echo $branch2Row["branchDescription"]; ?></textarea></td>
						</tr>
						<tr>
							<th>分店價格：</th>
							<td><input type="number" name="branchPrice" value="<?php echo $branch2Row["branchPrice"]; ?>"></td>
						</tr>
						<tr>
							<th>分店圖片1：</th>
							<td>
                                <img src="../<?php echo $branch2Row["branchImgUrl1"]?>" id="pic_<?php echo $branch1Row["branchNo"]?>-1" alt="分店圖片1" style="width:150px;vertical-align:bottom;">
                                <input type="file" name="branchImgUrl[]">
                            </td>
						</tr>
						<tr>
							<th>分店圖片2：</th>
							<td>
                                <img src="../<?php echo $branch2Row["branchImgUrl2"]?>" id="pic_<?php echo $branch1Row["branchNo"]?>-2" alt="分店圖片2" style="width:150px;vertical-align:bottom;">
                                <input type="file" name="branchImgUrl[]">
                            </td>
						</tr>
						<tr>
							<th>分店圖片3：</th>
							<td>
                                <img src="../<?php echo $branch2Row["branchImgUrl3"]?>" id="pic_<?php echo $branch1Row["branchNo"]?>-3" alt="分店圖片3" style="width:150px;vertical-align:bottom;">
                                <input type="file" name="branchImgUrl[]">
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
				<?php
				}
				?>
			</div>
			<div class="clear"></div>
		</div>
		
	</div>
</body>
<script>
	// 表單中的顏色選取變色
	itemColorInputArr = document.querySelectorAll("input[type^=color]");
	for(var i=0;i<itemColorInputArr.length;i++){
		itemColorInputArr[i].addEventListener("input",function(){
			this.nextElementSibling.style.backgroundColor = this.value;
		})
	}

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