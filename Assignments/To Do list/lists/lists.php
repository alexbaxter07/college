<?php

    session_start();

    include "../db_connect.php";

?>

<!DOCTYPE html>

    <html lang="en">

    <head>

        <meta charset="UTF-8">
        <title>Lists</title>
        <link href="../styles.css" rel="stylesheet">

    </head>

    <body>

        <div id="container">

            <div id="titlebar">
                <h1>To-Do</h1>
            </div>

            <div id = "navbar">

                <ul id="nav">

                    <li><a href="../profile/profile.php">Profile</a></li>
                    <li><a href="lists.php">Lists</a></li>
                    <li><a href="edit_lists.html">Edit Lists</a></li>
                    <li><a href="../log/logout.html">Logout</a></li>

                </ul>

            </div>

            <?php

            $sql = "SELECT Listname, Date FROM Lists WHERE Userid = ?";
            $stmt = $conn->prepare($sql);
            $stmt ->bindParam(1,$_SESSION['Userid']);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

            if(!$result){

                echo"No lists found";

            }else{

                foreach($result as $row){
                    echo "List Name: ".$row['Listname']." Date: ".$row['Date']. "<br>";
                }

            }

            ?>

            <ul id="edit_list">

                <h3>Would you like to edit lists?</h3>

                <li><a href="edit_lists.html">Yes</a></li>
                <li><a href="lists.php">No</a></li>

            </ul>

        </div>

    </body>