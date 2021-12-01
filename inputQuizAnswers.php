<?php
    try {
        $error = 0;

        // Check if question one was answered
        if(null == ($_POST['question-1-answers'])){  
            $error += 1;
        }
         // Check if question 2 was answered
        if(null == ($_POST['question-2-answers'])){  
            $error += 1;
        }
        // Check if question 3 was answered
        if(null == ($_POST['question-3-answers'])){  
            $error += 1;
        }
        // Check if question 4 was answered
        if(null == ($_POST['question-4-answers'])){ 
            $error += 1;
        }
        // Check if question 5 was answered
        if(null == ($_POST['question-5-answers'])){  
            $error += 1;
        }
        // Check if question 6 was answered
        if(null == ($_POST['question-6-answers'])){ 
            $error += 1;
        }
        // Check if question 7 was answered
        if(null == ($_POST['question-7-answers'])){  
            $error += 1;
        }
        // Check if question 8 was answered
        if(null == ($_POST['question-8-answers'])){ 
            $error += 1;
        }
        // Check if question 9 was answered
        if(null == ($_POST['question-9-answers'])){ 
            $error += 1;
        }
        // Check if question 10 was answered
        if(null == ($_POST['question-10-answers'])){ 
            $error += 1;
        }
        // Check if question 11 was answered
        if(null == ($_POST['question-11-answers'])){ 
            $error += 1;
        }
        // Check if question 12 was answered
        if(null == ($_POST['question-12-answers'])){ 
            $error += 1;
        }
        // Check if question 13 was answered
        if(null == ($_POST['question-13-answers'])){  
            $error += 1;
        }
        // if error return to quiz with username and error
        if($error > 0) {
            $str = "Location: SpoonsQuiz.php?username=".$_GET[username]."&error=".$error;
            header($str);
        }

        // get all answers from the quiz
        $q1 = $_POST['question-1-answers'];
        $q2 = $_POST['question-2-answers'];
        $q3 = $_POST['question-3-answers'];
        $q4 = $_POST['question-4-answers'];
        $q5 = $_POST['question-5-answers'];
        $q6 = $_POST['question-6-answers'];
        $q7 = $_POST['question-7-answers'];
        $q8 = $_POST['question-8-answers'];
        $q9 = $_POST['question-9-answers'];
        $q10 = $_POST['question-10-answers'];
        $q11 = $_POST['question-11-answers'];
        $q12 = $_POST['question-12-answers'];
        $q13 = $_POST['question-13-answers'];

        //open the sqlite database file
        $db_file = './assets/databases/spoons.db';
        $db = new PDO('sqlite:' . $db_file);
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        echo "database open ...    ";
        echo "printing statement:   ";

        $stmt = $db->prepare('SELECT * from Users where (Email = :email) and (Password = :pass)');
            $email = $_POST['email'];
            $password = $_POST['pass'];
            $stmt->bindValue(':email',$_POST['email']);
            $stmt->bindValue(':pass',$_POST['pass']);

        $st1;

    }
    catch(PDOException $e)
    {
        die('Exception : '.$e->getMessage());
    }
    function debug_to_console($data) {
        $output = $data;
        if (is_array($output))
            $output = implode(',', $output);
    
        echo "<script>console.log('Debug Objects: " . $output . "' );</script>";
    }


?>