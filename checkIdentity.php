<?php
    session_start();

    try {
        $error = 0;
        // check if password was entered
        if(null == ($_POST['pass'])){ 
            $error += 2;
        }
        // Check if question was answered
        if(null == ($_POST['question'])){  
            $error += 10;
        }
        if($error > 0) {
            $str = "Location: resetPassword.php?username=".$_SESSION["email"]."?error=".$error;
            header($str);
        } else {
            //$link = "checkIdentity.php?username=".$_SESSION["email"];
            $userID = $_SESSION["email"];
            //open the sqlite database file
            $db_file = './assets/databases/spoons.db';
            $db = new PDO('sqlite:' . $db_file);
            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            //check that email exists ONLY
            $stmt1 = $db->prepare('SELECT * from Users where (Email = :email)');
            $email = $userID;
            $stmt1->bindValue(':email',$email);
            
            $stmt1->execute();
            $result = $stmt1->fetchAll();
            echo implode(" ",$result);
            /*if($result == null){
                $error = 10000000;
                $link = "Location: createAccount.php?error=".$error;
                header($link);
            }*/

            //get anwser in db for big or little spoon question
            $stmt = $db->prepare('SELECT response FROM Results WHERE QuizID = 1 and QuestionID = 2 and (userID = :userID)');
            $userID = $_SESSION["email"];
            $stmt->bindValue(':email', $userID);

            $stmt->execute();
            //get result
            $result = $stmt->fetchAll();
            echo( $result);
            if(!isset($result[0])){
                // check that they verified their ID
                if(strcpm($result[0], $_POST['question']) == 0){
                    // if so, change password
                    $stmt = $db->prepare('UPDATE User SET (password = :pass) where (userId = userID)');
                    $password = $_POST['pass'];
                    $userID = $_SESSION["email"];
                    $stmt1->bindValue(':email',$userID);
                    $stmt1->bindValue(':pass',$password);
                    $stmt1->execute();
                }
            }
        }
    } catch(PDOException $e)
    {
        die('Exception : '.$e->getMessage());
    }

?>