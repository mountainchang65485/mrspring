<?php
	try{
		require_once("Pancake_connectbooks.php");  

		// 優惠券管理
		$sql = "SELECT * from member";
		$member1 = $pdo->query($sql);

		$sql = "SELECT * from member";
		$member2 = $pdo->query($sql);
	
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
		#searchInput{
			height: 30px;
			padding: 6px;
			margin: 10px;
		}
		#searchBtn{
			height: 30px;
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
				<li class="navNow"><a href="admin_member.php">會員管理</a></li>
				<li><a href="admin_item.php">藥材管理</a></li>
				<li><a href="admin_robot_keyword.php">關鍵字管理</a></li>
				<li><a href="admin_robot_reply.php">回覆管理</a></li>
				<li><a href="admin_forum.php">討論區管理</a></li>
				<li><a href="admin_question.php">諮詢管理</a></li>
				<li><a href="admin_coupon.php">優惠券管理</a></li>
			</ul>
		</div>


		<!-- member -->
		<div class="admin_content admin_content_coupon">
			<div class="item_wrap">
				<input type="text" id="searchInput" placeholder="輸入帳號查詢"><input type="button" value="查詢" id="searchBtn">
				<table style="margin-top: 20px">
					<tr>
						<th>編號</th>
						<th>ID</th>
						<th>名稱</th>
						<th>狀態</th>
					</tr>
					<?php 
					while($member1Row = $member1->FETCH(PDO::FETCH_ASSOC)){
					?>
					<tr class="navItemsTr">
						<td><?php echo $member1Row["memNo"];?></td>
						<td><?php echo $member1Row["memId"];?></td>
						<td><?php echo $member1Row["memFirstName"],$member1Row["memLastName"];?></td>
						<td><?php if($member1Row["memStatus"]==2){ echo '停權';}else{echo '一般';} ;?></td>
					</tr>
					<?php
					}
					?>
				</table>
			</div>
			<div class="edit_wrap">

			<?php while($member2Row = $member2 ->FETCH(PDO::FETCH_ASSOC)){ ?>
	
				<form class="itemForms" method="get" action="member_update.php">
					<input type="hidden" name="memNo" value="<?php echo $member2Row["memNo"]; ?>">
					<table>
						<tr>
							<th>頭像：</th>
							<td><img src="../<?php echo $member2Row["memImgUrl"]; ?>" alt="會員頭像" style="width:40px;height:40px;"></td>
						</tr>
						<tr>
							<th>編號：</th>
							<td><?php echo $member2Row["memNo"]; ?></td>
						</tr>
						<tr>
							<th>姓氏：</th>
							<td><?php echo $member2Row["memFirstName"]; ?></td>
						</tr>
						<tr>
							<th>名稱：</th>
							<td><?php echo $member2Row["memLastName"]; ?></td>
						</tr>
						<tr>
							<th>暱稱：</th>
							<td><?php echo $member2Row["memNickname"]; ?></td>
						</tr>
						<tr>
							<th>身分證號：</th>
							<td><?php echo $member2Row["twId"]; ?></td>
						</tr>
						<tr>
							<th>電話：</th>
							<td><?php echo $member2Row["memTel"]; ?></td>
						</tr>
						<tr>
							<th>E-mail：</th>
							<td><?php echo $member2Row["memEmail"]; ?></td>
						</tr>
						<tr>
							<th>狀態：</th>
							<td>
								<select name="memStatus" id="memStatusSelect">
									<option value="1" <?php if($member2Row["memStatus"]=='1'){echo "selected='selected'";}?>>一般
									<option value="2" <?php if($member2Row["memStatus"]=='2'){echo "selected='selected'";}?>>停權
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
	
	function ajaxSearch(){
		
		var searchId = document.getElementById("searchInput").value;

		var xhr = new  XMLHttpRequest();
        xhr.onreadystatechange=function (){
            if( xhr.readyState == 4){
                if( xhr.status == 200 ){
					var memResultJson = xhr.responseText;
					memResult = JSON.parse(memResultJson);
					console.log(memResult);
					if(memResult.length==0){
						alert('查無此ID');
					}else{
						//生成左側選單
						navStr = '<input type="text" id="searchInput" placeholder="輸入帳號查詢"><input type="button" value="查詢" id="searchBtn"><table style="margin-top: 20px"><tr><th>編號</th><th>ID</th><th>名稱</th><th>狀態</th></tr>';

						for(var i =0;i<memResult.length;i++){
							navStr += `<tr class="navItemsTr">
										<td>${memResult[i].memNo}</td>
										<td>${memResult[i].memId}</td>
										<td>${memResult[i].memFirstName}${memResult[i].memLastName}</td>
										<td>${statusCheck(memResult[i].memStatus)}</td>
									</tr>`;
						}		

						navStr += `</table>`;

						document.getElementsByClassName("item_wrap")[0].innerHTML = navStr;
						document.getElementById("searchInput").addEventListener('change', ajaxSearch);
						document.getElementById("searchBtn").addEventListener('click', ajaxSearch);

						//生成右側表單

						editStr = '';
						for(var i=0;i<memResult.length;i++){
							eachMemStatus = '';
							if(memResult[i].memStatus==1){
								eachMemStatus=`<option value="1" selected='selected'>一般<option value="2">停權`;
							}else{
								eachMemStatus=`<option value="1">一般<option value="2" selected='selected'>停權`;
							};

							editStr += `<form class="itemForms" method="get" action="member_update.php">
									<input type="hidden" name="memNo" value="${memResult[i].memNo}">
									<table>
										<tr>
											<th>頭像：</th>
											<td><img src="../${memResult[i].memImgUrl}" alt="會員頭像" style="width:40px;height:40px;"></td>
										</tr>
										<tr>
											<th>編號：</th>
											<td>${memResult[i].memNo}</td>
										</tr>
										<tr>
											<th>姓氏：</th>
											<td>${memResult[i].memFirstName}</td>
										</tr>
										<tr>
											<th>名稱：</th>
											<td>${memResult[i].memLastName}</td>
										</tr>
										<tr>
											<th>暱稱：</th>
											<td>${memResult[i].memNickname}</td>
										</tr>
										<tr>
											<th>身分證號：</th>
											<td>${memResult[i].twId}</td>
										</tr>
										<tr>
											<th>電話：</th>
											<td>${memResult[i].memTel}</td>
										</tr>
										<tr>
											<th>E-mail：</th>
											<td>${memResult[i].memEmail}></td>
										</tr>
										<tr>
											<th>狀態：</th>
											<td>
												<select name="memStatus" id="memStatusSelect">`
												editStr += eachMemStatus;
												editStr +=
												`</select>
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
								</form>`;
						};

						document.getElementsByClassName('edit_wrap')[0].innerHTML = editStr;
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
					}
                }else{
                	alert( xhr.status );
                }
            }
		}

        var url = "searchId.php?memId=" + searchId;
        
        xhr.open("Get", url, true);
		xhr.send( null );
		
		function statusCheck(temp){
			if(temp == "1"){
				return "一般";
			}else{
				return "停權";
			}
		}
	}
	
	document.getElementById("searchInput").addEventListener('change', ajaxSearch);	
	document.getElementById("searchBtn").addEventListener('click', ajaxSearch);
	
</script>
</html>