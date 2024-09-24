<?php

    include "db_connect.php";

    $Usern = $_POST['Uname'];
    $pswd = $_POST['Password'];
    $fname = $_POST['Fname'];
    $sname = $_POST['Sname'];
    $email = $_POST['email'];
    $cpaswd = $_POST['CPassword'];

    if($pswd <> $cpaswd ){
        echo "Passwords do not match";
        header("location: index.html");
        exit();
    }elseif(preg_match("/[a-z]/", $pswd) == false){
        echo "There are no lowercase letters";
        header("location: index.html");
    }elseif(preg_match("/[A-Z]/", $pswd) == false){
        echo "There are no uppercase letters";
        header("location: index.html");
    }elseif(preg_match("/[0-9]/", $pswd) == false) {
        echo "There are no numbers";
        header("location: index.html");
    }elseif(preg_match("/[^A-Za-z0-9]/", $pswd) == false) {
        echo "There are no special characters";
        header("location: index.html");
    }elseif(strlen($pswd) < 8){
        echo "Password is less than 8 characters";
        header("location: index.html");
    }elseif(ctype_upper($fname(0))){
        echo "First name does not have uppercase letter";
        header("location: index.html");
    }elseif(ctype_upper($sname(0))){
        echo "Surname does not have uppercase letter";
        header("location: index.html");
    }else{
        $sql = "INSERT INTO mem(Username, Password, Fname, Sname, Email)VAlUES(?, ?, ?, ?, ?)";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, 'sssss', $Usern, $pswd, $fname, $sname, $email);
        mysqli_stmt_execute($stmt);

        if(mysqli_stmt_error($stmt)){
            echo"Error: " . mysqli_stmt_error($stmt);
        }else{
            echo"Records created successfully";
        }
    }

?>