<?php

    include "db_connect.php";

    $Usern = $_POST['Uname'];
    $pswd = $_POST['Password'];
    $fname = $_POST['Fname'];
    $sname = $_POST['Sname'];
    $email = $_POST['email'];
    $cpaswd = $_POST['CPassword'];

    if($pswd <> $cpaswd ){
        header("refresh:5; url=signup.html");
        echo "The passwords did not match, you will be redirected in 5 seconds.";
    }elseif(preg_match("/[a-z]/", $pswd) == false){
        header("refresh:5; url=signup.html");
        echo "There are no lowercase letters";
    }elseif(preg_match("/[A-Z]/", $pswd) == false){
        header("refresh:5; url=signup.html");
        echo "There are no uppercase letters";
    }elseif(preg_match("/[0-9]/", $pswd) == false) {
        header("refresh:5; url=signup.html");
        echo "There are no numbers";
    }elseif(preg_match("/[^A-Za-z0-9]/", $pswd) == false) {
        header("refresh:5; url=signup.html");
        echo "There are no special characters";
    }elseif(strlen($pswd) < 8){
        header("refresh:5; url=signup.html");
        echo "Password is less than 8 characters";
    }else {


        try {

            $hashed_pswd = password_hash($pswd, PASSWORD_DEFAULT);
            $sql = "INSERT INTO mem(Uname, Pswd, Fname, Sname, Email)VALUES (?,?,?,?,?)";
            $stmt = $conn->prepare($sql);

            $stmt->bindParam(1, $Usern);
            $stmt->bindParam(2, $hashed_pswd);
            $stmt->bindParam(3, $fname);
            $stmt->bindParam(4, $sname);
            $stmt->bindParam(5, $email);

            $stmt->execute();
            header("refresh:5 url=login.html");
            echo "Successfully Registered";
        } catch (PDOException $e) {
            echo "error: " . $e->getMessage();
        }
    }
?>