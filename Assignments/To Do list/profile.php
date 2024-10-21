<?php

    session_start(); //session means that variables can be used across pages

?>

<!DOCTYPE html>

    <html lang="en">

    <head>

        <link href="styles.css" rel="stylesheet">

        <?php

        if(!$_SESSION["ssnlogin"]){
            header("refresh:5;url=login.html");
            echo"You are not currently logged in, redirecting to login page";
        }else{
            $usnm = $_SESSION['Username'];
            echo "<title>". $usnm. "'s profile page</title>";
        }

        ?>

    </head>

    <body>

        <div id="container">

            <?php

            echo "<h1>Welcome, ".$usnm."</h4>";

            ?>

            <h3>Here is your information:</h3>

            <?php

            include "db_connect.php";

            $sql = "SELECT Username, Firstname, Lastname, Email FROM Users WHERE Username = ?  ";
            $stmt = $conn->prepare($sql);
            $stmt -> bindParam(1,$usnm);
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);

            foreach($result as $key=>$value){
                echo $key.": ".$value."<br>";
            }

            ?>

            <h3>Would you like to update your information?</h3>

            <ul>

                <li><a href="changed.html">Update core details</li>
                <li><a href="changep.html">Update Password</li>
                <li><a href="logout.html">NO</a></li>

            </ul>

            <h3>Key dates:</h3>

            <?php

            // date they signed up to system

            $sql = "SELECT Date from Users where Username = ? ";

            $stmt = $conn->prepare($sql);
            $stmt -> bindParam(1,$usnm);
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);

            $date = $result['Date'];

            echo "<h4>Date of signup</h4>";

            echo date('g:i A, l - d M Y', strtotime($date));

            //date and time of last login

            $act = 'log';
            $uid = $_SESSION['Userid'];

            $sql = "SELECT Date from Audit WHERE Userid = ? AND Action = ? ORDER BY Date DESC LIMIT 1 OFFSET 1";

            $stmt = $conn->prepare($sql);
            $stmt -> bindParam(1,$uid);
            $stmt -> bindParam(2,$act);
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);

            $time = $result['Date'];

            echo "<h4>Date</h4>";

            echo $time;

            // last activity

            $sql = "SELECT Action from Audit WHERE Userid = ? ORDER BY Date DESC LIMIT 1 OFFSET 1";

            $stmt = $conn->prepare($sql);
            $stmt -> bindParam(1,$uid);
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);

            echo "<h4> Last Activity</h4>";

            // changes action name to be meaningful to user

            $action = $result['Action'];

            $act="";
            if($action =="log"){
                $act="Login";
            }elseif ($action =="spc"){
                $act="Successful Password Change";
            }else{
                $act="Unsuccessful Password Change";
            }

            echo "Your last activity was ".$act;

            //number of times they have done each activity

            echo"<h4>Activity log</h4>";

            $actions = array("log", "spc", "apc");

            foreach($actions as $action){

                //The COUNT() function returns the number of rows that matches a specified criterion. If specific column is needed remove * and replace it with column name

                $sql = "SELECT COUNT(*) As count from Audit WHERE Userid = ? AND action = ?";

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

                echo "The action: ".$act." has been done ".$result['count']." times"."<br>";

            }

            ?>