<?php

    include "db_connect.php";

    $usern = $_POST['uname'];
    $pswd = $_POST['password'];
    $fname = $_POST['fname'];
    $sname = $_POST['sname'];
    $email = $_POST['email'];
    $cpaswd = $_POST['cpassword'];
    $sdate = date("Y-m-d");

    if($pswd <> $cpaswd ){
        header("refresh:5; url=register.html");
        echo "The passwords did not match, you will be redirected in 5 seconds.";
    }elseif(preg_match("/[a-z]/", $pswd) == false){
        header("refresh:5; url=register.html");
        echo "There are no lowercase letters";
    }elseif(preg_match("/[A-Z]/", $pswd) == false){
        header("refresh:5; url=register.html");
        echo "There are no uppercase letters";
    }elseif(preg_match("/[0-9]/", $pswd) == false) {
        header("refresh:5; url=register.html");
        echo "There are no numbers";
    }elseif(preg_match("/[^A-Za-z0-9]/", $pswd) == false) {
        header("refresh:5; url=register.html");
        echo "There are no special characters";
    }elseif(strlen($pswd) < 8){
        header("refresh:5; url=register.html");
        echo "Password is less than 8 characters";
    }else {

        $sql = "SELECT Username FROM Users WHERE Username = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(1, $usern);
        $stmt->execute();

        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($result) {

            header("refresh:5; url=register.html");
            echo "User Exists, try another name";

        } else {

            try {

                $hashed_pswd = password_hash($pswd, PASSWORD_DEFAULT);
                $sql = "INSERT INTO Users(Username, Password, Firstname, Lastname, Email, Date)VALUES (?,?,?,?,?,?)";
                $stmt = $conn->prepare($sql);

                $stmt->bindParam(1, $usern);
                $stmt->bindParam(2, $hashed_pswd);
                $stmt->bindParam(3, $fname);
                $stmt->bindParam(4, $sname);
                $stmt->bindParam(5, $email);
                $stmt->bindParam(6, $sdate);

                $stmt->execute();
                header("refresh:1 url=login.html");
                echo "Successfully Registered";

            } catch (PDOException $e) {
                echo "error: " . $e->getMessage();
            }

        }

    }

    echo "<!DOCTYPE html>";
    echo "<html lang='en'>";

    echo "<head>";

    echo "<meta charset='UTF-8'>";
    echo "<title>Register</title>";
    echo "<link href='styles.css' rel='stylesheet'>";

    echo "</head>";

    echo "</html>"
?>