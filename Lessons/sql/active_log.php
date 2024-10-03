<?php

    session_start();

    include "db_connect.php";

    echo "<body>";

        echo "<div id = container>";

            $actions = array("log", "spc", "apc");
            $uid = $_SESSION['UserID'];

            echo"<table>";

                echo"<th>Activity</th>";
                echo"<th>Number of times</th>";

                foreach($actions as $action){

                    //The COUNT() function returns the number of rows that matches a specified criterion. If specific column is needed remove * and replace it with column name

                    $sql = "SELECT COUNT(*) AS count from activity WHERE UserID = ? AND activity = ?";

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

    echo "</body>";

    echo "<head>";

        echo "<!DOCTYPE html>";
        echo "<html lang='en'>";

        echo "<meta charset='UTF-8'>";
        echo "<title>Activity log</title>";
        echo "<link href='styles.css' rel='stylesheet'>";

        echo "</head>";

    echo "</html>";

?>