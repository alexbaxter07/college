<?php
// page for functions that will be used across the entire system

    //sub routine to check passwords
    function password_check($password, $cpassword){

        if($password != $cpassword){

            return false;

        }elseif (strlen($password)<8){

            return false;

        }else{

            return true;
        }
    }

    function auditor($conn, $who, $taskcode, $task){

        try{

            $sql = "insert into audit(username, taskcode, task, date) VALUES (?,?,?,?)";
            $stmt = $conn->prepare($sql);

            $stmt->bind_param(1, $who);
            $stmt->bind_param(2, $taskcode);
            $stmt->bind_param(3, $task);
            $date= time();
            $stmt->bind_param(4, $date);

            $stmt->execute();

        }catch(PDOException $e){
            echo "Auditor error: ". $e->getMessage();
        }
    }
