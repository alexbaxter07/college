<!DOCTYPE html>

<html lang="en">

    <head>
        <title>Index</title>
        <link rel="stylesheet" href="styles.css">
    </head>

    <body>

        <h1>Basic Calculator</h1>

        <form method="post" action="">

            <input type="text" name="num1" placeholder="Enter first number" required>
            <input type="text" name="num2" placeholder="Enter second number" required>
            <select name="operator" id="operator">
                <option value="+">+</option>
                <option value="-">-</option>
                <option value="/">/</option>
                <option value="*">*</option>
            </select>
            <input type="submit" value="Calculate">

        </form>

        <?php

            if($_SERVER["REQUEST_METHOD"] == "POST") {

                $num1 = $_POST['num1'];
                $num2 = $_POST['num2'];
                $operator = $_POST['operator'];

                if (is_numeric($_POST["num1"]) && is_numeric($_POST["num2"])) {

                    if ($operator == "+") {
                        $result = $num1 + $num2;
                    } else if ($operator == "-") {
                        $result = $num1 - $num2;
                    } else if ($operator == "/") {
                        $result = $num1 / $num2;
                    } else if ($operator == "*") {
                        $result = $num1 * $num2;
                    }
                    echo $result;
                } else{
                    echo"You haven't entered numbers";
                }

            }

        ?>

    </body>

</html>