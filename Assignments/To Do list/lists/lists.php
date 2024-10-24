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

            $sql = "SELECT Listid, Listname, Date FROM Lists WHERE Userid = ?";
            $stmt = $conn->prepare($sql);
            $stmt ->bindParam(1,$_SESSION['Userid']);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

            if(!$result){

                echo"No lists found";

            }else{

                echo "<h3>Select List  </h3>";

                echo "<table id='edit_list'>";

                foreach($result as $row){

                    echo "<form action='../Tasks/sel_task.php' method='post' name ='form_".$row['Listid']."'>";
                    echo "<input type='hidden' name='Listid' value='".$row['Listid']."'>";
                    echo "<tr>";
                    echo "<td>List Name: ".$row['Listname']."</td>";
                    echo "<td>Date: ".$row['Date']."</td>";
                    echo "<td><input type='submit' name='edit' value='Edit'></td>";
                    echo "<td><input type='submit' name='delete' value='Delete'></td>";
                    echo "</tr>";
                    echo "</form>";
                }

                echo "</table><br>";

            }

            ?>

        </div>

    </body>