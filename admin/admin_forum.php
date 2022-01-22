<?php
	try{
		require_once("Pancake_connectbooks.php");   

		// 優惠券管理
		$sql = "SELECT * from article order by artNo Asc";
		$forum = $pdo->query($sql);

		$sql = "SELECT * from article order by artNo asc";
        $forum2 = $pdo->query($sql);
        
        $sql = "SELECT * from `message` order by mesNo Asc";
		$forum3 = $pdo->query($sql);

		$sql = "SELECT * from `message` order by mesNo asc";
		$forum4 = $pdo->query($sql);
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
				<li class="navNow"><a href="admin_forum.php">討論區管理</a></li>
				<li><a href="admin_question.php">諮詢管理</a></li>
				<li><a href="admin_coupon.php">優惠券管理</a></li>
			</ul>
		</div>


		<!-- coupon -->
		<div class="admin_content admin_content_coupon">
			<div class="item_wrap">
				<table>
					<tr>
						<th>編號</th>
						<th>文章標題</th>
						<th>狀態</th>
					</tr>
					<?php 
					while($forumRow = $forum->FETCH(PDO::FETCH_ASSOC)){
					?>
					<tr class="navItemsTr">
						<td><?php echo $forumRow["artNo"]?></td>
						<td><?php echo $forumRow["artTitle"]?></td>
						<td><?php if($forumRow["artStatus"]==0){echo '下架';}else{echo '上架';} ;?></td>
					</tr>
					<?php
					}
					?>
				</table>
			</div>
			<div class="edit_wrap">
			<?php while($forum2Row = $forum2 ->FETCH(PDO::FETCH_ASSOC)){ ?>
	
				<form action="forum_update.php" class="itemForms" methods="get">

					<table>
                        <tr>
                            <input type="hidden" name="artNo" value="<?php echo $forum2Row['artNo'] ?>">
							<th>文章編號：</th>
							<td><?php echo $forum2Row['artNo'] ?></td>
						</tr>
						<tr>
							<th>標題：</th>
							<td><?php echo $forum2Row['artTitle'] ?></td>
						</tr>
						<tr>
							<th>內容：</th>
							<td><textarea readonly><?php echo $forum2Row['artText'] ?></textarea></td>
						</tr>
						<tr>
							<th>會員編號：</th>
							<td><?php echo $forum2Row['memNo'] ?></td>
						</tr>
						<tr>
							<th>發表時間：</th>
							<td>
                                 <?php echo $forum2Row['artTime'] ?>
							</td>
						</tr>
						<tr>
							<th>狀態：</th>
							<td>
								<select name="artStatus">
									<option value="1" <?php if($forum2Row["artStatus"]==1)echo "selected='true'"?> >上架</option>
									<option value="0" <?php if($forum2Row["artStatus"]==0)echo "selected='true'"?>>下架</option>
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