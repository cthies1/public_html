<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <title>User Login Form</title>
        <meta name="description" content="This is a user login page." />
        <meta name="author" content="Chloe, Bee, Anna, Diggy" />
        <link rel="stylesheet" href="./assets/css/index.css" />
    </head>
    <body>
        <div class="page">
            <img src="./assets/images/logo.png" />
            <p>
                <?php
                if(isset($_GET["error"])){
                    $err = $_GET["error"];
                    
                    if($err >= 10){
                        echo "<font color='red'>*Must enter email </br>";
                        $err = $err-10;
                    }
                    if($err >= 2){
                        echo "<font color='red'>*Must enter password </br>";
                        $err = $err-2;
                    }
                }
                if(isset($_GET["credentials"])){
                    echo "<font color='red'>*Incorrect email or password</br>";
                }
                if(isset($_GET["numAttempts"]) AND $_GET["numAttempts"] >= 5){
                    echo "<font color='red'>*5 failed login attempts</br>";
                }
                
                if (isset($_SESSION["email"])) $email = $_GET["email"];
                // if(isset($_GET["email"])) $email = $_GET["email"];
                else $email = "";
                if (isset($_SESSION["pass"])) $pass = $_GET["pass"];
                // if(isset($_GET["pass"])) $pass = $_GET["pass"];
                else $pass = "";

                $link = "login.php";
                if(isset($_GET["numAttempts"])){
                    $link = "login.php?numAttempts=".$_GET["numAttempts"];
                }

                echo "<font color='black'>";
                ?>
                <div class="forms">
                    <h3>Login:</h3>
                    <form action="<?php echo $link ?>" method="post">
                        <span class="text-box">Email: </span><input type="email" name="email" value="<?php echo $email; ?>" /></br></br>
                        <span class="text-box">Password: </span><input type="text" name="pass" value="<?php echo $pass; ?>" /></br></br>
                        <div><input type="checkbox" name="rememberMe"> Keep me logged in</div></br>
                        <input class="button" type="submit" value="Login" /></br></br>
                    </form>
                    <form action="createAccount.php" method = "post">
                        <input class="button" type="submit" value="Create Account" />
                    </form>
                </div>
            </p>
        </div>
        
    </body>

    <!-- <body>
        <p>
            <form action="login.php" method="post">
                Email: <input type="text" name="username"/><br/>
                Password: <input type="text" name="password"/><br/>

                <input type="submit" value="Login"/>
                <input type="submit" value="Create Account"/>
            </form>

        </p>
        
    </body> -->
</html>