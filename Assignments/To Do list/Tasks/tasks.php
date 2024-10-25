<?php

    session_start();

    include "../db_connect.php"

?>

<html lang="en">

    <head>

        <meta charset="UTF-8">
        <title>Tasks</title>
        <link href="../styles.css" rel="stylesheet">

    </head>

    <body>

    <div id = "container">

        <div id="titlebar">

            <h1>To-Do</h1>

        </div>

        <div id="navbar">

            <ul id="nav">

                <li><a href="../profile/profile.php">Profile</a></li>
                <li><a href="../lists/add_list.html">Add list</a></li>
                <li><a href="../lists/del_list.html">Delete list</a></li>
                <li><a href="../log/logout.html">Logout</a></li>

            </ul>

        </div>

        <div id="content">

            <h2>Lists</h2>

            <?php


                $ddate = $_POST['Duedate'];
                $date = date("Y-m-d H:i:s");

                $sql = "Select Listid from Lists WHERE Userid = ?";
                $stmt = $conn -> prepare($sql);
                $stmt ->bindParam(1,$_SESSION['Userid']);
                $stmt ->execute();
                $lid = $stmt->fetchAll();

                $sql = "Select Task, Date, Duedate, Completed from Tasks WHERE Listid = ?";
                $stmt = $conn->prepare($sql);
                $stmt -> bindParam(1, $lid);
                $stmt->execute();
                $result = $stmt->fetchAll();

                if(!$result){

                        echo"No lists found";

                    }else{
                            echo "<h3>Select List </h3>";

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

</html>
