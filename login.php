<?php
    try {
        $error = 0;
        
        if(null == ($_POST['email'])){  //email
            $error += 10;
        }
        
        if(null == ($_POST['pass'])){   //password
            $error += 2;
        }

        if($error > 0) {
            $str = "Location: index.php?error=".$error;
            header($str);
        }
        else {

            echo "Time to check credentials ";

            //open the sqlite database file
            $db_file = './assets/databases/spoons.db';
            $db = new PDO('sqlite:' . $db_file);
            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            echo "database open ...    ";
            echo "printing statement:   ";
            //check that email exists ONLY
            $stmt1 = $db->prepare('SELECT * from Users where (Email = :email)');
            $email = $_POST['email'];
            $stmt1->bindValue(':email',$_POST['email']);
            
            $stmt1->execute();

            $result1 = $stmt1->fetchAll();
            // //check email and password
            $stmt = $db->prepare('SELECT * from Users where (Email = :email) and (Password = :pass)');
            $email = $_POST['email'];
            $password = $_POST['pass'];
            $stmt->bindValue(':email',$_POST['email']);
            $stmt->bindValue(':pass',$_POST['pass']);
            
            $stmt->execute();

            $result = $stmt->fetchAll();
            echo "result";
            //if email exists, but password is wrong
            
            if(is_Null($result[0]['fName'])){
                //if email exists, but password is wrong
            
                if(is_Null($result1[0]['fName'])){
                    $numAttempts = $
                    //echo "Invalid username or password.";
                    $str = "Location: index.php?credentials=".$numAttempts;
                    header($str);

                }
                else{
               
                //echo "Invalid username or password.";
                $str = "Location: index.php?credentials=false";
                header($str);
                }
                
            }
            else {
                echo "moving to home page...";
                $str = "Location: homePage.php?username=".$_POST['email'];
                header($str);
                // echo "<table>";
                // echo "<tr>";
                //     echo "<th>fName</th><th>lName</th><th>email</th>";
                // echo "</tr>";

                // //while($arr = $stmt->fetchArray()) {
                //     //foreach($result as $tuple) {
                //     echo "<tr>";
                //     echo "<td>".$result[0]['fName']."</td>";
                //     echo "<td>".$result[0]['lName']."</td>";
                //     echo "<td>".$result[0]['Email']."</td>";
                //     echo "</tr>"; 
               
            }    
        }
        //disconnect from database
        $db = null;
    }
    catch(PDOException $e)
    {
        die('Exception : '.$e->getMessage());
    }
?>       