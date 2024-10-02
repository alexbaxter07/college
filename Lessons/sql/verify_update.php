<?php

    session_start();

    include "db_connect.php";


    $pswd = $_POST['password'];
    $fname = $_POST['fname'];
    $sname = $_POST['sname'];
    $email = $_POST['email'];
    $cpaswd = $_POST['cpassword'];
    
    $userid = $_SESSION['UserId'];

    if($pswd <> $cpaswd ){
        header("refresh:5; url=Update.html");
        echo "The passwords did not match, you will be redirected in 5 seconds.";
    }elseif(preg_match("/[a-z]/", $pswd) == false){
        header("refresh:5; url=Update.html");
        echo "There are no lowercase letters";
    }elseif(preg_match("/[A-Z]/", $pswd) == false){
        header("refresh:5; url=Update.html");
        echo "There are no uppercase letters";
    }elseif(preg_match("/[0-9]/", $pswd) == false) {
        header("refresh:5; url=Update.html");
        echo "There are no numbers";
    }elseif(preg_match("/[^A-Za-z0-9]/", $pswd) == false) {
        header("refresh:5; url=Update.html");
        echo "There are no special characters";
    }elseif(strlen($pswd) < 8){
        header("refresh:5; url=Update.html");
        echo "Password is less than 8 characters";
    }else {

        try {

            $hashed_pswd = password_hash($pswd, PASSWORD_DEFAULT);

            $query1 = $conn->prepare("UPDATE mem SET Username = ?, Password =?, Fname = ?, Sname = ?, Email = ? WHERE username =? ");

            $query1->bindParam(1, $_SESSION["Uname"]);
            $query1->bindParam(2, $hashed_pswd);
            $query1->bindParam(3, $fname);
            $query1->bindParam(4, $sname);
            $query1->bindParam(5, $email);
            $query1->bindParam(6, $_SESSION["Uname"]);
            $query1->execute();

            $act = "upd";
            $logtime = time();

            $sql = "INSERT INTO activity (UserId, Activity, Date) VALUES(?,?,?)";
            $stmt = $conn->prepare($sql);

            $stmt->bindParam(1, $userid);
            $stmt->bindParam(2, $act);
            $stmt->bindParam(3, $logtime);

            $stmt->execute();

            header("refresh:5 url=profile.html");
            echo "Successfully Updated";

        } catch (PDOException $e) {
            echo "error: " . $e->getMessage();
        }

    }

    echo "<!DOCTYPE html>";
    echo "<html lang='en'>";

    echo "<head>";

    echo "<meta charset='UTF-8'>";
    echo "<title>Update</title>";
    echo "<link href='styles.css' rel='stylesheet'>";

    echo "</head>";

    echo "</html>"

?>