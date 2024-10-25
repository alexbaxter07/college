<?php

    session_start();

    include "../db_connect.php";

    $fname = $_POST['fname'];
    $sname = $_POST['sname'];
    $email = $_POST['email'];

    $userid = $_SESSION['Userid'];

    try {

        $sql = "UPDATE Users SET Username = ?, Firstname = ?, Lastname = ?, Email = ? WHERE UserID =? ";
        $query1 = $conn->prepare($sql);
    
        $query1->bindParam(1, $_SESSION["Username"]);
        $query1->bindParam(2, $fname);
        $query1->bindParam(3, $sname);
        $query1->bindParam(4, $email);
        $query1->bindParam(5, $userid);
        $query1->execute();

        $act = "upd";
        $logtime = date("Y-m-d");
        $info = "Updated core details";

        $sql = "INSERT INTO Audit (Userid, Action, Informaiton, Date) VALUES(?,?,?,?)";
        $stmt = $conn->prepare($sql);

        $stmt->bindParam(1, $userid);
        $stmt->bindParam(2, $act);
        $stmt->bindParam(3, $info);
        $stmt->bindParam(4, $logtime);

        $stmt->execute();

        header("refresh:1 url=profile.php");
        echo "Successfully Updated";

    } catch (PDOException $e) {
        echo "error: " . $e->getMessage();
    }

    echo "<!DOCTYPE html>";
    echo "<html lang='en'>";

    echo "<head>";

    echo "<meta charset='UTF-8'>";
    echo "<title>Update Details</title>";
    echo "<link href='../styles.css' rel='stylesheet'>";

    echo "</head>";

    echo "</html>"

?>