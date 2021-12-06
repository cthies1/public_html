<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <title>Reset Password Page</title>
        <meta name="description" content="This is a user login page." />
        <meta name="author" content="Chloe, Bee, Anna, Diggy" />
        <link rel="stylesheet" href="./assets/css/reset.css" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css">
    </head>
    <body>
        <div class="page">
            <img src="./assets/images/logo.png" />
            <?php
                $link = "checkIdentity.php?username=".$_SESSION["email"];
                if(isset($_GET["error"])){
                    $err = $_GET["error"];
                    
                    if(err >= 100){
                        echo "<font color='red'>*That is not what you re</br></br>";
                        $err = $err-10;
                    }
                    if($err >= 10){
                        echo "<font color='red'>*You must answer all questions!</br></br>";
                        $err = $err-10;
                    }
                    if($err >= 2){
                        echo "<font color='red'>*Must enter new password </br>";
                        $err = $err-2;
                    }
                }
            ?>
            <p>
            <div class="forms">
                    <h3>Reset Password:</h3>
                    <form action="<?php echo $link ?>" method="post" style="width: 157px;">
                    <span class="text-box">To reset your password, please anwser the security question.</span>
                    <br>
                    <br>
                        <span class="text-box">Are you a Big, Little, or a little bit of both: </span>
                        <div>
                                <input type="radio" name="question" id="question-A" value="Little Spoon" />
                                <label for="question-A">Little Spoon</label>
                            </div>
                            <div>
                                <input type="radio" name="question" id="question-B" value="Big Spoon" />
                                <label for="question-B">Big Spoon</label>
                            </div>
                            <div>
                                <input type="radio" name="question" id="question-C" value="A little bit of both" />
                                <label for="question-C">A little bit of both</label>
                        </div>
                        <br>
                        <span class="text-box">New Password: </span>
                        <input type="password" name="pass" value="<?php $new_password; ?>" required="" id="new_password" style="padding-top: 4px;" />
                        <i class="far fa-eye" id="togglePassword" style="margin-left: -28px; color: #8973D2; cursor: pointer;"></i></br></br>
                        <input class="button" type="submit" value="Reset Password" /></br></br>
                    </form>
                </div>
            </p>
        </div>
    </body>
</html>