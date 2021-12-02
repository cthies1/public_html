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

        //open the sqlite database file
        $db_file = './assets/databases/spoons.db';
        $db = new PDO('sqlite:' . $db_file);
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        echo "database open ...    ";
        echo "printing statement:   ";

        $username = $_GET[username];

        // insert Question 1 answer
        $st1 = $db->prepare('INSERT INTO results VALUES (1, 1, :username, :q1a)');
        $q1 = $_POST['question-1-answers'];
        $st1->bindValue(':username', $username);
        $st1->bindValue(':q1a', $q1);
        $result = $st1->execute();
       
        // insert Question 2 answer
        $st2 = $db->prepare('INSERT INTO results VALUES (1, 2, :username, :q2a)');
        $q2 = $_POST['question-2-answers'];
        $st2->bindValue(':username', $username);
        $st2->bindValue(':q2a', $q2);
        $result = $st2->execute();

        // insert Question 3 answer
        $st3 = $db->prepare('INSERT INTO results VALUES (1, 3, :username, :q3a)');
        $q3 = $_POST['question-3-answers'];
        $st3->bindValue(':username', $username);
        $st3->bindValue(':q3a', $q3);
        $result = $st3->execute();

        // insert Question 4 answer
        $st4 = $db->prepare('INSERT INTO results VALUES (1, 4, :username, :q4a)');
        $q4 = $_POST['question-4-answers'];
        $st4->bindValue(':username', $username);
        $st4->bindValue(':q4a', $q4);
        $result = $st4->execute();

        // insert Question 5 answer
        $st5 = $db->prepare('INSERT INTO results VALUES (1, 5, :username, :q5a)');
        $q5 = $_POST['question-5-answers'];
        $st5->bindValue(':username', $username);
        $st5->bindValue(':q5a', $q5);
        $result = $st5->execute();

        // insert Question 6 answer
        $st6 = $db->prepare('INSERT INTO results VALUES (1, 6, :username, :q6a)');
        $q6 = $_POST['question-6-answers'];
        $st6->bindValue(':username', $username);
        $st6->bindValue(':q6a', $q6);
        $result = $st6->execute();

        // insert Question 7 answer
        $st7 = $db->prepare('INSERT INTO results VALUES (1, 7, :username, :q7a)');
        $q7 = $_POST['question-7-answers'];
        $st7->bindValue(':username', $username);
        $st7->bindValue(':q7a', $q7);
        $result = $st7->execute();

        // insert Question 8 answer
        $st8 = $db->prepare('INSERT INTO results VALUES (1, 8, :username, :q8a)');
        $q8 = $_POST['question-8-answers'];
        $st8->bindValue(':username', $username);
        $st8->bindValue(':q8a', $q8);
        $result = $st8->execute();

        // insert Question 9 answer
        $st9 = $db->prepare('INSERT INTO results VALUES (1, 9, :username, :q9a)');
        $q9 = $_POST['question-9-answers'];
        $st9->bindValue(':username', $username);
        $st9->bindValue(':q9a', $q9);
        $result = $st9->execute();

        // insert Question 10 answer
        $st10 = $db->prepare('INSERT INTO results VALUES (1, 10, :username, :q10a)');
        $q10 = $_POST['question-10-answers'];
        $st10->bindValue(':username', $username);
        $st10->bindValue(':q10a', $q10);
        $result = $st10->execute();

        // insert Question 11 answer
        $st11 = $db->prepare('INSERT INTO results VALUES (1, 11, :username, :q11a)');
        $q11 = $_POST['question-11-answers'];
        $st11->bindValue(':username', $username);
        $st11->bindValue(':q11a', $q11);
        $result = $st11->execute();

        // insert Question 12 answer
        $st12 = $db->prepare('INSERT INTO results VALUES (1, 12, :username, :q12a)');
        $q12 = $_POST['question-12-answers'];
        $st12->bindValue(':username', $username);
        $st12->bindValue(':q12a', $q12);
        $result = $st12->execute();

        // insert Question 13 answer
        $st13 = $db->prepare('INSERT INTO results VALUES (1, 13, :username, :q13a)');
        $q13 = $_POST['question-13-answers'];
        $st13->bindValue(':username', $username);
        $st13->bindValue(':q13a', $q13);
        $result = $st13->execute();

        //disconnect from database
        $db = null;

        // send back to home page
        $str = "Location: homePage.php?username=".$_GET[username];
        header($str);

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