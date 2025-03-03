<?php
// page used for differant admin functions to be used within the admin system

    function super_checker(){
        include("../../db_connect.php");

        $sql = "select * from admin_user";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        if($result){
            return true;
        }else{
            return false;
        }

    }

    function admin_sesh_started(){
        if(isset($_SESSION['admin_login'])){
            return true;
        }
    }

    function reg_admin($conn, $post) {

        // Validate the post data
        if (!isset($post['username'], $post['password'], $post['fname'], $post['sname'], $post['email'], $post['priviledge'])) {
            throw new Exception("Missing required fields.");
        } elseif(valid_email($post['email'])){
            try {
                // Prepare and execute the SQL query
                $sql = "INSERT INTO admin_users (username, password, email, f_name, s_name, signup_date, priv) VALUES (?, ?, ?, ?, ?, ?, ?)";  //prepare the sql to be sent
                $stmt = $conn->prepare($sql); //prepare to sql

                $stmt->bindParam(1, $post['username']);  //bind parameters for security
                // Hash the password
                $hpswd = password_hash($post['password'], PASSWORD_DEFAULT);  //has the password
                $stmt->bindParam(2, $hpswd);
                $stmt->bindParam(3, $post['email']);
                $stmt->bindParam(4, $post['fname']);
                $stmt->bindParam(5, $post['sname']);
                $signup_date = time();
                $stmt->bindParam(6, $signup_date);
                $stmt->bindParam(7, $post['priv']);

                $stmt->execute();  //run the query to insert
                $conn = null;  // closes the connection so cant be abused.
                return true; // Registration successful
            }  catch (PDOException $e) {
                // Handle database errors
                error_log("Database error: " . $e->getMessage()); // Log the error
                throw new Exception("Database error". $e); //Throw exception for calling script to handle.
            } catch (Exception $e) {
                // Handle validation or other errors
                error_log("Registration error: " . $e->getMessage()); //Log the error
                throw new Exception("Registration error: " . $e->getMessage()); //Throw exception for calling script to handle.
            }
        }
        else {
            error_log("Registration email wrong format"); //Log the error
            throw new Exception("Registration email wrong format"); //Throw exception for calling script to handle.
        }
    }


?>