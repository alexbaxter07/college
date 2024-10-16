<?php

    //session means that variables can be used across page
    session_start();




    // remove all session variables
    session_unset();

    // destroy the session
    session_destroy();


    header("refresh:1; url=index.html");
    echo "<link rel='stylesheet' href='styles.css'>";
    echo "<div id='loggy'>";
    echo "You have now been logged out. You will be redirected back to the start page";
    echo "<\div>";

?>