<?php
	try{
        require_once("Pancake_connectbooks.php");  
        
		// 優惠券管理
		$sql = "SELECT * from question";
		$question1 = $pdo->query($sql);

		$sql = "SELECT * from question";
		$question2 = $pdo->query($sql);
	
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
				<li class="admin_nav_service"><a href="admin_branch.php">分店管理</a></li>
				<li><a href="admin_member.php">會員管理</a></li>
				<li><a href="admin_item.php">藥材管理</a></li>
				<li><a href="admin_robot_keyword.php">關鍵字管理</a></li>
				<li><a href="admin_robot_reply.php">回覆管理</a></li>
				<li><a href="admin_forum.php">討論區管理</a></li>
				<li class="navNow"><a href="admin_question.php">諮詢管理</a></li>
				<li><a href="admin_coupon.php">優惠券管理</a></li>
			</ul>
		</div>

		<!-- advisory -->
		<div class="admin_content admin_content_advisory">
			<div class="item_wrap">
				<table>
					<tr>
						<th>題號</th>
						<th>類別</th>
					</tr>
					<?php while( $question1Row = $question1->FETCH(PDO::FETCH_ASSOC)){ ?>
					<tr class="navItemsTr">
						<td><?php echo $question1Row["quesNo"]?></td>
						<td>
							<?php 
							if($question1Row["quesType"]==1){
								echo '舒筋活骨類';
							}elseif($question1Row["quesType"]==2){
								echo '安定心神類';
							}else{
								echo '養顏美白類';
							}
							?>
						</td>
					</tr>
					<?php 
					}
					?>
				</table>
			</div>
			<div class="edit_wrap">
				<?php 
				while($question2Row = $question2->FETCH(PDO::FETCH_ASSOC)){
				?>
				<form class="itemForms" action="question_update.php" method="get">
					<input type="hidden" name="quesNo" value="<?php echo $question2Row["quesNo"]; ?>">
					<table>
						<tr>
							<th style="vertical-align:top;">題目敘述：</th>
							<td><textarea name="quesText"><?php echo $question2Row["quesText"]; ?></textarea></td>
						</tr>
						<tr>
							<th>選項一：</th>
							<td><input type="text" name="ans1Text" value="<?php echo $question2Row["ans1Text"]; ?>"></td>
						</tr>
						<tr>
							<th>選項一分數：</th>
							<td><input type="number" name="ans1Score" value="<?php echo $question2Row["ans1Score"]; ?>" style="width: 50px;"></td>
						</tr>
						<tr>
							<th>選項二：</th>
							<td><input type="text" name="ans2Text" value="<?php echo $question2Row["ans2Text"]; ?>"></td>
						</tr>
						<tr>
							<th>選項二分數：</th>
							<td><input type="number" name="ans2Score" value="<?php echo $question2Row["ans2Score"]; ?>" style="width: 50px;"></td>
						</tr>
						<tr>
							<th>選項三：</th>
							<td><input type="text" name="ans3Text" value="<?php echo $question2Row["ans3Text"]; ?>"></td>
						</tr>
						<tr>
							<th>選項三分數：</th>
							<td><input type="number" name="ans3Score" value="<?php echo $question2Row["ans3Score"]; ?>" style="width: 50px;"></td>
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