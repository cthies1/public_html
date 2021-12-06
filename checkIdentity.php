<?php
    session_start();

    try {

        if(null == ($_POST['new_password'])){   //password
            $error += 2;
        }
        //if(null = ($_POST()))
        if($error > 0) {
            $str = "Location: resetPassword.php?username=".$_SESSION["email"]."?error=".$error;
            header($str);

        } else {
            //open the sqlite database file
            $db_file = './assets/databases/spoons.db';
            $db = new PDO('sqlite:' . $db_file);
            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            //get anwser in db for big or little spoon question
            $stmt = $db->prepare('SELECT response FROM Results WHERE QuizID = 1 and QuestionID = 2 and (userID = :userID)');
            $userID = $_SESSION["email"];
            $stmt1->bindValue(':email',$_POST['email']);

            $stmt->execute();
            //get result
            $result = $stmt->fetchAll();
            if(!isset($result[0])){

            }
        }
    }
    catch(PDOException $e)
    {
        die('Exception : '.$e->getMessage());
    }

?>