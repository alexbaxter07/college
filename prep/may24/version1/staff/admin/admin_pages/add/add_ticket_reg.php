<?php
// page to validate adding a ticket

    session_start();

    if($_SESSION['level'] != 'SUPER'){

        header("refresh:4; url=admin_login.php");
        echo "<link rel='stylesheet' href='../../../../styles.css'>";
        echo "Not high enough admin rights";
    }else{

        // gets both of the functions files for use
        include("../../a_functions.php");
        include("../../../../functions.php");
        include("../../../../db_connect.php");

        try{//try this code

            $sql = "INSERT INTO tickets (type, price, no_of_tickets) VALUES (?, ?, ?)";  //prepare the sql to be sent
            $stmt = $conn->prepare($sql); //prepare to sql

            $stmt->bindParam(1,$_POST['type']);  //bind parameters for security
            $stmt->bindParam(2,$_POST['ppt']);
            $stmt->bindParam(3,$_POST['ammount']);

            $stmt->execute();  //run the query to insert

            $admin_reg_task = "Registration of a " . $_POST['type'] . " ticket type by ". $_SESSION['username'];
            auditor($_SESSION["username"], "newticket", $admin_reg_task);

            header("refresh:5; url=../a_index.php"); //confirm and redirect
            echo "<link rel='stylesheet' href='../../../../styles.css'>";
            echo "Successfully registered " . $_POST['type'] . " ticket type";

        }catch (PDOException $e) { //catch error

            header("refresh:4; url=../a_login.php");
            echo "<link rel='stylesheet' href='../../../../styles.css'>";
            echo "Error: " . $e->getMessage();
            echo "Failed to add new hotel room";

        }

    }

?>
    }