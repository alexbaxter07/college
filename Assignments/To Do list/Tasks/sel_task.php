<?php

    session_start();

     include "../db_connect.php";

?>


    <html lang="en">

    <head>

        <meta charset="UTF-8">
        <title>Tasks</title>
        <link href="../styles.css" rel="stylesheet">

    </head>

    <body>

    <div id="container">

        <div id="titlebar">
            <h1>To-Do</h1>
        </div>

        <div id = "navbar">

            <ul id="nav">

                <li><a href="../profile/profile.php">Profile</a></li>
                <li><a href="../lists/lists.php">Lists</a></li>
                <li><a href="../lists/edit_lists.html">Edit Lists</a></li>
                <li><a href="../log/logout.html">Logout</a></li>

            </ul>

            <h3>Select List to see task</h3>

        </div>

    <?php

        $lid = $_POST['lid'];
        $uid = $_SESSION['userid'];

        $sql = "SELECT Listname, Date FROM Lists WHERE Userid = ? AND Listid = ?";
        $stmt = $conn->prepare($sql);
        $stmt ->bindParam(1,$uid);
        $stmt ->bindParam(2,$lid);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        foreach($result as $row){
            echo "List Name: ".$row['Listname']." Date: ".$row['Date']. "<br>";
        }

    ?>
