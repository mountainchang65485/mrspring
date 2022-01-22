<?php        
 

    try{
        foreach( $_FILES["branchImgUrl"]["error"] as $i => $error){
            switch($_FILES['branchImgUrl']['error'][$i]){
                case 0:
                        $dir = "../images/";
                        if( file_exists($dir) === false){
                            mkdir( $dir ); //make directory
                        }
                        $from = $_FILES['branchImgUrl']['tmp_name'][$i];
                        $to = $dir . $_FILES['branchImgUrl']['name'][$i];
                        copy($from, $to);
                        echo $to;
                        echo "上傳成功<br>";
                        break;	
                case 1:
                        echo "上傳檔案太大, 不得超過", ini_get("upload_max_filesize") ,"<br>";
                        break;
                case 2:
                        echo "上傳檔案太大, 不得超過", $_POST["MAX_FILE_SIZE"], "位元組<br>";
                        break;
                case 3:
                        echo "上傳檔案不完整<br>";
                        break;
                case 4:
                        echo "没選送圖片".($i+1)."<br>";
                        break;
                default:
                        echo "請聯絡網站維護人員<br>";
                        echo "error code : ", $_FILES['branchImgUrl']['error'][$i],"<br>";
            }
        }
    
        require_once("Pancake_connectbooks.php"); 

    $sql = "UPDATE branch set branchName = :branchName, branchTel = :branchTel, branchDescription = :branchDescription, branchPrice = :branchPrice, branchImgUrl1 = :branchImgUrl1, branchImgUrl2 = :branchImgUrl2, branchImgUrl3 = :branchImgUrl3 where branchNo = {$_POST["branchNo"]}";
    
        echo $sql;
        
        $branchStatement = $pdo -> prepare($sql);
        $branchStatement -> bindValue(':branchName', $_POST["branchName"]);
        $branchStatement -> bindValue(':branchTel', $_POST["branchTel"]);
        $branchStatement -> bindValue(':branchDescription', $_POST["branchDescription"]);
        $branchStatement -> bindValue(':branchPrice', $_POST["branchPrice"]);
        $branchStatement -> bindValue(':branchImgUrl1', 'images/'.$_FILES['branchImgUrl']['name'][0]);
        $branchStatement -> bindValue(':branchImgUrl2', 'images/'.$_FILES['branchImgUrl']['name'][1]);
        $branchStatement -> bindValue(':branchImgUrl3', 'images/'.$_FILES['branchImgUrl']['name'][2]);

        $branchStatement -> execute();
        
        header('Location: admin_branch.php');
    
        }catch(PDOException $e){
            echo $e->getMessage();
        }    
?>