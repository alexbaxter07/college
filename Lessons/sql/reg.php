<?php

    include "db_connect.php";

    $Usern = $_POST['Uname'];
    $pswd = $_POST['Password'];
    $fname = $_POST['Fname'];
    $sname = $_POST['Sname'];
    $email = $_POST['email'];
    $cpaswd = $_POST['CPassword'];

    $hashed_pswd = password_hash($pswd, PASSWORD_DEFAULT);

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
    }else{
        $sql = "INSERT INTO mem(Username, Password, Fname, Sname, Email)VAlUES(?, ?, ?, ?, ?)";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, 'sssss', $Usern, $hashed_pswd, $fname, $sname, $email);
        mysqli_stmt_execute($stmt);

        if(mysqli_stmt_error($stmt)){
            echo"Error: " . mysqli_stmt_error($stmt);
        }else{
            echo"Records created successfully";
        }
    }

?>