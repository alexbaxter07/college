<?php

    session_start();

    include "db_connect.php";

    $opswd = $_POST['opassword'];
    $npswd = $_POST['npassword'];
    $cpswd = $_POST['cpassword'];
    $userid = $_SESSION['Userid'];

    $sql = "SELECT Password FROM Users WHERE Userid = ?";

    $stmt = $conn -> prepare($sql);

    $stmt -> bindParam(1, $userid);

    $stmt -> execute();

    $result= $stmt -> fetch(PDO::FETCH_ASSOC);

    if($result) {

        $spswd = $result['Password'];

        if (password_verify($opswd, $spswd)) {

            if ($npswd <> $cpswd) {

                $act = "apc";
                $logtime = date("Y-m-d");
                $info = "Attempted Password Change";

                $sql = "INSERT INTO Audit (Userid, Action, Information, Date) VALUES(?,?,?,?)";
                $stmt = $conn->prepare($sql);

                $stmt->bindParam(1, $_SESSION["Userid"]);
                $stmt->bindParam(2, $act);
                $stmt->bindParam(3, $info);
                $stmt->bindParam(4, $logtime);

                $stmt->execute();

                // remove all session variables
                session_unset();

                // destroy the session
                session_destroy();

                header("refresh:5; url=changep.html");
                echo "The passwords did not match, you will be redirected in 5 seconds.";

            } elseif (preg_match("/[a-z]/", $npswd) == false) {

                $act = "apc";
                $logtime = date("Y-m-d");
                $info = "Attempted Password Change";

                $sql = "INSERT INTO Audit (Userid, Action, Information, Date) VALUES(?,?,?,?)";
                $stmt = $conn->prepare($sql);

                $stmt->bindParam(1, $_SESSION["Userid"]);
                $stmt->bindParam(2, $act);
                $stmt->bindParam(3, $info);
                $stmt->bindParam(4, $logtime);

                $stmt->execute();

                // remove all session variables
                session_unset();

                // destroy the session
                session_destroy();

                header("refresh:1; url=changep.html");
                echo "There are no lowercase letters";

            } elseif (preg_match("/[A-Z]/", $npswd) == false) {

                $act = "apc";
                $logtime = date("Y-m-d");
                $info = "Attempted Password Change";

                $sql = "INSERT INTO Audit (Userid, Action, Information, Date) VALUES(?,?,?,?)";
                $stmt = $conn->prepare($sql);

                $stmt->bindParam(1, $_SESSION["Userid"]);
                $stmt->bindParam(2, $act);
                $stmt->bindParam(3, $info);
                $stmt->bindParam(4, $logtime);

                $stmt->execute();

                // remove all session variables
                session_unset();

                // destroy the session
                session_destroy();

                header("refresh:1; url=changep.html");
                echo "There are no uppercase letters";

            } elseif (preg_match("/[0-9]/", $npswd) == false) {

                $act = "apc";
                $logtime = date("Y-m-d");
                $info = "Attempted Password Change";

                $sql = "INSERT INTO Audit (Userid, Action, Information, Date) VALUES(?,?,?,?)";
                $stmt = $conn->prepare($sql);

                $stmt->bindParam(1, $_SESSION["Userid"]);
                $stmt->bindParam(2, $act);
                $stmt->bindParam(3, $info);
                $stmt->bindParam(4, $logtime);

                $stmt->execute();

                // remove all session variables
                session_unset();

                // destroy the session
                session_destroy();

                header("refresh:1; url=changep.html");
                echo "There are no numbers";

            } elseif (preg_match("/[^A-Za-z0-9]/", $npswd) == false) {

                $act = "apc";
                $logtime = date("Y-m-d");
                $info = "Attempted Password Change";

                $sql = "INSERT INTO Audit (Userid, Action, Information, Date) VALUES(?,?,?,?)";
                $stmt = $conn->prepare($sql);

                $stmt->bindParam(1, $_SESSION["Userid"]);
                $stmt->bindParam(2, $act);
                $stmt->bindParam(3, $info);
                $stmt->bindParam(4, $logtime);

                $stmt->execute();

                // remove all session variables
                session_unset();

                // destroy the session
                session_destroy();

                header("refresh:1; url=changep.html");
                echo "There are no special characters";

            } elseif (strlen($npswd) < 8) {

                $act = "apc";
                $logtime = date("Y-m-d");
                $info = "Attempted Password Change";

                $sql = "INSERT INTO Audit (Userid, Action, Information, Date) VALUES(?,?,?,?)";
                $stmt = $conn->prepare($sql);

                $stmt->bindParam(1, $_SESSION["Userid"]);
                $stmt->bindParam(2, $act);
                $stmt->bindParam(3, $info);
                $stmt->bindParam(4, $logtime);

                $stmt->execute();

                // remove all session variables
                session_unset();

                // destroy the session
                session_destroy();

                header("refresh:1; url=changep.html");
                echo "Password is less than 8 characters";

            } else {

                $hashed_pswd = password_hash($npswd, PASSWORD_DEFAULT);

                $sql = "UPDATE Users SET Password = ? WHERE Userid = ? ";
                $query1 = $conn->prepare($sql);

                $query1->bindParam(1, $hashed_pswd);
                $query1->bindParam(2, $userid);
                $query1->execute();

                $act = "spc";
                $logtime = date("Y-m-d");
                $info = "Successfull Password Change";

                $sql = "INSERT INTO Audit (Userid, Action,Information, Date) VALUES(?,?,?,?)";
                $stmt = $conn->prepare($sql);

                $stmt->bindParam(1, $_SESSION["Userid"]);
                $stmt->bindParam(2, $act);
                $stmt->bindParam(3,$info);
                $stmt->bindParam(4, $logtime);

                $stmt->execute();

                // remove all session variables
                session_unset();

                // destroy the session
                session_destroy();

                header("refresh:1; url=../log.html");
                echo "password updated";

            }

        } else {

            $act = "apc";
            $logtime = date("Y-m-d");
            $info = "Attempted Password Change";

            $sql = "INSERT INTO audit (Userid, Action, Information, Date) VALUES(?,?,?,?)";
            $stmt = $conn->prepare($sql);

            $stmt->bindParam(1, $_SESSION["Userid"]);
            $stmt->bindParam(2, $act);
            $stmt->bindParam(3, $info);
            $stmt->bindParam(4, $logtime);

            $stmt->execute();

            // remove all session variables
            session_unset();

            // destroy the session
            session_destroy();

            header("refresh:5; url=../log.html");
            echo "Old Password does not match! Please log again.";
        }
    }

    echo "<!DOCTYPE html>";
    echo "<html lang='en'>";

    echo "<head>";

    echo "<meta charset='UTF-8'>";
    echo "<title>Password Verify</title>";
    echo "<link href='../styles.css' rel='stylesheet'>";

    echo "</head>";

    echo "</html>"

?>