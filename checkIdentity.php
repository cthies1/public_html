<?php
    session_start();

    try {

        if(null == ($_POST['new_password'])){   //password
            $error += 2;
        }
        if($error > 0) {
            $str = "Location: resetPassword.php?error=".$error;
            header($str);

        } else {
            //open the sqlite database file
            $db_file = './assets/databases/spoons.db';
            $db = new PDO('sqlite:' . $db_file);
            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            //check that email exists ONLY
            $stmt1 = $db->prepare('Select response From Results Where QuizID = 1 and QuestionID = 2 and (UserID = :UserID)');
            $username = $_SESSION["email"];
            $stmt1->bindValue(':email',$_POST['email']);
        }
    }
    catch(PDOException $e)
    {
        die('Exception : '.$e->getMessage());
    }

?>