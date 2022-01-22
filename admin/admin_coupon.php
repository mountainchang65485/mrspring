<?php
	try{
		require_once("Pancake_connectbooks.php");  

		// 優惠券管理
		$sql = "SELECT * from coupon order by couponStatus desc , couponLevel";
		$coupon1 = $pdo->query($sql);

		$sql = "SELECT * from coupon order by couponStatus desc , couponLevel";
		$coupon2 = $pdo->query($sql);
	
	}catch(PDOException $e){
		echo $e->getMessage();
	}
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title>湯先生 - 後端管理系統 - 優惠券管理</title>
	<link rel="stylesheet" type="text/css" href="../css/admin.css">
	<!-- <link rel="stylesheet" type="text/css" href="css/font.css"> -->
	<link rel="stylesheet" type="text/css" href="../css/reset.css">
	<script type="text/javascript" src="../js/jquery-3.3.1.min.js"></script>
	<!-- <script type="text/javascript" src="../js/admin.js"></script> -->
	<style>
	</style>
</head>
<body>
	<div class="admin_bg">
	</div>
	<div class="admin_wrap">
		<div class="admin_nav">
			<ul>
				<li><a href="admin_order.php">訂單管理</a></li>
				<li class="admin_nav_service"><a href="admin_branch.php">分店管理</a></li>
				<li><a href="admin_member.php">會員管理</a></li>
				<li><a href="admin_item.php">藥材管理</a></li>
				<li><a href="admin_robot_keyword.php">關鍵字管理</a></li>
				<li><a href="admin_robot_reply.php">回覆管理</a></li>
				<li><a href="admin_forum.php">討論區管理</a></li>
				<li><a href="admin_question.php">諮詢管理</a></li>
				<li class="navNow"><a href="admin_coupon.php">優惠券管理</a></li>
			</ul>
		</div>


		<!-- coupon -->
		<div class="admin_content admin_content_coupon">
			<div class="item_wrap">
				<div class="add navItemsTr">
				</div>
				<table>
					<tr>
						<th>編號</th>
						<th>名稱</th>
						<th>狀態</th>
					</tr>
					<?php 
					while($coupon1Row = $coupon1->FETCH(PDO::FETCH_ASSOC)){
					?>
					<tr class="navItemsTr">
						<td><?php echo $coupon1Row["couponNo"]?></td>
						<td><?php echo $coupon1Row["couponName"]?></td>
						<td><?php if($coupon1Row["couponStatus"]==0){echo '下架';}else{echo '上架';} ;?></td>
					</tr>
					<?php
					}
					?>
				</table>
			</div>
			<div class="edit_wrap">

			<form class="itemForms" action="coupons_update.php" method="GET">
					<input type="hidden" name="couponAdd">
					<table>
						<tr>
							<th>名稱：</th>
							<td><input type="text" name="couponName"></td>
						</tr>
						<tr>
							<th>種類：</th>
							<td>
								<label><input type="radio" name="couponType" value='1'>減價</label>
								<label><input type="radio" name="couponType" value='2'>打折</label>
							</td>
						</tr>
						<tr>
							<th>折扣：</th>
							<td><input type="text" name="couponDiscount" style="width: 75px;"></td>
						</tr>
						<tr>
							<th>等級：</th>
							<td>
								<label><input type="radio" name="couponLevel" value="1" style="width: 50px;">1</label>
								<label><input type="radio" name="couponLevel" value="2" style="width: 50px;">2</label>
								<label><input type="radio" name="couponLevel" value="3" style="width: 50px;">3</label>
							</td>
						</tr>
						
						<tr>
							<th>狀態：</th>
							<td>
								<label><input type="radio" name="couponStatus" value="1">上架</label>
								<label><input type="radio" name="couponStatus" value="0">下架 </label>
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


			<?php while($coupon2Row = $coupon2 ->FETCH(PDO::FETCH_ASSOC)){ ?>
	
				<form class="itemForms" action="coupons_update.php" method="post">
					<input type="hidden" name="couponNo" value="<?php echo $coupon2Row["couponNo"]; ?>">
					<table>
						<tr>
							<th>編號：</th>
							<td><?php echo $coupon2Row["couponNo"]; ?></td>
						</tr>
						<tr>
							<th>名稱：</th>
							<td><input type="text" name="couponName" value="<?php echo $coupon2Row["couponName"]; ?>"></td>
						</tr>
						<tr>
							<th>種類：</th>
							<td>
								<label><input type="radio" name="couponType" <?php if($coupon2Row["couponType"]==1)echo 'checked'; ?> value='1'>減價</label>
								<label><input type="radio" name="couponType" <?php if($coupon2Row["couponType"]==2)echo 'checked'; ?> value='2'>打折</label>
							</td>
						</tr>
						<tr>
							<th>折扣：</th>
							<td><input type="number" name="couponDiscount" value="<?php echo $coupon2Row["couponDiscount"]; ?>" style="width: 75px;"></td>
						</tr>
						<tr>
							<th>等級：</th>
							<td>
								<label><input <?php if($coupon2Row["couponLevel"]==1)echo 'checked'; ?> type="radio" name="couponLevel" value="1" style="width: 50px;">1</label>
								<label><input <?php if($coupon2Row["couponLevel"]==2)echo 'checked'; ?> type="radio" name="couponLevel" value="2" style="width: 50px;">2</label>
								<label><input <?php if($coupon2Row["couponLevel"]==3)echo 'checked'; ?> type="radio" name="couponLevel" value="3" style="width: 50px;">3</label>
							</td>
						</tr>
						
						<tr>
							<th>狀態：</th>
							<td>
								<label><input <?php if($coupon2Row["couponStatus"]==1)echo 'checked'; ?> type="radio" name="couponStatus" value="1">上架</label>
								<label><input <?php if($coupon2Row["couponStatus"]==0)echo 'checked'; ?> type="radio" name="couponStatus" value="0">下架 </label>
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