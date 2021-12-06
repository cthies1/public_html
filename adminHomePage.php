<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <title>Admin Home Page</title>
        <meta name="description" content="This is a home page." />
        <meta name="author" content="Chloe, Bee, Anna, Diggy" />
        <link rel="stylesheet" href="./assets/css/home.css" />
    </head>
    <body>
        <?php
            echo "Welcome Admin!";

            ?>
            <div class="forms">
            <form action="userAnswers.php" method = "POST">
                <input class="button" type="submit" name="userAnswers" value="Generate Report" /></br></br>
            </form>
            <form action="login.php" method = "POST">
                    <input class="button" type="submit" name="logout" value="Log Out" /></br></br>
                </form>

        </div>



    </body>