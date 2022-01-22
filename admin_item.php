<?php
	try{
		require_once("php/connectBooks.php");   
		// 訂單管理
		$sql = "SELECT * FROM orders NATURAL join member NATURAL join card NATURAL join branch NATURAL join coupon";
		$orders = $pdo->query($sql);

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
	<title>湯先生 - 藥材管理</title>
	<link rel="stylesheet" type="text/css" href="css/admin.css">
	<!-- <link rel="stylesheet" type="text/css" href="css/font.css"> -->
	<link rel="stylesheet" type="text/css" href="css/reset.css">
	<script type="text/javascript" src="js/jquery-3.3.1.min.js"></script>
	<script type="text/javascript" src="js/admin.js"></script>
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
				<li>訂單管理</li>
				<li class="admin_nav_service">營運管理
					<div class="admin_service_item">
						<p>分店管理</p>
						<p>房間管理</p>
						<p>房間關閉</p>
					</div>
				</li>
				<li>會員管理</li>
				<li>藥材管理</li>
				<li class="admin_nav_robot">機器人管理
					<div class="admin_robot_item">
						<p>預設文字編輯</p>
						<p>關鍵字與回覆</p>
					</div>
				</li>
				
				<li>討論區管理</li>
				<li>諮詢管理</li>
				<li>優惠券管理</li>
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
					<tr class="navItemsTr" id="navItem<? echo $itemRow["itemNo"]?>">
						<td>
							<? echo $itemRow["itemNo"]?>
						</td>
						<td>
							<? echo $itemRow["itemName"]?>
						</td>
						<td>
							<? if($itemRow["itemStatus"]==1){echo "上架中";}else{echo "已下架";};?>
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
								<input type="radio" name="itemTime" value="0" >全天
								<input type="radio" name="itemTime" value="1" >早上
								<input type="radio" name="itemTime" value="2" >下午
								<input type="radio" name="itemTime" value="3" >晚上
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
								<input type="radio" name="itemInterval" value="default">無
								<input type="radio" name="itemInterval" value="1" >大
								<input type="radio" name="itemInterval" value="2" >中
								<input type="radio" name="itemInterval" value="3" >小
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
								<input type="radio" name="effectTypeNo" value="1" >舒筋活骨
								<input type="radio" name="effectTypeNo" value="2" >安定心神
								<input type="radio" name="effectTypeNo" value="3" >養顏美容
							</td>
						</tr>
						<tr>
							<th>上架狀態：</th>
							<td>
								<input type="radio" name="itemStatus" value="1">上架
								<input type="radio" name="itemStatus" value="0">下架
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
					<form class="itemForms" action="items_update.php" method="post" enctype="multipart/form-data" id="form_item_<?php echo $itemRow2["itemNo"]?>">
						<table>
							<input type="hidden" name="itemNo" value="<?php echo $itemRow2["itemNo"]?>">
							<tr>
								<th>藥材名稱：</th>
								<td><input type="text" name="itemName" value="<?php echo $itemRow2["itemName"]?>"></td>
							</tr>
							<tr>
								<th>筋骨數值：</th>
								<td><input type="number" name="pointA" value="<?php echo $itemRow2["pointA"]?>" style="width: 50px;"></td>
							</tr>
							<tr>
								<th>心神數值：</th>
								<td><input type="number" name="pointB" value="<?php echo $itemRow2["pointB"]?>" style="width: 50px;"></td>
							</tr>
							<tr>
								<th>美容數值：</th>
								<td><input type="number" name="pointC" value="<?php echo $itemRow2["pointC"]?>" style="width: 50px;"></td>
							</tr>
							<tr>
								<th style="vertical-align:top;">藥材介紹：</th>
								<td><textarea name="itemText"><?php echo $itemRow2["itemText"]?></textarea></td>
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
									<input type="radio" name="itemTime" value="0" <?php if($itemRow2["itemTime"]==0){ echo "checked";};?>>全天
									<input type="radio" name="itemTime" value="1" <?php if($itemRow2["itemTime"]==1){ echo "checked";};?>>早上
									<input type="radio" name="itemTime" value="2" <?php if($itemRow2["itemTime"]==2){ echo "checked";};?>>下午
									<input type="radio" name="itemTime" value="3" <?php if($itemRow2["itemTime"]==3){ echo "checked";};?>>晚上
								</td>
							</tr>
							<tr>
								<th>湯水顏色：</th>
								<td>
									<p>當前顏色：<span style="display:inline-block;width:30px;height:30px;background-color:<?php echo $itemRow2["itemColor"]?>;vertical-align:bottom;"><span></p>
									<br>
									<br>
									<p>修改顏色：<input type="color" style="margin-right:20px;" value="<?php echo $itemRow2["itemColor"]?>" name="itemColor"><span style="display:inline-block;width:30px;height:30px;background-color:<?php echo $itemRow2["itemColor"]?>;vertical-align:bottom;"></span></p>
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
									<input type="radio" name="itemInterval" value="default" <?php if($itemRow2["itemInterval"]==null){ echo "checked";};?>>無
									<input type="radio" name="itemInterval" value="1"  <?php if($itemRow2["itemInterval"]==1){ echo "checked";};?>>大
									<input type="radio" name="itemInterval" value="2"  <?php if($itemRow2["itemInterval"]==2){ echo "checked";};?>>中
									<input type="radio" name="itemInterval" value="3"  <?php if($itemRow2["itemInterval"]==3){ echo "checked";};?>>小
								</td>
							</tr>
							<tr>
								<th>價錢：</th>
								<td><input type="number" name="itemPrice" value="<?php echo $itemRow2["itemPrice"]?>" style="width: 50px;"></td>
							</tr>
							<tr>
								<th>藥材彩色圖片：</th>
								<td><img src="<?php echo $itemRow2["itemImg1Url"]?>" class="itemPics" style="width:50px;"><input type="file" name="itemImgUrl[]" value="<?php echo $itemRow2["itemImg1Url"]?>"></td>
							</tr>
							<tr>
								<th>藥材印章圖片：</th>
								<td><img src="<?php echo $itemRow2["itemImg2Url"]?>" class="itemPics" style="width:50px;"><input type="file" name="itemImgUrl[]" value="<?php echo $itemRow2["itemImg2Url"]?>"></td>
							</tr>
							<tr>
								<th>藥材百科圖片：</th>
								<td><img src="<?php echo $itemRow2["itemImg3Url"]?>" class="itemPics" style="width:50px;"><input type="file" name="itemImgUrl[]" value="<?php echo $itemRow2["itemImg3Url"]?>"></td>
							</tr>
							<tr>
								<th>藥材原始圖片：</th>
								<td><img src="<?php echo $itemRow2["itemImg4Url"]?>" class="itemPics" style="width:50px;"><input type="file" name="itemImgUrl[]" value="<?php echo $itemRow2["itemImg4Url"]?>"></td>
							</tr>
							<tr>
								<th>藥材種類：</th>
								<td>
									<span>當前種類：<?php if($itemRow2["effectTypeNo"]==1){echo "舒筋活骨";}elseif($itemRow2["effectTypeNo"]==2){echo "安定心神";}else{echo "養顏美容";};?></span>
									<br>
									<br>
									<input type="radio" name="effectTypeNo" value="1" <?php if($itemRow2["effectTypeNo"]==1){ echo "checked";};?>>舒筋活骨
									<input type="radio" name="effectTypeNo" value="2" <?php if($itemRow2["effectTypeNo"]==2){ echo "checked";};?>>安定心神
									<input type="radio" name="effectTypeNo" value="3" <?php if($itemRow2["effectTypeNo"]==3){ echo "checked";};?>>養顏美容
								</td>
							</tr>
							<tr>
								<th>上架狀態：</th>
								<td>
									<span>當前狀態：<?php if($itemRow2["itemStatus"]==0){echo "下架";}else{echo "上架";};?></span>
									<br>
									<br>
									<input type="radio" name="itemStatus" value="1" <?php if($itemRow2["itemStatus"]==1){ echo "checked";};?>>上架
									<input type="radio" name="itemStatus" value="0" <?php if($itemRow2["itemStatus"]==0){ echo "checked";};?>>下架
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


		<!-- robot_q&a -->
		<div class="admin_content admin_content_robot_qna">
			<div class="item_wrap">
				<div class="add"></div>
				<table>
					<tr>
						<th>編號</th>
						<th>關鍵字</th>
						<th>狀態</th>
					</tr>
					<tr>
						<td>1</td>
						<td>安定心神</td>
						<td>上架</td>
					</tr>
					<tr>
						<td>2</td>
						<td>美容</td>
						<td>上架</td>
					</tr>
					<tr>
						<td>3</td>
						<td>湯先生</td>
						<td>上架</td>
					</tr>
					<tr>
						<td>1</td>
						<td>安定心神</td>
						<td>上架</td>
					</tr>
					<tr>
						<td>2</td>
						<td>美容</td>
						<td>上架</td>
					</tr>
					<tr>
						<td>3</td>
						<td>湯先生</td>
						<td>上架</td>
					</tr>
					<tr>
						<td>1</td>
						<td>安定心神</td>
						<td>上架</td>
					</tr>
					<tr>
						<td>2</td>
						<td>美容</td>
						<td>上架</td>
					</tr>
					<tr>
						<td>3</td>
						<td>湯先生</td>
						<td>上架</td>
					</tr>
					<tr>
						<td>1</td>
						<td>安定心神</td>
						<td>上架</td>
					</tr>
					<tr>
						<td>2</td>
						<td>美容</td>
						<td>上架</td>
					</tr>
					<tr>
						<td>3</td>
						<td>湯先生</td>
						<td>上架</td>
					</tr>
					<tr>
						<td>1</td>
						<td>安定心神</td>
						<td>上架</td>
					</tr>
					<tr>
						<td>2</td>
						<td>美容</td>
						<td>上架</td>
					</tr>
					<tr>
						<td>3</td>
						<td>湯先生</td>
						<td>上架</td>
					</tr>
				</table>
			</div>
			<div class="edit_wrap">
				
				<form action="#">
					<table>
						<tr>
							<th>關鍵字：</th>
							<td><input type="text" name="" value="安定心神"></td>
						</tr>
						
						<tr>
							<th style="vertical-align:top;">回覆內容：</th>
							<td><textarea>長得很像枸杞的地瓜，但絕對不是枸杞唷</textarea></td>
						</tr>
						<tr>
							<th>狀態：</th>
							<td>
								上架<input type="radio" name="status" value="1">
								下架<input type="radio" name="status" value="0">
								
							</td>
						</tr>
						<tr>
							<th>開啟標籤：</th>
							<td>
								是<input type="radio" name="tag" value="1">
								否<input type="radio" name="tag" value="0">
								
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
			</div>
			<div class="clear"></div>
		</div>


		<!-- robot_msg -->
		<div class="admin_content admin_content_robot_msg">
			<div class="robot_msg_wrap">
				<form action="#">
					<table>
						<tr>
							<th style="vertical-align:top;">機器人訊息：</th>
							<td>
								<textarea>過年期間:初一~初三全館休息
								</textarea>
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
			</div>
		</div>

		<!-- member -->
		<div class="admin_content admin_content_member">
			<div class="item_wrap">
				<div class="add">
				</div>
				<table>
					<tr>
						<th>編號</th>
						<th>帳號</th>
						<th>名稱</th>
						<th>狀態</th>
					</tr>
					<tr>
						<td>1</td>
						<td>aaaacccc</td>
						<td>煎餅</td>
						<td>正常</td>
					</tr>
					<tr>
						<td>2</td>
						<td>aaa2222s</td>
						<td>姦餅</td>
						<td>停權</td>
					</tr>
					<tr>
						<td>3</td>
						<td>ffffffff</td>
						<td>奸餅</td>
						<td>正常</td>
					</tr>
				</table>
			</div>
			<div class="edit_wrap">
				<form action="#">
					<table>
						<tr>
							<th>帳號：</th>
							<td>aaaacccc</td>
						</tr>
						<tr>
							<th>密碼：</th>
							<td><input type="text" name="" value="aaaacccc" readonly></td>
						</tr>
						<tr>
							<th>姓名：</th>
							<td>煎餅</td>
						</tr>
						
						<tr>
							<th>暱稱：</th>
							<td>小奸奸</td>
						</tr>
						<tr>
							<th>電話：</th>
							<td>0912345678</td>
						</tr>
						<tr>
							<th>信箱：</th>
							<td>jian@gmail.com</td>
						</tr>
						<tr>
							<th>狀態：</th>
							<td>
								<select>
									<option value="1">正常</option>
									<option value="0">停權</option>
								</select>
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
			</div>
			<div class="clear"></div>
		</div>
		<!-- forum -->
		<div class="admin_content admin_content_forum">
			<div class="item_wrap">
				<div class="kind_of_report">
					<form action="#">
						<select>
							<option>文章</option>
							<option>留言</option>
						</select>
					</form>
				</div>
				<table>
					<tr>
						<th>編號</th>
						<th>檢舉數</th>
						<th>處理狀態</th>
						<th>狀態</th>
					</tr>
					<tr>
						<td>1</td>
						<td>30</td>
						<td>未處理</td>
						<td>正常</td>
					</tr>
					<tr>
						<td>2</td>
						<td>10</td>
						<td>已處理</td>
						<td>關閉</td>
					</tr>
					<tr>
						<td>3</td>
						<td>1</td>
						<td>未處理</td>
						<td>正常</td>
					</tr>
				</table>
			</div>
			<div class="edit_wrap">
				<form action="#">

					<table>
						<tr>
							<th>標題：</th>
							<td>12123123123</td>
						</tr>
						<tr>
							<th>內容：</th>
							<td><textarea style="vertical-align:top;" readonly>事到務去，山他全驗。等樣我來這人有、快龍品，生世的在一燈活一球孩一機：把待黃盡作育，存等軍化進生指母見不離？已車無得兒新流病：類十願的受到的賽失；進式的我現平響遠品我有斯第心什外部因不來說銀？汽真後營題地，手放中不對止營面個歌環……人果認，收來二定下院校；林你是中最上已得一國什？</textarea></td>
						</tr>
						<tr>
							<th>會員編號：</th>
							<td>1</td>
						</tr>
						<tr>
							<th>發表時間：</th>
							<td>
								2019-1-3
							</td>
						</tr>
						<tr>
							<th>檢舉數：</th>
							<td>30</td>
						</tr>
						<tr>
							<th>狀態：</th>
							<td>
								<select>
									<option>開啟</option>
									<option>關閉</option>
								</select>
							</td>
						</tr>
						<tr>
							<th>處理狀態：</th>
							<td>
								<select>
									<option>未處理</option>
									<option>已處理</option>
								</select>
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
			</div>
			<div class="clear"></div>
		</div>

		<!-- advisory -->
		<div class="admin_content admin_content_advisory">
			<div class="item_wrap">
				<div class="add">
				</div>
				<table>
					<tr>
						<th>編號</th>
						<th>類別</th>
						<th>狀態</th>
					</tr>
					<tr>
						<td>1</td>
						<td>舒筋活骨</td>
						<td>上架</td>
					</tr>
					<tr>
						<td>2</td>
						<td>舒筋活骨</td>
						<td>上架</td>
					</tr>
					<tr>
						<td>3</td>
						<td>養顏美容</td>
						<td>上架</td>
					</tr>
				</table>
			</div>
			<div class="edit_wrap">
				<form action="#">
					<table>
						<tr>
							<th>類別：</th>
							<td><input type="text" name="" value="舒筋活骨"></td>
						</tr>
						<tr>
							<th style="vertical-align:top;">題目：</th>
							<td><textarea>工作或日常生活上，是否常常處於久坐狀態？</textarea></td>
						</tr>
						<tr>
							<th>選項一：</th>
							<td><input type="text" name="" value="總是"></td>
						</tr>
						<tr>
							<th>選項一分數：</th>
							<td><input type="number" name="" value="3" style="width: 50px;"></td>
						</tr>
						<tr>
							<th>選項二：</th>
							<td><input type="text" name="" value="常常"></td>
						</tr>
						<tr>
							<th>選項二分數：</th>
							<td><input type="number" name="" value="2" style="width: 50px;"></td>
						</tr>
						<tr>
							<th>選項三：</th>
							<td><input type="text" name="" value="常常"></td>
						</tr>
						<tr>
							<th>選項三分數：</th>
							<td><input type="number" name="" value="1" style="width: 50px;"></td>
						</tr>
						<tr>
							<th>狀態：</th>
							<td>
								上架<input type="radio" name="interval" value="1">
								下架<input type="radio" name="interval" value="0">
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
			</div>
			<div class="clear"></div>
		</div>

		<!-- room -->
		<div class="admin_content admin_content_room">
			<div class="item_wrap">
				<table>
					<tr>
						<th>分店</th>
						<th>名稱</th>
						<th>狀態</th>
					</tr>
					<tr>
						<td>礁溪店</td>
						<td>一號房</td>
						<td>開放</td>
					</tr>
					<tr>
						<td>礁溪店</td>
						<td>二號房</td>
						<td>開放</td>
					</tr>
					<tr>
						<td>礁溪店</td>
						<td>三號房</td>
						<td>開放</td>
					</tr>
				</table>
			</div>
			<div class="edit_wrap">
				<form action="#">
					<table>
						<tr>
							<th>分店：</th>
							<td>礁溪店</td>
						</tr>
						<tr>
							<th>房名：</th>
							<td><input type="text" name="" value="一號房" ></td>
						</tr>
						<tr>
							<th>價格：</th>
							<td><input type="number" name="" value="1200" style="width: 100px;"></td>
						</tr>
						<tr>
							<th style="vertical-align:top;">房間介紹：</th>
							<td><textarea>冬暖夏涼，各種舒適</textarea></td>
						</tr>
						<tr>
							<th>圖片：</th>
							<td><input type="file" name="" value=""></td>
						</tr>
						<tr>
							<th>狀態：</th>
							<td>
								上架<input type="radio" name="status" value="1">
								下架<input type="radio" name="status" value="0">
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
			</div>
			<div class="clear"></div>
		</div>
		<!-- shop -->
		<div class="admin_content admin_content_shop">
			<div class="item_wrap">
				<table>
					<tr>
						<th>名稱</th>
					</tr>
					<tr>
						<td>礁溪店</td>
						
					</tr>
					<tr>
						<td>烏來店</td>
						
					</tr>
					<tr>
						<td>金山店</td>
					</tr>
				</table>
			</div>
			<div class="edit_wrap">
				<form action="#">
					<table>
						<tr>
							<th>分店：</th>
							<td>礁溪店</td>
						</tr>
						<tr>
							<th>地址：</th>
							<td><input style="width: 400px;" type="text" name="" value="宜蘭縣礁溪鄉礁溪路五段與中山路二段交接口" ></td>
						</tr>
						<tr>
							<th>電話：</th>
							<td><input type="text" name="" value="02-1234567"></td>
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
			</div>
			<div class="clear"></div>
		</div>
		<!-- room_shut -->
		<div class="admin_content admin_content_room_shut">
			<div class="item_wrap">
				<div class="add"></div>
				<table>
					<tr>
						<th>日期</th>
						<th>分店</th>
						<th>房名</th>
					</tr>
					<tr>
						<td>2019-1-3</td>
						<td>礁溪店</td>
						<td>一號房</td>
					</tr>
					<tr>
						<td>2019-1-4</td>
						<td>礁溪店</td>
						<td>二號房</td>
					</tr>
					<tr>
						<td>2019-1-5</td>
						<td>礁溪店</td>
						<td>三號房</td>
					</tr>
				</table>
			</div>
			<div class="edit_wrap">
				<form action="#">
					<table>
						<tr>
							<th>日期：</th>
							<td><input type="date" name="" value="2019-01-03"></td>
						</tr>
						<tr>
							<th>分店：</th>
							<td>
								礁溪店<input type="radio" checked value="1" style="margin-right: 30px;" name="shop">
								烏來店<input type="radio" checked value="1" style="margin-right: 30px;" name="shop">
								北投店<input type="radio" checked value="1" style="margin-right: 30px;" name="shop">
							</td>
						</tr>
						<tr>
							<th>房名：</th>
							<td>
								<select>
									<option>一號房</option>
									<option>二號房</option>
									<option>三號房</option>
									<option>四號房</option>
									<option>五號房</option>
									<option>六號房</option>
								</select>
							</td>
						</tr>
						<tr>
							<th>關閉時段：</th>
							<td>
								早<input type="checkbox" name="time" value="1" style="margin-right: 30px;" checked="">
								午<input type="checkbox" name="time" value="1" style="margin-right: 30px;">
								晚<input type="checkbox" name="time" value="1" style="margin-right: 30px;">
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
			</div>
			<div class="clear"></div>
		</div>
		<!-- order -->
		<div class="admin_content admin_content_order">
			<div class="item_wrap">
				<div class="filter">
					<input type="date" name="date">
					<select>
						<option>早</option>
						<option>午</option>
						<option>晚</option>
					</select>
				</div>
				<table>
					<tr>
						<th>編號</th>
						<th>會員姓名</th>
						<th>狀態</th>
					</tr>
					<tr>
						<td>1</td>
						<td>陳一廷</td>
						<td>未入住</td>
					</tr>
					<tr>
						<td>2</td>
						<td>林二廷</td>
						<td>未入住</td>
					</tr>
					<tr>
						<td>3</td>
						<td>徐三廷</td>
						<td>未入住</td>
					</tr>
				</table>
			</div>
			<div class="edit_wrap">
				<form action="#">
					<table>
						<tr>
							<th>編號：</th>
							<td>1</td>
						</tr>
						<tr>
							<th>會員姓名:</th>
							<td>林一廷</td>
						</tr>
						<tr>
							<th>會員電話：</th>
							<td>
								0912345678
							</td>
						</tr>
						<tr>
							<th>下單時間：</th>
							<td>2019-01-03</td>
						</tr>
						<tr>
							<th>入住時間：</th>
							<td><input type="date" name="" value="2019-01-03"></td>
						</tr>
						<tr>
							<th>入住時段：</th>
							<td>
								<select>
									<option value="1">早</option>
									<option value="2">午</option>
									晚<option value="3"></option>
								</select>
							</td>
						</tr>
						
						<tr>
							<th>訂購房間：</th>
							<td>
								<select>
									<option>北投店</option>
									<option>礁溪店</option>
									<option>烏來店</option>
								</select>
								<select>
									<option>一號房</option>
									<option>二號房</option>
									<option>三號房</option>
									<option>四號房</option>
									<option>五號房</option>
									<option>六號房</option>
								</select>
							</td>
						</tr>
						<tr>
							<th>藥材：</th>
							<td>枸杞、紅棗</td>
						</tr>
						<tr>
							<th>狀態：</th>
							<td>
								未入住<input type="radio" checked name="status" value="1">
								已入住<input type="radio" name="status" value="0">
								取消<input type="radio" name="status" value="0">
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
			</div>
			<div class="clear"></div>
		</div>

		<!-- coupon -->
		<div class="admin_content admin_content_coupon">
			<div class="item_wrap">
				<div class="add">
				</div>
				<table>
					<tr>
						<th>編號</th>
						<th>名稱</th>
						<th>狀態</th>
					</tr>
					<tr>
						<td>1</td>
						<td>情人節特惠</td>
						<td>上架</td>
					</tr>
					<tr>
						<td>2</td>
						<td>新春特惠</td>
						<td>上架</td>
					</tr>
					<tr>
						<td>3</td>
						<td>清明節特惠</td>
						<td>上架</td>
					</tr>
				</table>
			</div>
			<div class="edit_wrap">
				<form action="#">
					<table>
						<tr>
							<th>編號：</th>
							<td>1</td>
						</tr>
						<tr>
							<th>名稱：</th>
							<td><input type="text" name="" value="情人節特惠"></td>
						</tr>
						<tr>
							<th>種類：</th>
							<td>
								打折<input checked type="radio" name="kind_of_cupon">
								折抵<input type="radio" name="kind_of_cupon">
							</td>
						</tr>
						<tr>
							<th>折扣：</th>
							<td><input type="number" name="" value="0.8" style="width: 50px;"></td>
						</tr>
						
						<tr>
							<th>狀態：</th>
							<td>
								上架<input type="radio" name="status" value="1">
								下架<input type="radio" name="status" value="0">
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