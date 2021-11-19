<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <!-- <meta name="viewport" content="width=device-width, initial-scale=1.0" /> -->
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
                
                if($err >=100){
                    echo "<font color='red'>*Invalid first name </br>";
                    $err = $err-100;
                }
                if($err>=20){
                    echo "<font color='red'>*Invalid last name </br>";
                    $err = $err-20;
                }
                if($err>=3){
                    echo "<font color='red'>*Invalid ssn </br>";
                    $err = $err-3;
                }
            }

            if(isset($_GET["update"])) $update = $_GET["update"];
            else $update = "";
            
            if(isset($_GET["f_name"])) $f_name = $_GET["f_name"];
            else $f_name = "";
            if(isset($_GET["m_name"])) $m_name = $_GET["m_name"];
            else $m_name = "";
            if(isset($_GET["l_name"])) $l_name = $_GET["l_name"];
            else $l_name = "";
            if(isset($_GET["ssn"])) $ssn = $_GET["ssn"];
            else $ssn = "";

            $button = "Submit";          
            $link = "inputPassenger.php?";
            if (isset($_GET['ssn'])) $link .= "&ssn=".$_GET['ssn'];
            if (isset($_GET['f_name'])) $link .= "&f_name=".$_GET['f_name'];
            if (isset($_GET['m_name'])) $link .= "&m_name=".$_GET['m_name'];
            if (isset($_GET['l_name'])) $link .= "&l_name=".$_GET['l_name'];
            if (isset($_GET['update'])) {
                $link .= "&update=".$_GET['update'];
                $button = "Update Info";
            }

            echo "<font color='black'>";
            ?>
            <form action="<?php echo $link ?>"  method="post">
                First Name: <input type="text" name="f_name" value="<?php echo $f_name ?>" /></br></br>
                <!-- <div class ="error" id="firstNameError"></div> -->
                Middle Name: <input type="text" name="m_name" value="<?php echo $m_name ?>" /></br></br>
                Last Name: <input type="text" name="l_name" value="<?php echo $l_name ?>" /></br></br>
                <!-- <div class ="error" id="lastNameError"></div> -->
                Social Security Number: <input type="text" name="ssn" value="<?php echo $ssn ?>" /></br></br>
                <!-- <div class ="error" id="socialSecurityError"></div> -->
                <input type="submit" value="<?php echo $button ?>" />
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