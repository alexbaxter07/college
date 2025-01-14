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

        <form method="get" action="" onchange="this.action = this.pages.value">

            <select name="option" id="options" onchange="this.form.submit()"></select>
                <option value="hours_left.php">Hours left</option>
                <option value="hours_log.php">Log hours</option>
                <option value="completed_hours.php">Completed hours</option>
                <option value="company_contact.php">Company Contact</option>
            <select
            <input type="submit" value="Go">

        </form>

    </div>

</div>

</body>

</html>
