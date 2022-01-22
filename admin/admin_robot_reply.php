<?php
	try{
		require_once("Pancake_connectbooks.php");  

		// 機器人回覆管理
		$sql = "SELECT * FROM reply natural join keyword";
		$reply1 = $pdo->query($sql);

		$sql = "SELECT * FROM reply natural join keyword";
        $reply2 = $pdo->query($sql);
        
        $sql = "SELECT * FROM keyword";
        $keyword = $pdo -> query($sql);

	
	}catch(PDOException $e){
		echo $e->getMessage();
	}
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title>湯先生 - 後端管理系統 - 機器人回覆管理</title>
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
        .replyForms{
            display: none;
        }
        textarea{
            width: 400px;
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
				<li class="navNow"><a href="admin_robot_reply.php">回覆管理</a></li>
				<li><a href="admin_forum.php">討論區管理</a></li>
				<li><a href="admin_question.php">諮詢管理</a></li>
				<li><a href="admin_coupon.php">優惠券管理</a></li>
			</ul>
		</div>

		<!-- keyword -->
		<div class="admin_content admin_content_item">
			<div class="item_wrap">
				<div id="navAddItemBtn" class="navItemsTr add" style="margin:20px auto;">
				</div>
				<table>
					<tr>
						<th>編號</th>
						<th>對應關鍵字</th>
					</tr>
					<?php
					while($reply1Row = $reply1->FETCH(PDO::FETCH_ASSOC)){
					?>
					<tr class="navItemsTr" id="navItem<?php echo $reply1Row["replyNo"]?>">
						<td>
                            <?php echo $reply1Row["replyNo"]?>
						</td>
						<td>
                            <?php echo $reply1Row["keywordName"]?>
						</td>
					</tr>
					<?php
					}
					?>
				</table>
			</div>


			<div class="edit_wrap">

				<form class="replyForms" action="reply_update.php" method="post" id="form_reply_0">
					<table>
						<input type="hidden" name="replyAdd">
						<tr>
							<th>回覆內容：</th>
							<td><textarea type="text" name="replyText" value=""></textarea></td>
                        </tr>

						<tr>
							<th>對應關鍵字：</th>
							<td>
                                <select type="select" name="keywordNo">
                                    <?php
                                    while($keywordRow = $keyword->FETCH(PDO::FETCH_ASSOC)){
                                    ?>
                                    <option value="<?php echo $keywordRow["keywordNo"]?>"><?php echo $keywordRow["keywordName"]?></option>
                                    <?php
                                    }
                                    ?>
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
				while($replyRow2 = $reply2->FETCH(PDO::FETCH_ASSOC)){
                ?>
                
                <form class="replyForms" action="reply_update.php" method="post">
					<table>
						<input type="hidden" name="replyNo" value="<?php echo $replyRow2["replyNo"]?>">
						<tr>
							<th>回覆內容：</th>
							<td><textarea name="replyText" ><?php echo $replyRow2["replyText"]?></textarea></td>
                        </tr>

                        <tr>
							<th>對應關鍵字：</th>
							<td>
                                <p>目前對應關鍵字：<?php echo $replyRow2["keywordName"]?></p>
                                <select type="select" name="keywordNo">
                                    <?php
                                    $sql = "SELECT * FROM keyword";
                                    $keyword = $pdo -> query($sql);
                                    while( $keywordRow = $keyword->FETCH(PDO::FETCH_ASSOC)){
                                    ?>
                                    <option value="<?php echo $keywordRow["keywordNo"]?>"><?php echo $keywordRow["keywordName"]?></option>
                                    <?php
                                    }
                                    ?>
                                </select>
                            </td>
                        </tr>
                        
						<tr>
							<td colspan="2">
								<div class="edit_btn">
                                    <input type="submit" name="delete" value="刪除">
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
	itemForms = document.getElementsByClassName("replyForms");
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