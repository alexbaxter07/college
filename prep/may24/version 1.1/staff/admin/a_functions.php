<?php
// page used for differant admin functions to be used within the admin system

function admin_sesh_started($conn){
    if(isset($_SESSION['admin_login'])){
        return true;
    }
}

function reg_admin($conn, $post) {

    // Validate the post data
    if (!isset($post['uname'], $post['password'], $post['fname'], $post['sname'], $post['email'], $post['priviledge'])) {
        throw new Exception("Missing required fields.");
    } else{
        try {
            // Prepare and execute the SQL query
            $sql = "INSERT INTO admin_user (username, password, email, first_name, last_name, signup_date, priviledge) VALUES (?, ?, ?, ?, ?, ?, ?)";  //prepare the sql to be sent
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
}

function super_checker($conn){
    try {
        $sql = "SELECT priviledge FROM admin_user WHERE priviledge = 'SUPER'"; //set up the sql statement
        $stmt = $conn->prepare($sql); //prepares
        $stmt->execute(); //run the sql code
        $result = $stmt->fetch(PDO::FETCH_ASSOC);  //brings back results
        $conn = null;
        if ($result) {
            return true;
        } else {
            return false;
        }
    }
    catch (PDOException $e) { //catch error
        // Log the error (crucial!)
        error_log("Database error in super_checker: " . $e->getMessage());
        // Throw the exception
        throw $e; // Re-throw the exception
    }
}