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

            $link = "checkIdentity.php?username=".$_SESSION["email"];
            $username = $_SESSION["email"];
            //open the sqlite database file
            $db_file = './assets/databases/spoons.db';
            $db = new PDO('sqlite:' . $db_file);
            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            //check that email exists ONLY
            $stmt1 = $db->prepare('SELECT * from Users where (Email = :email)');
            $email = $_POST['email'];
            $stmt1->bindValue(':email',$_POST['email']);
            
            $stmt1->execute();
            $result = $stmt1->fetchAll();
            if($result == null){
                $error = 10000000;
                $link = "Location: createAccount.php?error=".$error;
                header($link);
            }

            //get anwser in db for big or little spoon question
            /*$stmt = $db->prepare('SELECT response FROM Results WHERE QuizID = 1 and QuestionID = 2 and (userID = :userID)');
            $userID = $_SESSION["email"];
            $stmt1->bindValue(':email',$_POST['email']);

            $stmt->execute();
            //get result
            $result = $stmt->fetchAll();
            if(!isset($result[0])){
                $
                $st1 = $db->prepare('INSERT INTO results VALUES (1, 1, :username, :q1a)');
                $q1 = $_POST['question-1-answers'];
                $st1->bindValue(':username', $username);
                $st1->bindValue(':q1a', $q1);
                $result = $st1->execute();
            }*/
        }
    }
    catch(PDOException $e)
    {
        die('Exception : '.$e->getMessage());
    }

?>