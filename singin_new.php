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
                $errMsg = "????????????" . $e -> getMessage() . "<br>" ;
                $errMsg .= "????????????" . $e -> getLine() . "<br>" ;
            }
            break;	
        case 1:
            echo "??????????????????, ????????????", ini_get("upload_max_filesize") ,"<br>";
            break;
        case 2:
            echo "??????????????????, ????????????", $_POST["MAX_FILE_SIZE"], "?????????<br>";
            break;
        case 3:
            echo "?????????????????????<br>";
            break;
        case 4:
            echo "???????????????<br>";
            break;
        default:
            echo "???????????????????????????<br>";
            echo "error code : ", $_FILES['upFile']['error'],"<br>";
    }
?>