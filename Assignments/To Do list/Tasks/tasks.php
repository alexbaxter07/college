<?php

    session_start();

    include "../db_connect.php"

?>

<html lang="en">

    <head>

        <meta charset="UTF-8">
        <title>Tasks</title>
        <link href="../styles.css" rel="stylesheet">

    </head>

    <body>

    <div id = "container">

        <div id="titlebar">

            <h1>To-Do</h1>

        </div>

        <div id="navbar">

            <ul id="nav">

                <li><a href="../profile/profile.php">Profile</a></li>
                <li><a href="add_list.html">Add list</a></li>
                <li><a href="del_list.html">Delete list</a></li>
                <li><a href="../log/logout.html">Logout</a></li>

            </ul>

        </div>

        <div id="content">

            <h2>List Name</h2>

            <form action="add_task.php" method="post">

                <table id = "addt">

                    <tr>
                        <td><label for="tname" >Task Name: </label></td>
                        <td><input type="text" id="tname" name="tname" placeholder="Enter a Task name" required></td>
                    </tr>

                    <tr>
                        <td><label for="duedate" >Task Name: </label></td>
                        <td><input type="date" id="duedate" name="duedate" required></td>
                    </tr>

                    <tr><td><input type="submit" value="add"></td></tr>

                </table>

            </form>

        </div>

    </body>

</html>

<?php

    $lid = $_SESSION['listid'];
    $ddate = $_POST['duedate'];
    $date = date("Y-m-d H:i:s");



    $sql = "Select Task, Date, Duedate, Completed from Tasks WHERE Listid = ?";
    $stmt = $conn->prepare($sql);
    $stmt -> bindParam(1, $lid);
    $stmt->execute();
    $result = $stmt->fetchAll();

    if(!$result){

                echo"No lists found";

            }else{

                foreach($result as $row){
                    echo "Task Name: ".$row['Task']." Due Date: ".$row['Duedate']. ".<br>";
                }

            }

?>