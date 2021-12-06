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
                $link = "checkIdenity.php"
            ?>
            <p>
            <div class="forms">
                    <h3>Reset Password:</h3>
                    <form action="<?php echo $link ?>" method="post" style="width: 157px;">
                        <div class="text-box">To reset your password we need to check your idenity first. </div>
                        <br>
                        <div class="text-box">Are you a Big, Little, or a little bit of Both Spoon?: </div>
                        <input type="text-box" name="question" value="<?php echo $answer; ?>" style="padding-top: 4px;" /></br></br>
                        <span class="text-box">New Password: </span>
                        <input type="password" name="pass" value="<?php echo $password; ?>" required="" id="id_password" style="padding-top: 4px;" />
                        <i class="far fa-eye" id="togglePassword" style="margin-left: -28px; color: #8973D2; cursor: pointer;"></i></br></br>
                        <input class="button" type="submit" value="Reset Password" /></br></br>
                    </form>
                </div>
            </p>
        </div>
    </body>

    <?php
        

        //Select response From Results Where QuizID = 1 and QuestionID = 2 and  UserID = 'johnsmith@test.com'
    ?>
</html>