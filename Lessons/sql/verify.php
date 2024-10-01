<?php

    include 'db_connect.php';

    session_set_cookie_params(3600);
    session_start(); // Start new or resume existing session

    $Usern = $_POST['Uname'];
    $pswd = $_POST['Password'];

    $sql = "SELECT Password FROM mem WHERE Username = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(1, $Usern);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    $sql = "SELECT uname FROM mem WHERE uname = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(1,$usnm);
    $stmt->execute();

    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($result) {

        //$_SESSION — Session variables
        $_SESSION["ssnlogin"] = true;
        $_SESSION["Uname"] = $Usern;
        $rpswd = $result["Password"];
        if (password_verify($pswd, $rpswd)) {
            header("refresh:5; url=profile.php");
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