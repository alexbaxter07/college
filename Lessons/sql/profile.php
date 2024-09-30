<!DOCTYPE html>

<html lang="en">

    <head>

        <?php

            session_start(); //session means that variables can be used across pages

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

    </body>

</html>
