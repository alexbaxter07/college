<?php

    function admin_sesh_started(){
        if(isset($_SESSION['admin_login'])){
            return true;
        }
    }

?>