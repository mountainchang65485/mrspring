<?php

	try{
		require_once("Pancake_connectbooks.php");  

		// 藥材管理
		$sql = "SELECT * FROM item NATURAL join effecttype order by itemStatus desc, itemNo";
		$items = $pdo->query($sql);

		$sql = "SELECT * FROM item NATURAL join effecttype order by itemStatus desc, itemNo";
		$items2 = $pdo->query($sql);

	
	}catch(PDOException $e){
		echo $e->getMessage();
	}
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title>湯先生 - 後端管理系統 - 藥材管理</title>	
	<link rel="stylesheet" type="text/css" href="../css/reset.css">
	<link rel="stylesheet" type="text/css" href="../css/admin.css">
	<!-- <link rel="stylesheet" type="text/css" href="css/font.css"> -->
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
				<li class="navNow"><a href="admin_item.php">藥材管理</a></li>
				<li><a href="admin_robot_keyword.php">關鍵字管理</a></li>
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
						<th>名稱</th>
						<th>狀態</th>
					</tr>
					<?php
					while($itemRow = $items->FETCH(PDO::FETCH_ASSOC)){
					?>
					<tr class="navItemsTr" id="navItem<?php echo $itemRow["itemNo"];?>">
						<td>
							<?php echo $itemRow["itemNo"];?>
						</td>
						<td>
							<?php echo $itemRow["itemName"];?>
						</td>
						<td>
							<?php if($itemRow["itemStatus"]==1){echo "上架中";}else{echo "已下架";};?>
						</td>
					</tr>
					<?php
					}
					?>
				</table>
			</div>


			<div class="edit_wrap">

				<form class="itemForms" action="items_update.php" method="post" enctype="multipart/form-data" id="form_item_0">
					<table>
						<input type="hidden" name="itemAdd">
						<tr>
							<th>藥材名稱：</th>
							<td><input type="text" name="itemName" value=""></td>
						</tr>
						<tr>
							<th>筋骨數值：</th>
							<td><input type="number" name="pointA" value="" style="width: 50px;"></td>
						</tr>
						<tr>
							<th>心神數值：</th>
							<td><input type="number" name="pointB" value="" style="width: 50px;"></td>
						</tr>
						<tr>
							<th>美容數值：</th>
							<td><input type="number" name="pointC" value="" style="width: 50px;"></td>
						</tr>
						<tr>
							<th style="vertical-align:top;">藥材介紹：</th>
							<td><textarea name="itemText"></textarea></td>
						</tr>
						<tr>
							<th>限定時段：</th>
							<td>
								<br>
								<br>
								<label><input type="radio" name="itemTime" value="0" >全天</label>
								<label><input type="radio" name="itemTime" value="1" >早上</label>
								<label><input type="radio" name="itemTime" value="2" >下午</label>
								<label><input type="radio" name="itemTime" value="3" >晚上</label>
							</td>
						</tr>
						<tr>
							<th>湯水顏色：</th>
							<td>								
								<input type="color" style="margin-right:20px;"  name="itemColor"><span style="display:inline-block;width:30px;height:30px;background-color:;vertical-align:bottom;"></span>
							</td>
						</tr>
						<tr>
							<th>區間值：</th>
							<td>								
								<label><input type="radio" name="itemInterval" value="default">無</label>
								<label><input type="radio" name="itemInterval" value="1" >大</label>
								<label><input type="radio" name="itemInterval" value="2" >中</label>
								<label><input type="radio" name="itemInterval" value="3" >小</label>
							</td>
						</tr>
						<tr>
							<th>價錢：</th>
							<td><input type="number" name="itemPrice" value="" style="width: 50px;"></td>
						</tr>
						<tr>
							<th>藥材彩色圖片：</th>
							<td><img src="" class="itemPics" style="width:50px;"><input type="file" name="itemImgUrl[]" value=""></td>
						</tr>
						<tr>
							<th>藥材印章圖片：</th>
							<td><img src="" class="itemPics" style="width:50px;"><input type="file" name="itemImgUrl[]" value=""></td>
						</tr>
						<tr>
							<th>藥材百科圖片：</th>
							<td><img src="" class="itemPics" style="width:50px;"><input type="file" name="itemImgUrl[]" value=""></td>
						</tr>
						<tr>
							<th>藥材原始圖片：</th>
							<td><img src="" class="itemPics" style="width:50px;"><input type="file" name="itemImgUrl[]" value=""></td>
						</tr>
						<tr>
							<th>藥材種類：</th>
							<td>
								<label><input type="radio" name="effectTypeNo" value="1" >舒筋活骨</label>
								<label><input type="radio" name="effectTypeNo" value="2" >安定心神</label>
								<label><input type="radio" name="effectTypeNo" value="3" >養顏美容</label>
							</td>
						</tr>
						<tr>
							<th>上架狀態：</th>
							<td>
								<label><input type="radio" name="itemStatus" value="1">上架</label>
								<label><input type="radio" name="itemStatus" value="0">下架</label>
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
				while($itemRow2 = $items2->FETCH(PDO::FETCH_ASSOC)){
				?>
					<form class="itemForms" action="items_update.php" method="post" enctype="multipart/form-data" id="form_item_<?php echo $itemRow2["itemNo"];?>">
						<table>
							<input type="hidden" name="itemNo" value="<?php echo $itemRow2["itemNo"];?>">
							<tr>
								<th>藥材名稱：</th>
								<td><input type="text" name="itemName" value="<?php echo $itemRow2["itemName"];?>"></td>
							</tr>
							<tr>
								<th>筋骨數值：</th>
								<td><input type="number" name="pointA" value="<?php echo $itemRow2["pointA"];?>" style="width: 50px;"></td>
							</tr>
							<tr>
								<th>心神數值：</th>
								<td><input type="number" name="pointB" value="<?php echo $itemRow2["pointB"];?>" style="width: 50px;"></td>
							</tr>
							<tr>
								<th>美容數值：</th>
								<td><input type="number" name="pointC" value="<?php echo $itemRow2["pointC"];?>" style="width: 50px;"></td>
							</tr>
							<tr>
								<th style="vertical-align:top;">藥材介紹：</th>
								<td><textarea name="itemText"><?php echo $itemRow2["itemText"];?></textarea></td>
							</tr>
							<tr>
								<th>限定時段：</th>
								<td>
									<span>目前設定：
									<?php 
									switch($itemRow2["itemTime"]){
										case '0': echo '全天'; break;
										case '1': echo '早上'; break;
										case '2': echo '下午'; break;
										case '3': echo '晚上'; break;
									}
									?>
									</span>
									<br>
									<br>
									<label><input type="radio" name="itemTime" value="0" <?php if($itemRow2["itemTime"]==0){ echo "checked";};?>>全天</label>
									<label><input type="radio" name="itemTime" value="1" <?php if($itemRow2["itemTime"]==1){ echo "checked";};?>>早上</label>
									<label><input type="radio" name="itemTime" value="2" <?php if($itemRow2["itemTime"]==2){ echo "checked";};?>>下午</label>
									<label><input type="radio" name="itemTime" value="3" <?php if($itemRow2["itemTime"]==3){ echo "checked";};?>>晚上</label>
								</td>
							</tr>
							<tr>
								<th>湯水顏色：</th>
								<td>
									<p>當前顏色：<span style="display:inline-block;width:30px;height:30px;background-color:<?php echo $itemRow2["itemColor"];?>;vertical-align:bottom;"><span></p>
									<br>
									<br>
									<p>修改顏色：<input type="color" style="margin-right:20px;" value="<?php echo $itemRow2["itemColor"];?>" name="itemColor"><span style="display:inline-block;width:30px;height:30px;background-color:<?php echo $itemRow2["itemColor"];?>;vertical-align:bottom;"></span></p>
								</td>
							</tr>
							<tr>
								<th>區間值：</th>
								<td>
									<span>當前區間：
									<?php 
									switch($itemRow2["itemInterval"]){
										case '': echo '無'; break;
										case '1': echo '大'; break;
										case '2': echo '中'; break;
										case '3': echo '小'; break;
									}
									?></span>
									<br>
									<br>
									<label><input type="radio" name="itemInterval" value="default" <?php if($itemRow2["itemInterval"]==null){ echo "checked";};?>>無</label>
									<label><input type="radio" name="itemInterval" value="1"  <?php if($itemRow2["itemInterval"]==1){ echo "checked";};?>>大</label>
									<label><input type="radio" name="itemInterval" value="2"  <?php if($itemRow2["itemInterval"]==2){ echo "checked";};?>>中</label>
									<label><input type="radio" name="itemInterval" value="3"  <?php if($itemRow2["itemInterval"]==3){ echo "checked";};?>>小</label>
								</td>
							</tr>
							<tr>
								<th>價錢：</th>
								<td><input type="number" name="itemPrice" value="<?php echo $itemRow2["itemPrice"]?>" style="width: 50px;"></td>
							</tr>
							<tr>
								<th>藥材彩色圖片：</th>
								<td><img src="../<?php echo $itemRow2["itemImg1Url"]?>" class="itemPics" style="width:50px;"><input type="file" name="itemImgUrl[]" value="<?php echo $itemRow2["itemImg1Url"];?>"></td>
							</tr>
							<tr>
								<th>藥材印章圖片：</th>
								<td><img src="../<?php echo $itemRow2["itemImg2Url"]?>" class="itemPics" style="width:50px;"><input type="file" name="itemImgUrl[]" value="<?php echo $itemRow2["itemImg2Url"];?>"></td>
							</tr>
							<tr>
								<th>藥材百科圖片：</th>
								<td><img src="../<?php echo $itemRow2["itemImg3Url"]?>" class="itemPics" style="width:50px;"><input type="file" name="itemImgUrl[]" value="<?php echo $itemRow2["itemImg3Url"];?>"></td>
							</tr>
							<tr>
								<th>藥材原始圖片：</th>
								<td><img src="../<?php echo $itemRow2["itemImg4Url"]?>" class="itemPics" style="width:50px;"><input type="file" name="itemImgUrl[]" value="<?php echo $itemRow2["itemImg4Url"];?>"></td>
							</tr>
							<tr>
								<th>藥材種類：</th>
								<td>
									<span>當前種類：<?php if($itemRow2["effectTypeNo"]==1){echo "舒筋活骨";}elseif($itemRow2["effectTypeNo"]==2){echo "安定心神";}else{echo "養顏美容";};?></span>
									<br>
									<br>
									<label><input type="radio" name="effectTypeNo" value="1" <?php if($itemRow2["effectTypeNo"]==1){ echo "checked";};?>>舒筋活骨</label>
									<label><input type="radio" name="effectTypeNo" value="2" <?php if($itemRow2["effectTypeNo"]==2){ echo "checked";};?>>安定心神</label>
									<label><input type="radio" name="effectTypeNo" value="3" <?php if($itemRow2["effectTypeNo"]==3){ echo "checked";};?>>養顏美容</label>
								</td>
							</tr>
							<tr>
								<th>上架狀態：</th>
								<td>
									<span>當前狀態：<?php if($itemRow2["itemStatus"]==0){echo "下架";}else{echo "上架";};?></span>
									<br>
									<br>
									<label><input type="radio" name="itemStatus" value="1" <?php if($itemRow2["itemStatus"]==1){ echo "checked";};?>>上架</label>
									<label><input type="radio" name="itemStatus" value="0" <?php if($itemRow2["itemStatus"]==0){ echo "checked";};?>>下架</label>
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