<?php

    session_start();

    include "../db_connect.php";

    $uid = $_SESSION['Userid'];
    $lname = $_POST['lname'];
    $date = date("Y-m-d");

    try {

        $sql = "INSERT INTO Lists(Listname, Userid, Date)VALUES (?,?,?)";
        $stmt = $conn->prepare($sql);

        $stmt->bindParam(1, $lname);
        $stmt->bindParam(2, $uid);
        $stmt->bindParam(3, $date);

        $stmt->execute();
        header("refresh:1 url=add_list.html");
        echo "Successfully Added";

    } catch (PDOException $e) {
        echo "error: " . $e->getMessage();
    }

    echo "<!DOCTYPE html>";
    echo "<html lang='en'>";

    echo "<head>";

    echo "<meta charset='UTF-8'>";
    echo "<title>Add List</title>";
    echo "<link href='../styles.css' rel='stylesheet'>";

    echo "</head>";

    echo "</html>"

?>