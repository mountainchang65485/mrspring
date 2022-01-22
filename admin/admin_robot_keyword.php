<?php
	try{
		require_once("Pancake_connectbooks.php");  

		// 機器人關鍵字管理
		$sql = "SELECT * FROM keyword";
		$keyword1 = $pdo->query($sql);

		$sql = "SELECT * FROM keyword";
		$keyword2 = $pdo->query($sql);

	
	}catch(PDOException $e){
		echo $e->getMessage();
	}
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title>湯先生 - 後端管理系統 - 機器人關鍵字管理</title>
	<link rel="stylesheet" type="text/css" href="../css/admin.css">
	<!-- <link rel="stylesheet" type="text/css" href="css/font.css"> -->
	<link rel="stylesheet" type="text/css" href="../css/reset.css">
	<script type="text/javascript" src="../js/jquery-3.3.1.min.js"></script>
	<!-- <script type="text/javascript" src="../js/admin.js"></script> -->
	<style>
		.navItemsTr:hover{
			cursor: pointer;
			background-color: #666;
			color: #fff;
		}
		.itemForms{
			background-color: #fff;
			padding: 20px;
			z-index: -1;
			display: none;
		}
		.edit_wrap{
			padding: 0;
        }
        .keywordForms{
            display: none;
        }
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
				<li class="navNow"><a href="admin_robot_keyword.php">關鍵字管理</a></li>
				<li><a href="admin_robot_reply.php">回覆管理</a></li>
				<li><a href="admin_forum.php">討論區管理</a></li>
				<li><a href="admin_question.php">諮詢管理</a></li>
				<li><a href="admin_coupon.php">優惠券管理</a></li>
			</ul>
		</div>

		<!-- item -->
		<div class="admin_content admin_content_item">
			<div class="item_wrap">
				<div id="navAddItemBtn" class="navItemsTr add" style="margin:20px auto;">
				</div>
				<table>
					<tr>
						<th>編號</th>
						<th>關鍵字</th>
                        <th>上架狀態</th>
                        <th>標籤</th>
					</tr>
					<?php
					while($keyword1Row = $keyword1->FETCH(PDO::FETCH_ASSOC)){
					?>
					<tr class="navItemsTr" id="navItem<?php echo $keyword1Row["keywordNo"]?>">
						<td>
                            <?php echo $keyword1Row["keywordNo"]?>
						</td>
						<td>
                            <?php echo $keyword1Row["keywordName"]?>
						</td>
						<td>
							<?php if($keyword1Row["keywordStatus"]==1){echo "上架中";}else{echo "已下架";};?>
						</td>
						<td>
							<?php if($keyword1Row["keywordTagStatus"]==1){echo "開啟";}else{echo "關閉";};?>
						</td>
					</tr>
					<?php
					}
					?>
				</table>
			</div>


			<div class="edit_wrap">

				<form class="keywordForms" action="keyword_update.php" method="post" id="form_keyword_0">
					<table>
						<input type="hidden" name="keywordAdd">
						<tr>
							<th>關鍵字名稱：</th>
							<td><input type="text" name="keywordName" value=""></td>
                        </tr>
                        <tr>						
							<th>上架狀態：</th>
							<td>
								<label><input type="radio" name="keywordStatus" value="1">上架</label>
								<label><input type="radio" name="keywordStatus" value="0">下架</label>
							</td>
                        </tr>
                        <tr>						
							<th>機器人標籤：</th>
							<td>
								<label><input type="radio" name="keywordTagStatus" value="1">開啟</label>
								<label><input type="radio" name="keywordTagStatus" value="0">關閉</label>
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
				while($keywordRow2 = $keyword2->FETCH(PDO::FETCH_ASSOC)){
                ?>
                
                <form class="keywordForms" action="keyword_update.php" method="post">
					<table>
						<input type="hidden" name="keywordNo" value="<?php echo $keywordRow2["keywordNo"]?>">
						<tr>
							<th>關鍵字名稱：</th>
							<td><input type="text" name="keywordName" value="<?php echo $keywordRow2["keywordName"]?>"></td>
                        </tr>
                        <tr>						
							<th>上架狀態：</th>
							<td>
								<label><input type="radio" name="keywordStatus" value="1" <?php if($keywordRow2["keywordStatus"]==1)echo 'checked'; ?>>上架</label>
								<label><input type="radio" name="keywordStatus" value="0" <?php if($keywordRow2["keywordStatus"]==0)echo 'checked'; ?>>下架</label>
							</td>
                        </tr>
                        <tr>						
							<th>機器人標籤：</th>
							<td>
								<label><input type="radio" name="keywordTagStatus" value="1" <?php if($keywordRow2["keywordTagStatus"]==1)echo 'checked'; ?>>開啟</label>
								<label><input type="radio" name="keywordTagStatus" value="0" <?php if($keywordRow2["keywordTagStatus"]==0)echo 'checked'; ?>>關閉</label>
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
			<div class="edit_wrap">


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
	itemForms = document.getElementsByClassName("keywordForms");
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