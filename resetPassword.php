<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <link rel="stylesheet" href="./assets/css/index.css" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css">
    </head>
    <body>
        <div class="page">
            <img src="./assets/images/logo.png" />
            <?php
                $link = "checkIdentity.php?username=".$_SESSION["email"];
                //if (isset($_COOKIE["answer"])) $pass = $_COOKIE["answer"];
                if(isset($_GET["answer"])) $pass = $_GET["answer"];
                else $answer = "";
                //$answer = "";
                //if (isset($_COOKIE["new_password"])) $pass = $_COOKIE["new_password"];
                if(isset($_GET["new_pass"])) $pass = $_GET["new_pass"];
                else $new_pass = "";
                //$new_password = "";
            ?>
            <p>
            <div class="forms">
                    <h3>Reset Password:</h3>
                    <form action="<?php echo $link ?>" method="post" style="width: 157px;">
                        <h2>To reset your password we need to check your idenity first. </h2>
                        <br>
                        <div class="text-box">Are you a Big Spoon, Little Spoon, or A little bit of both?: </div>
                        <input type="text-box" name="question" value="<?php echo $answer; ?>" style="padding-top: 4px;" /></br></br>
                        <span class="text-box">New Password: </span>
                        <input type="password" name="pass" value="<?php echo $new_password; ?>" required="" id="new_password" style="padding-top: 4px;" />
                        <i class="far fa-eye" id="togglePassword" style="margin-left: -28px; color: #8973D2; cursor: pointer;"></i></br></br>
                        <input class="button" type="submit" value="Reset Password" /></br></br>
                    </form>
                </div>
            </p>
        </div>
    </body>
</html>