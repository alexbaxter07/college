<?php

    //session means that variables can be used across page
    session_start();

    echo "<link rel='stylesheet' href='styles.css'>";


    // remove all session variables
    session_unset();

    // destroy the session
    session_destroy();

    echo "You have now been logged out. You will be redirected back to the start page";
    header("refresh:1; url=index.html");


?>