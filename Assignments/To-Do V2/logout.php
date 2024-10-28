<?php

    //session means that variables can be used across page
    session_start();




    // remove all session variables
    session_unset();

    // destroy the session
    session_destroy();


    header("refresh:1; url=index.html"); // redirects user to homepage
    echo "<link rel='stylesheet' href='../styles.css'>"; //link to stylesheet
    echo "<div id='loggy'>";
    echo "You have now been logged out. You will be redirected back to the start page"; //message for user
    echo "<\div>";

?>