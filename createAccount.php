<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <title>Create Account Form</title>
        <meta name="description" content="This is a create account page." />
        <meta name="author" content="Chloe, Bee, Anna, Diggy" />
        <link rel="stylesheet" href="./assets/css/index.css" />
    </head>
    <body>
        <div class="page">
            <h1>Create Account:</h1>
            <p>
                <?php
                
                if(isset($_GET["email"])) $email = $_GET["email"];
                else $email = "";
                if(isset($_GET["pass"])) $pass = $_GET["pass"];
                else $pass = "";

                echo "<font color='black'>";
                ?>
                <div class="forms">
                    <form action="addAccount.php?" method="post">
                        <div class="text-box">Email: </div><input type="email" name="email" value="<?php echo $email ?>" /></br></br>
                        <div class="text-box">Password: </div><input type="text" name="pass" value="<?php echo $pass ?>" /></br></br>
                        <div class="text-box">First Name: </div><input type="text" name="fName" /></br></br>
                        <div class="text-box">Last Name: </div><input type="text" name="lName" /></br></br>
                        <div class="text-box">Age: </div><input type="number" name="age" /></br></br></br>
                        <input class="button" type="submit" value="Create Account" /></br></br>
                    </form>
                    <form action="index.php" method = "post">
                        <input class="button" type="submit" value="Login" />
                    </form>
                </div>
            </p>
        </div>
        
    </body>
</html>