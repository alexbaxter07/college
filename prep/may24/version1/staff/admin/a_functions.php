<?php
// page used for differant admin functions to be used within the admin system

    function super_checker(){
        include("../../dbconnect.php");

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

?>