<?php

    session_start();

    include "db_connect.php";

    $pswd = $_POST['password'];
    $fname = $_POST['fname'];
    $sname = $_POST['sname'];
    $email = $_POST['email'];
    $cpaswd = $_POST['cpassword'];

    $userid = $_SESSION['UserID'];

    try {

        $hashed_pswd = password_hash($pswd, PASSWORD_DEFAULT);
        $sql = "UPDATE mem SET Username = ?, Fname = ?, Sname = ?, Email = ? WHERE UserID =? ";
        $query1 = $conn->prepare($sql);

        $query1->bindParam(1, $_SESSION["Uname"]);
        $query1->bindParam(2, $fname);
        $query1->bindParam(3, $sname);
        $query1->bindParam(4, $email);
        $query1->bindParam(5, $userid);
        $query1->execute();

        $act = "upd";
        $logtime = time();

        $sql = "INSERT INTO activity (UserID, Activity, Date) VALUES(?,?,?)";
        $stmt = $conn->prepare($sql);

        $stmt->bindParam(1, $userid);
        $stmt->bindParam(2, $act);
        $stmt->bindParam(3, $logtime);

        $stmt->execute();

        header("refresh:5 url=profile.php");
        echo "Successfully Updated";

    } catch (PDOException $e) {
        echo "error: " . $e->getMessage();
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