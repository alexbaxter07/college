<?php

    session_start();
    
    include "db_connect.php";
    
    $opswd = $_POST['opassword'];
    $npswd = $_POST['npassword'];
    $cpswd = $_POST['cpassword'];
    $spswd = $_SESSION['Password'];
    $userid = $_SESSION['UserID'];
    
    if(password_verify($opswd,$spswd )){
        echo "passwords matched";
        
        if($npswd <> $cpswd ){
            header("refresh:5; url=upswd.html");
            echo "The passwords did not match, you will be redirected in 5 seconds.";
        }elseif(preg_match("/[a-z]/", $npswd) == false){
            header("refresh:5; url=upswd.html");
            echo "There are no lowercase letters";
        }elseif(preg_match("/[A-Z]/", $npswd) == false){
            header("refresh:5; url=upswd.html");
            echo "There are no uppercase letters";
        }elseif(preg_match("/[0-9]/", $npswd) == false) {
            header("refresh:5; url=upswd.html");
            echo "There are no numbers";
        }elseif(preg_match("/[^A-Za-z0-9]/", $npswd) == false) {
            header("refresh:5; url=upswd.html");
            echo "There are no special characters";
        }elseif(strlen($npswd) < 8) {
            header("refresh:5; url=upswd.html");
            echo "Password is less than 8 characters";
        }else{
            $hashed_pswd = password_hash($npswd, PASSWORD_DEFAULT);
            $sql = "UPDATE mem SET Password = ? WHERE UserID = ? ";
            $query1 = $conn->prepare($sql);

            $query1->bindParam(1, $hashed_pswd);
            $query1->bindParam(2, $userid);
            $query1->execute();
            echo "password updated";
        }
    }else{
        echo "Old Password does not match";
    }

?>