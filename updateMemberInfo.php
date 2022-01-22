<?php

session_start();
$errMsg="";

   if(isset($_POST['updated_it'])){

    $memNo = $_SESSION["memNo"]; //那個會員的編號 $_SESSION[""];

    $memFirstName = $_POST["mem_memFirstName"];
    $memLastName = $_POST["mem_memLastName"];
    $memNickname = $_POST["mem_memNickname"];
    $memId = $_POST["mem_memId"];
    $memPsw = $_POST["mem_memPsw"];
    $memTel = $_POST["mem_memTel"];
    $memEmail = $_POST["mem_memEmail"];
    $memImgUrl = $_FILES['memUpFile']['name'];

        switch($_FILES['memUpFile']['error']){
            case 0:
                $dir = "images/mem_photo/";
                if( file_exists($dir) === false){
                    mkdir( $dir ); //make directory
                }
                echo $_FILES['memUpFile']['name'];
                $from = $_FILES['memUpFile']['tmp_name'];
                $to = $dir . $_FILES['memUpFile']['name'];
                copy($from, $to);
                try{
                    require_once("php/connectBooks.php");
                    $sql = "UPDATE `member` SET  memFirstName=:memFirstName,memLastName=:memLastName,";
                    $sql .= "memNickname=:memNickname,memId=:memId,";
                    $sql .= "memPsw=:memPsw,memTel=:memTel,memEmail=:memEmail, memImgUrl=:memImgUrl WHERE memNo=:memNo";
                    
                    $statement =  $pdo-> prepare($sql);
                    $statement -> bindValue(':memFirstName', $memFirstName);
                    $statement -> bindValue(':memLastName', $memLastName);
                    $statement -> bindValue(':memNickname', $memNickname);
                    $statement -> bindValue(':memId', $memId);
                    $statement -> bindValue(':memPsw', $memPsw);
                    $statement -> bindValue(':memTel', $memTel);
                    $statement -> bindValue(':memEmail', $memEmail);
                    $statement -> bindValue(':memImgUrl', $dir.$memImgUrl);
                    $statement -> bindValue(':memNo', $memNo);

                    $updateRow = $statement->execute();
                    header("Location: member.php");
            
                    
                    
                }catch(PDOException $e){
                        $errMsg = "錯誤原因" . $e -> getMessage() . "<br>" ;
                        $errMsg .= "錯誤行號" . $e -> getLine() . "<br>" ;
            
                }
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
            try{
                require_once("php/connectBooks.php");
                $sql = "UPDATE `member` SET memFirstName=:memFirstName,memLastName=:memLastName,";
                $sql .= "memNickname=:memNickname,memId=:memId,";
                $sql .= "memPsw=:memPsw,memTel=:memTel,memEmail=:memEmail WHERE memNo=:memNo";
                
                $statement =  $pdo-> prepare($sql);
                $statement -> bindValue(':memFirstName', $memFirstName);
                $statement -> bindValue(':memLastName', $memLastName);
                $statement -> bindValue(':memNickname', $memNickname);
                $statement -> bindValue(':memId', $memId);
                $statement -> bindValue(':memPsw', $memPsw);
                $statement -> bindValue(':memTel', $memTel);
                $statement -> bindValue(':memEmail', $memEmail);
                $statement -> bindValue(':memNo', $memNo);
                $updateRow = $statement->execute();
                header("Location: member.php");
        
                
                
            }catch(PDOException $e){
                    $errMsg = "錯誤原因" . $e -> getMessage() . "<br>" ;
                    $errMsg .= "錯誤行號" . $e -> getLine() . "<br>" ;
        
            }
            break;
            default:
                echo "請聯絡網站維護人員<br>";
                echo "error code : ", $_FILES['upFile']['error'],"<br>";
        }

    
    echo $errMsg;
   }



?>