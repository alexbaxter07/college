<?php
?>

<!DOCTYPE html>
<html lang="en">

    <head>

        <meta charset="UTF-8">
        <title>Student Homepage</title>
        <link href="../styles.css" rel="stylesheet">

    </head>

    <body>

        <div id="container">

            <div id="titlebar">
                <h1>Hours Tracker</h1>
            </div>

            <div id="navbar">

                <ul id="nav">
                    <li><a href="hours_left.php">Hours Left</a></li>
                    <li><a href="completed_hours.php">Completed hours</a></li>
                    <li><a href="company_contact.php">company contact</a></li>
                </ul>

            </div>

            <div id="content">

                <h3>Homepage</h3>

                <form method="get" id="pageSelector">

                    <label for="options">Navigate to:</label>

                    <select name="option" id="options" onchange="window.location.href=this.value;">

                        <option value="">Select a Page</option>
                        <option value="hours_left.php">Hours Left</option>
                        <option value="hours_log.php">Log Hours</option>
                        <option value="completed_hours.php">Completed Hours</option>
                        <option value="company_contact.php">Company Contact</option>

                    </select>

                </form>

            </div>

        </div>

    </body>

</html>
