<?php

    //session means that variables can be used across pages
    session_start();

    // remove all session variables
    session_unset();

    // destroy the session
    session_destroy();

    header("refresh:5; url=index.html");
    echo "You have now been logged out. You will be redirected back to the start page";

?>