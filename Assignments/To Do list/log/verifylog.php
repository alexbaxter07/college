<?php

    include '../db_connect.php';

    session_set_cookie_params(3600);
    session_start(); // Start new or resume existing session

    $usern = $_POST['usname'];
    $pswd = $_POST['pasword'];

    $sql = "SELECT * FROM Users WHERE Username = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(1, $usern);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($result) {

        //$_SESSION — Session variables
        $_SESSION["ssnlogin"] = true;
        $_SESSION["Username"] = $usern;
        $_SESSION["Userid"] = $result["Userid"];
        $rpswd = $result["Password"];
        $_SESSION['Listid'] = -1;

        if (password_verify($pswd, $rpswd)) {

            $act = "log";
            $logtime = date("Y-m-d H:i:s");
            $info = "logged into account";

            $sql = "INSERT INTO Audit (Userid, Action, Information, Date) VALUES(?,?,?,?)";
            $stmt = $conn->prepare($sql);

            $stmt->bindParam(1, $_SESSION["Userid"]);
            $stmt->bindParam(2, $act);
            $stmt->bindParam(3, $info);
            $stmt->bindParam(4, $logtime);

            $stmt->execute();

            header("refresh:1; url=../profile/profile.php");
            echo "you are now logged in! Heading to your profile";
        } else {

            header("refresh:1; url=../log.html");
            echo "Password is incorrect";
        }
    }

    echo "<!DOCTYPE html>";
    echo "<html lang='en'>";

    echo "<head>";

    echo "<meta charset='UTF-8'>";
    echo "<title>Verify Login</title>";
    echo "<link href='../styles.css' rel='stylesheet'>";

    echo "</head>";

    echo "</html>"

?>