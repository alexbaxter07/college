<?php

    session_start(); // Start the session to allow usage of session variables.

    include "db_connect.php"; // Include the database connection file.

    // Check if the delete button was clicked in the form.
    if (isset($_POST['delete'])) {

        // Set the Listid from the POST request into the session variable.
        $_SESSION['Listid'] = $_POST['Listid'];

        // Redirect to the delete list page.
        header("Location: del_list.php");

    } else {

        // Check if the edit button was clicked in the form.
        if (isset($_POST['edit'])){
            // Set the Listid from the POST request into the session variable.
            $_SESSION['Listid'] = $_POST['Listid'];
        }

        // Start of HTML document structure
        echo"<!DOCTYPE html>";
        echo"<html>";

            echo"<head>";

                // Include the CSS stylesheet for styling.
                echo "<link rel='stylesheet' href='styles.css' />";
                echo"<title>Edit Lists</title>";

            echo"</head>";

                echo"<body>";

                    echo "<div id='container'>";

                        // Title section of the page.
                        echo"<div id='titlebar'>";
                        echo"<h1>To-Do</h1>";
                        echo"</div>";

                        // Navigation bar with links to profile and logout.
                        echo"<div id='navbar'>";

                            echo"<ul id='nav'>";

                                echo"<li><a href='profile.php'>Profile</a></li>";
                                echo"<li><a href='logout.php'>Logout</a></li>";

                            echo"</ul>";

                        echo"</div>";

                        echo "<hr>";
                        echo "<br>";

                        // Form to add a new task.
                        echo "<form action='taskadd.php' method='POST'>";
                        echo "<label for='listname'>Add a task: </label>";
                        echo "<input type='text' name='task' placeholder='Task text'>";
                        echo "<input type='date' name='date' value='2024-10-23'>";
                        echo "<input type='time' name='time' value='12:00'>";
                        echo "<input type='submit' name='submit' value='Submit'>";
                        echo "</form>";

                        echo "<hr>";
                        echo "<br>";

                        // SQL query to retrieve tasks from the database based on the Listid.
                        $sql = "SELECT * FROM Tasks WHERE Listid = ?"; // SQL query to get tasks for a specific list.
                        $stmt = $conn->prepare($sql); // Prepare the SQL statement.
                        $stmt->bindParam(1, $_SESSION['Listid']); // Bind Listid from session.
                        $stmt->execute(); // Execute the SQL query.
                        $result = $stmt->fetchAll(PDO::FETCH_ASSOC); // Fetch all results into an associative array.

                        if($result) {
                            // Arrays to store working (uncompleted) and completed tasks.
                            $working = []; // Store uncompleted tasks.
                            $completed = []; // Store completed tasks.

                            // Iterate through the results and sort tasks based on completion status.
                            foreach ($result as $row) {
                                if ($row['complete'] == "n") {
                                    $working[] = $row; // Add to working if not completed.
                                } elseif ($row['complete'] == "y") {
                                    $completed[] = $row; // Add to completed if done.
                                }
                            }

                            // Display quick stats about the number of tasks.
                            echo "<h4>Quick Stats: Total Tasks: ".count($result)." Current Tasks: ".count($working)." Completed Tasks: ".count($completed)." </h4>";

                            echo "<hr>";
                            echo "<br>";

                            // Display the current (uncompleted) tasks.
                            echo "<h4> Current Tasks</h4>";
                            echo "<br>";
                            echo "<table>";

                            // Loop through the working (uncompleted) tasks.
                            foreach ($working as $row) {
                                // Create a form for each task with options to complete or delete the task.
                                echo "<form action='edit_task.php' method='POST' name='form_" . $row['taskid'] . "'>";
                                echo "<input type='hidden' name='tid' value='" . $row['Taskid'] . "'>"; // Hidden input to pass the task ID.
                                echo "<tr>";
                                echo "<td>Task: " . $row['Task'] . "</td>"; // Display the task description.
                                echo "<td>Due Date: " . date("Y-m-d H:i:s", $row['Duedate']) . "</td>"; // Format and display the due date.
                                echo "<td><input type='submit' name='Complete' value='Complete'></td>"; // Button to mark task as complete.
                                echo "<td><input type='submit' name='Delete' value='Delete'></td>"; // Button to delete the task.
                                echo "</tr>";
                                echo "</form>";
                            }
                            echo "</table>";

                            echo "<hr>";
                            echo "<br>";

                            // Display the completed tasks.
                            echo "<h4> Completed Tasks</h4>";
                            echo "<br>";
                            echo "<table>";

                            // Loop through the completed tasks.
                            foreach ($completed as $row) {
                                // Create a form for each task with options to uncomplete or delete the task.
                                echo "<form action='edit_task.php' method='POST' name='form_" . $row['Taskid'] . "'>";
                                echo "<input type='hidden' name='tid' value='" . $row['Taskid'] . "'>"; // Hidden input for task ID.
                                echo "<tr>";
                                echo "<td>Task: " . $row['Task'] . "</td>"; // Display the task description.
                                echo "<td>Due Date: " . date("Y-m-d H:i:s", $row['Duedate']) . "</td>"; // Format and display the due date.
                                echo "<td><input type='submit' name='Uncomplete' value='Uncomplete'></td>"; // Button to mark task as uncomplete.
                                echo "<td><input type='submit' name='Delete' value='Delete'></td>"; // Button to delete the task.
                                echo "</tr>";
                                echo "</form>";
                            }
                            echo "</table>";

                        } else {
                            // Message if no tasks are available to display.
                            echo "There are no tasks to display here right now!";
                        }

                            echo "</table><br>";

                    echo"</div>";

                echo "</body>";

        echo"</html>";
    }

?>
