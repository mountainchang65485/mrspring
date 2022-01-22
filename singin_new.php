<?php
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
            
                
                $memId = $_POST['memId_s'];
                $memPsw = $_POST['memPsw_s'];
                $memLastName = $_POST['memLastName'];
                $memFirstName = $_POST['memFirstName'];
                $memNickname = $_POST['memNickname'];
                $twId = $_POST['twId'];
                $memTel = $_POST['memTel'];
                $memEmail = $_POST['memEmail'];
                $memImgUrl = $dir.$_FILES['memUpFile']['name'];
                
            
                $sql="INSERT INTO member (memId,memPsw,memLastName,memFirstName,memNickname,twId,memTel,memEmail,memImgUrl)
                        VALUES(:memId_s,:memPsw_s,:memLastName,:memFirstName,:memNickname,:twId,:memTel,:memEmail,:memUpFile)";
                $statement = $pdo -> prepare($sql);
                $statement -> bindValue(':memId_s',$memId);
                $statement -> bindValue(':memPsw_s',$memPsw);
                $statement -> bindValue(':memLastName',$memLastName);
                $statement -> bindValue(':memFirstName',$memFirstName);
                $statement -> bindValue(':memNickname',$memNickname);
                $statement -> bindValue(':twId',$twId);
                $statement -> bindValue(':memTel',$memTel);
                $statement -> bindValue(':memEmail',$memEmail);
                $statement -> bindValue(':memUpFile',$memImgUrl);
                
                $statement -> execute();

                header('Location: member.php');
            
            } catch (PDOException $e){
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
            echo "没選送檔案<br>";
            break;
        default:
            echo "請聯絡網站維護人員<br>";
            echo "error code : ", $_FILES['upFile']['error'],"<br>";
    }
?>