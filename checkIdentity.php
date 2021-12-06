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
        // if errors send back
        if($error > 0) {
            $str = "Location: resetPassword.php?username=".$_SESSION["email"]."?error=".$error;
            header($str);
            
        } else {
            $userID = $_SESSION["email"];
            //open the sqlite database file
            $db_file = './assets/databases/spoons.db';
            $db = new PDO('sqlite:' . $db_file);
            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            //get anwser for big or little spoon question
            $stmt = $db->prepare('SELECT response FROM Results WHERE QuizID = 1 and QuestionID = 2 and (UserID = :userID)');
            $userID = $_SESSION["email"];
            $stmt->bindValue(':userID', $userID);
            $stmt->execute();

            //get result
            $result = $stmt->fetchAll();
            if(isset($result[0])){
                // check that they verified their ID
                if(strcmp($result[0][0], $_POST['question']) == 0){
                    // if so, change password
                    $stmt1 = $db->prepare('UPDATE Users SET password = :pass where (Email like :email)');
                    $password = $_POST['pass'];
                    $userID = $_SESSION["email"];
                    $stmt1->bindValue(':email',$userID);
                    $stmt1->bindValue(':pass',$password);
                    $stmt1->execute();

                    //disconnect from database
                    $db = null;
                }
            }
        }
        // send back to login page
        $str = "Location: index.php";
        header($str);
    } catch(PDOException $e)
    {
        die('Exception : '.$e->getMessage());
    }

?>