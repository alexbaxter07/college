<?php

    session_start();
?>

<!DOCTYPE html>

    <head>

        <html lang='en'>

        <meta charset='UTF-8'>
        <title>Activity log</title>
        <link href='../styles.css' rel='stylesheet'>

    </head>

    <body>
        <div id="container">

            <div id="titlebar">
                <h1>To-Do</h1>
            </div>

            <div id = "navbar">

                <ul id="nav">

                    <li><a href="../change%20deatails/changed.html">Update core details</a></li>
                    <li><a href="../change%20deatails/changep.html">Update Password</a></li>
                    <li><a href="../login/logout.html">Logout</a></li>
                    <li><a href="activity_log.php">Activity Log</a></li>

                </ul>

            </div>

        </div>
    </body>

</>

<?php
    include "db_connect.php";

    echo "<body>";

    echo "<div id = container>";

    $actions = array("log", "spc", "apc");
    $uid = $_SESSION['Userid'];

    echo"<table id='active_table'>";

    echo"<th>Activity</th>";
    echo"<th>Number of times</th>";

    foreach($actions as $action){

        //The COUNT() function returns the number of rows that matches a specified criterion. If specific column is needed remove * and replace it with column name

        $sql = "SELECT COUNT(*) AS count from Audit WHERE Userid = ? AND action = ?";

        $stmt = $conn->prepare($sql);
        $stmt -> bindParam(1,$uid);
        $stmt -> bindParam(2,$action);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        // changes action name to be meaningful to user

        $act="";
        if($action =="log"){
            $act="Login";
        }elseif ($action =="spc"){
            $act="Successful Password Change";
        }else{
            $act="Unsuccessful Password Change";
        }

        echo"<tr>";
        echo "<td>".$act."</td>";
        echo "<td>".$result["count"]."</td>";
        echo "</tr>";


    }
    echo"</table>";


    echo "</div>";

?>