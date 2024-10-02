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
        <li><a href="quit.php">NO</li>

    </ul>

    // date they signed up to system

    //date and time of last login

    // last activity 

    //number of times they have done each activity

    </body>

</html>
