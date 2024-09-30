<?php

    include 'db_connect.php';

    try {
        session_start();
        $Usern = $_POST['Uname'];
        $pswd = $_POST['Password'];

        $sql = "SELECT Password FROM mem WHERE Username = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(1, $Usern);
        $stmt->execute();

        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        $password = $result["Password"];

        if ($result) {
            $_SESSION["ssnlogin"] = true;
            $_SESSION["Uname"] = $Usern;
            $rpswd = $result["Password"];
            if (password_verify($pswd, $rpswd)) {
                header("refresh:5; url=profile.php");
                echo "you are now logged in! Heading to your profile";
            } else {
                header("refresh:5; url=login.html");
                echo "Passwords do not match. please try again";
            }
        } else{
            echo "User not found";
        }
    }catch(Exception $e){
        echo $e->getMessage();
    }
?>