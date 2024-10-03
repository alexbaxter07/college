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
                $usnm = $_SESSION['Uname'];
                echo "<title>". $usnm. "'s profile page</title>";
            }

        ?>

    </head>

    <body>

        <?php

            echo "Welcome, ".$usnm;

        ?>

        <h3>Here is your information:</h3>

        <?php

            include "db_connect.php";

            $sql = "SELECT Username, Fname, Sname, Email FROM mem WHERE Username = ?  ";
            $stmt = $conn->prepare($sql);
            $stmt -> bindParam(1,$usnm);
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);

            foreach($result as $key=>$value){
                echo $key.": ".$value."<br>";
            }

        ?>

        <p>Would you like to update your information?</p>

        <ul>

            <li><a href="Update.html">Update core details</li>
            <li><a href="upswd.html">Update Password</li>
            <li><a href="quit.php">NO</a></li>

        </ul>

        <h3>Key dates:</h3>

        <?php

            // date they signed up to system

            $sql = "SELECT Signup from mem where Username = ? ";

            $stmt = $conn->prepare($sql);
            $stmt -> bindParam(1,$usnm);
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);

            $date = $result['Signup'];

            echo "<p>Date of signup</p>";

            echo date('g:i A, l - d M Y', strtotime($date));

            //date and time of last login

            $act = 'log';
            $uid = $_SESSION['UserID'];

            $sql = "SELECT Date from activity WHERE UserID = ? AND Activity = ? ORDER BY Date DESC LIMIT 1 OFFSET 1";

            $stmt = $conn->prepare($sql);
            $stmt -> bindParam(1,$uid);
            $stmt -> bindParam(2,$act);
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);

            $time = $result['Date'];

            echo "<p>Time</p>";

            echo date('g:i A, l- d m y', $time);

            // last activity

            $sql = "SELECT Activity from activity WHERE UserID = ? ORDER BY Date DESC LIMIT 1 OFFSET 1";

            $stmt = $conn->prepare($sql);
            $stmt -> bindParam(1,$uid);
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);

            echo "<p> Last Activity</p>";

            echo $result['Activity'];

            //number of times they have done each activity

            echo"<p>Activity log</p>";

            $actions = array("log", "spc", "apc");

            foreach($actions as $action){

                $sql = "SELECT COUNT(*) As count from activity WHERE UserID = ? AND activity = ?";

                $stmt = $conn->prepare($sql);
                $stmt -> bindParam(1,$uid);
                $stmt -> bindParam(2,$action);
                $stmt->execute();
                $result = $stmt->fetch(PDO::FETCH_ASSOC);
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

    </body>

</html>
