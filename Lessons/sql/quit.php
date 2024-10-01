<?php

    //session means that variables can be used across pages
    session_start();

    // remove all session variables
    session_unset();

    // destroy the session
    session_destroy();

?>
