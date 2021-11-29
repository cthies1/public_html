<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <title>User Login Form</title>
        <meta name="description" content="This is a user login page." />
        <meta name="author" content="Chloe, Bee, Anna, Diggy" />
        <link rel="stylesheet" href="./assets/css/styles.css" />
    </head>
    <body>
        <h1>Login Page:</h1>
        <p>
            <?php
            if(isset($_GET["error"])){
                $err = $_GET["error"];
                
                if($err >= 10){
                    echo "<font color='red'>*Invalid email </br>";
                    $err = $err-10;
                }
                if($err >= 2){
                    echo "<font color='red'>*Invalid password </br>";
                    $err = $err-2;
                }
            }
            if(isset($_GET["credentials"])){
                echo "<font color='red'>*Incorrect email or password</br>";
            }
            
            if(isset($_GET["email"])) $email = $_GET["email"];
            else $email = "";
            if(isset($_GET["pass"])) $pass = $_GET["pass"];
            else $pass = "";

            echo "<font color='black'>";
            ?>
            <form action="login.php?" method="post">
                Email: <input type="email" name="email" /></br></br>
                Password: <input type="text" name="pass" /></br></br>
                <input type="submit" value="Login" />
                <input type="submit" value="Create Account" />
                <input type="submit" value="Spoon's quiz" />
            </form>
            <form action="SpoonsQuiz.php" method = "POST">
                <input type="submit" value="Spoon's quiz" />
            </form>
        </p>
        
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