<?php

    include 'db_connect.php';

    session_set_cookie_params(3600);
    session_start(); // Start new or resume existing session

    $usern = $_POST['uname'];
    $pswd = $_POST['password'];

    $sql = "SELECT * FROM mem WHERE Username = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(1, $usern);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($result) {

        //$_SESSION — Session variables
        $_SESSION["ssnlogin"] = true;
        $_SESSION["Uname"] = $usern;
        $_SESSION["UserID"] = $result["UserID"];
        $rpswd = $result["Password"];

        if (password_verify($pswd, $rpswd)) {

            $act = "log";
            $logtime = time();

            $sql = "INSERT INTO activity (UserID, Activity, Date) VALUES(?,?,?)";
            $stmt = $conn->prepare($sql);

            $stmt->bindParam(1, $_SESSION["UserID"]);
            $stmt->bindParam(2, $act);
            $stmt->bindParam(3, $logtime);

            $stmt->execute();

            header("refresh:1; url=profile.php");
            echo "you are now logged in! Heading to your profile";
        } else {

            header("refresh:5; url=login.html");
            echo "Password is incorrect";
        }
    }

    echo "<!DOCTYPE html>";
    echo "<html lang='en'>";

    echo "<head>";

    echo "<meta charset='UTF-8'>";
    echo "<title>Verify</title>";
    echo "<link href='styles.css' rel='stylesheet'>";

    echo "</head>";

    echo "</html>"
?>