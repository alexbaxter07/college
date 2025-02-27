<?php
// page to validate adding a hotel room

    session_start();

    if($_SESSION['level'] == 'EDITOR'){

        header("refresh:4; url=admin_login.php");
        echo "<link rel='stylesheet' href='../../../../styles.css'>";
        echo "Not high enough admin rights";
    }else{

        // gets both of the functions files for use
        include("../../a_functions.php");
        include("../../../../db_connect.php");

        try{

            $sql = "INSERT INTO hotel_room (type, occupancy, no_of_rooms, price) VALUES (?, ?, ?, ?)";  //prepare the sql to be sent
            $stmt = $conn->prepare($sql); //prepare to sql

            $stmt->bindParam(1,$_POST['type']);  //bind parameters for security
            $stmt->bindParam(2,$_POST['occ']);
            $stmt->bindParam(3,$_POST['ammount']);
            $stmt->bindParam(4,$_POST['ppn']);

            $stmt->execute();  //run the query to insert

            $admin_reg_task = "Registration of a " . $_POST['type'] . " Hotel Room by ". $_SESSION['username'];
            auditor($_SESSION["username"], "newroom", $admin_reg_task);

            header("refresh:5; url=../a_index.php"); //confirm and redirect
            echo "<link rel='stylesheet' href='../../../../styles.css'>";
            echo "Successfully registered " . $_POST['type'] . " hotel room type";

        }catch (PDOException $e) { //catch error

            header("refresh:4; url=../a_login.php");
            echo "<link rel='stylesheet' href='../../../../styles.css'>";
            echo "Error: " . $e->getMessage();
            echo "Failed to add new hotel room";

        }

    }

?>