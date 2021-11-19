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
            
            if(isset($_GET["email"])) $email = $_GET["email"];
            else $email = "";
            if(isset($_GET["password"])) $password = $_GET["password"];
            else $password = "";

            echo "<font color='black'>";
            ?>
            <form action="login.php?" method="post">
                Email: <input type="email" name="email" /></br></br>
                Password: <input type="text" name="password" /></br></br>
                <input type="submit" value="Login" />
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