<!DOCTYPE html>

<html lang="en">

    <head>
        <title>Index</title>
        <link rel="stylesheet" href="styles.css">
    </head>

    <body>

        <div id="container">

            <h1>Basic Calculator</h1>

            <div id="content">

                <p>This is a basic calculator. It cannot divide by 0 and an only do addition, subtraction, division and multiplication. </p>

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

                <div id="calculaition">

                    <?php

                        if($_SERVER["REQUEST_METHOD"] == "POST") {

                            $num1 = $_POST['num1'];
                            $num2 = $_POST['num2'];
                            $operator = $_POST['operator'];

                            if (is_numeric($_POST["num1"]) && is_numeric($_POST["num2"])) {

                                if ($operator == "+") {
                                    echo $num1 + $num2;
                                } else if ($operator == "-") {
                                    echo $num1 - $num2;
                                } else if ($operator == "*") {
                                    echo $num1 * $num2;
                                }else if ($operator == "/") {
                                    if( $num1 <> 0 && $num2 <> 0 ){
                                        echo $num1 / $num2;
                                    }else{
                                        echo "Please enter a valid number you cannot divide by 0";
                                    }
                                }
                            } else{
                                echo"You haven't your numbers correctly please check they are integers and try again";
                            }

                        }

                    ?>
                    
                </div>

            </div>

        </div>
    
    </body>

</html>