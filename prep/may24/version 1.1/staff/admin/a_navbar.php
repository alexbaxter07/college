<?php

    echo"<ul id='menu'>";

        echo "<a href='a_index.php'<li>Home</li></a>";

        if (empty($_SESSION['admin_login'])){

            echo "<li><a href='a_login.php'>Login</a></li>";

        }elseif ($_SESSION['admin_login']){

            // nav bar dependent on privilege

            // full admin priviledge
            if ($_SESSION['admin_login']=="SUPER"){
                echo"<li><a href='admin_pages/add/add_admin'>Add Admin</a></li>";
            }

            //add only
            if ($_SESSION["level"]=="SUPER"or $_SESSION["level"]=="CREATOR"){

                echo"<a href='admin_pages/add/add_ticket.php'<li>Add Ticket</li></a>";
                echo"<a href='admin_pages/add/add_hotelroom.php'<li>Add Hotel Room</li></a>";
                echo"<a href='admin_pages/add/add_usertype.php'<li>Add UserType</li></a>";

            }

            //update only
            if ($_SESSION["level"]=="SUPER"or $_SESSION["level"]=="CREATOR"or $_SESSION["level"]=="EDITOR"){

                echo"<a href='admin_pages/update/ud_ticket.php'<li>Update Ticket</li></a>";
                echo"<a href='admin_pages/update/ud_hotelroom.php'<li>Update Hotel Room</li></a>";
                echo"<a href='admin_pages/update/up_usertype.php'<li>Update UserType</li></a>";

            }

            //all admins
            echo"<a href='../../logout.php'<li>Logout</li></a>";

        }
    echo"</ul>";