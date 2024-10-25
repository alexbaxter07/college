<?php

    session_start();

    include "db_connect.php";

    if (!isset($_POST['delete'])) {

        $_SESSION['Listid'] = $_POST['lid'];

        header("Location: del_list.php");

    }else{

        if (isset($_POST['edit'])){
            $_SESSION['lid'] = $_POST['lid'];
        }

        echo"<!DOCTYPE html>";

        echo"<html>";

            echo"<head>";

                echo "<link rel='stylesheet' href='/StyleSheet/StyleSheet.css' />";
                echo"<title>Edit Lists</title>";

            echo"</head>";

            echo"<body>";

                echo "<div id='container'>";

                    echo"<div id='titlebar'>";

                        echo"<h1>To-Do</h1>";

                    echo"</div>";

                    echo"<div id='navbar'>";

                        echo"<ul>";

                        echo"<li><a href='profile.php'>Profile</a></li>";
                        echo"<li><a href='logout.php'>Logout</a></li>";

                        echo"</ul>";

                    echo"</div>";

                    echo "<hr>";
                    echo "<br>";
                    echo "<form action='taskadd.php' method='POST'>";
                    echo "<label for='listname'>Add a task: </label>";
                    echo "<input type='text' name='task' placeholder='Task text'>";
                    echo "<input type='date' name='date' value='2024-10-23'>";
                    echo "<input type='time' name='time' value='12:00'>";
                    echo "<input type='submit' name='submit' value='Submit'>";
                    echo "</form>";
                    echo "<hr>";
                    echo "<br>";

                    $sql = "SELECT * FROM tasks WHERE listid = ?"; //set up the sql statement
                    $stmt = $conn->prepare($sql); //prepares
                    $stmt->bindParam(1,$_SESSION['lid']);  //binds the parameters to execute
                    $stmt->execute(); //run the sql code
                    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);  //brings back results

                    if($result){
                        $working =[]; // store uncompleted tasks
                        $completed = []; // store completed tasks

                        //iterate the results to split on the page
                        foreach ($result as $row) {
                            if ($row['complete'] == "n") {
                                $working[] = $row;
                            } elseif ($row['complete'] == "y") {
                                $completed[] = $row;
                            }
                        }
                        echo "<h4>Quick Stats: Total Tasks: ".count($result)." Current Tasks: ".count($working)." Completed Tasks: ".count($completed)." </h4>";

                        echo "<hr>";
                        echo "<br>";
                        echo "<h4> Current Tasks</h4>";
                        echo "<br>";

                        echo "<table>";
                        foreach ($working as $row) {

                            echo "<form action='edit_task.php' method='POST' name='form_" . $row['taskid'] . "'>";
                            echo "<input type='hidden' name='tid' value='" . $row['taskid'] . "'>";
                            echo "<tr>";
                            echo "<td>Task: " . $row['Task'] . "</td>";
                            echo "<td>Due Date: " . date("Y-m-d H:i:s", $row['Duedate']) . "</td>";
                            echo "<td><input type='submit' name='Complete' value='Complete'></td>";
                            echo "<td><input type='submit' name='Delete' value='Delete'></td>";
                            echo "</tr>";

                            echo "</form>";
                        }
                        echo "</table>";

                        echo "<hr>";
                        echo "<br>";
                        echo "<h4> Completed Tasks</h4>";
                        echo "<br>";

                        echo "<table>";
                        foreach ($completed as $row) {

                            echo "<form action='edit_task.php' method='POST' name='form_" . $row['Taskid'] . "'>";
                            echo "<input type='hidden' name='tid' value='" . $row['Taskid'] . "'>";
                            echo "<tr>";
                            echo "<td>Task: " . $row['task'] . "</td>";
                            echo "<td>Due Date: " . date("Y-m-d H:i:s", $row['Duedate']) . "</td>";
                            echo "<td><input type='submit' name='Uncomplete' value='Uncomplete'></td>";
                            echo "<td><input type='submit' name='Delete' value='Delete'></td>";
                            echo "</tr>";

                            echo "</form>";
                        }
                        echo "</table>";

                    } else {
                        echo "There are no tasks to display here right now!";
                    }

                    echo "</table><br>";

                echo"</div>";

            echo "</body>";

        echo"</html>";
    }

?>