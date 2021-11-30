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
            <img src="./assets/images/logo.png" />
            <p>
            <?php
                if(isset($_GET["error"])){
                    $err = $_GET["error"];
                    
                    if($err >= 1000000){
                        echo "<font color='red'>*Must enter email </br>";
                        $err = $err-1000000;
                    }
                    if($err >= 200000){
                        echo "<font color='red'>*Email already in use </br>";
                        $err = $err-200000;
                    }
                    if($err >= 30000){
                        echo "<font color='red'>*Must enter passsword </br>";
                        $err = $err-30000;
                    }
                    if($err >= 4000){
                        echo "<font color='red'>*Must enter first name </br>";
                        $err = $err-4000;
                    }
                    if($err >= 500){
                        echo "<font color='red'>*Must enter last name </br>";
                        $err = $err-500;
                    }
                    if($err >= 60){
                        echo "<font color='red'>*Must enter age </br>";
                        $err = $err-60;
                    }
                    if($err >= 7){
                        echo "<font color='red'>*Must be 18 or older to use Spoons </br>";
                        $err = $err-7;
                    }
                    
                }
                
                // if(isset($_GET["email"])) $email = $_GET["email"];
                // else $email = "";
                // if(isset($_GET["pass"])) $pass = $_GET["pass"];
                // else $pass = "";
                // if(isset($_GET["fName"])) $fName = $_GET["fName"];
                // else $fName = "";
                // if(isset($_GET["lName"])) $pass = $_GET["lName"];
                // else $lName = "";
                // if(isset($_GET["age"])) $age = $_GET["age"];
                // else $age = "";

                echo "<font color='black'>";
                ?>
                <div class="forms">
                    <h3>Create Account:</h3>
                    <form action="addAccount.php" method="post">
                        <div class="text-box">Email: </div><input type="email" name="email" /></br></br>
                        <div class="text-box">Password: </div><input type="text" name="pass" /></br></br>
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