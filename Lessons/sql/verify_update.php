<?php

    include "db_connect.php";

    $Usern = $_POST['Uname'];
    $pswd = $_POST['Password'];
    $fname = $_POST['Fname'];
    $sname = $_POST['Sname'];
    $email = $_POST['email'];
    $cpaswd = $_POST['CPassword'];

    if($pswd <> $cpaswd ){
        header("refresh:5; url=signup.html");
        echo "The passwords did not match, you will be redirected in 5 seconds.";
    }elseif(preg_match("/[a-z]/", $pswd) == false){
        header("refresh:5; url=signup.html");
        echo "There are no lowercase letters";
    }elseif(preg_match("/[A-Z]/", $pswd) == false){
        header("refresh:5; url=signup.html");
        echo "There are no uppercase letters";
    }elseif(preg_match("/[0-9]/", $pswd) == false) {
        header("refresh:5; url=signup.html");
        echo "There are no numbers";
    }elseif(preg_match("/[^A-Za-z0-9]/", $pswd) == false) {
        header("refresh:5; url=signup.html");
        echo "There are no special characters";
    }elseif(strlen($pswd) < 8){
        header("refresh:5; url=signup.html");
        echo "Password is less than 8 characters";
    }else {


        try {

            $hashed_pswd = password_hash($pswd, PASSWORD_DEFAULT);
            $query = $con->prepare("SELECT * FROM mem WHERE username =?");
            $query->bind_param('s', $Usern);
            $query->execute();
            $query->bind_result();
            $query->fetch();
            $query->close();

            $query1 = $con->prepare("UPDATE memb SET VALUES(?,?,?,?,?) WHERE username =? ");

            $query1->bindParam(1, $Usern);
            $query1->bindParam(2, $hashed_pswd);
            $query1->bindParam(3, $fname);
            $query1->bindParam(4, $sname);
            $query1->bindParam(5, $email);
            
            $query1->execute();
            $query1->close();

            header("refresh:5 url=login.html");
            echo "Successfully Registered";
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