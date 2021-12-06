<?php
session_start();

    try {
        $error = 0;
        //open the sqlite database file
        $db_file = './assets/databases/spoons.db';
        $db = new PDO('sqlite:' . $db_file);
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        //check if email already in use
        $stmt = $db->prepare('SELECT * from Users where (Email = :email)');
        $email = $_POST['email'];
        $stmt->bindValue(':email',$_POST['email']);
        $stmt->execute();
        $result = $stmt->fetchAll();

        $stmtRep = $db->prepare('SELECT * from Users where (Email = :email)');
        $email = $_POST['email'];
        $stmtRep->bindValue(':email',$_POST['email']);
        $stmtRep->execute();
        $result = $stmt->fetchAll();
        
        if(null == ($_POST['email'])){  //email
            $error += 1000000;
        } else if(isset($result[0])){  //email already in use
            $error += 200000;
        }
        if(null == ($_POST['pass'])){   //password
            $error += 30000;
        }
        if(null == ($_POST['fName'])){   //first name
            $error += 4000;
        }
        if(null == ($_POST['lName'])){   //last name
            $error += 500;
        }
        if(null == ($_POST['age'])){   //age
            $error += 60;
        } else if(18 > ($_POST['age'])){   //age over 18
            $error += 7;
        }

        if($error > 0) {
            $str = "Location: createAccount.php?error=".$error;
            header($str);
        }
        else {

            //open the sqlite database file
            $db_file = './assets/databases/spoons.db';
            $db = new PDO('sqlite:' . $db_file);
            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            //insert the passenger (UNSAFE!)
            //order matters (look at your schema)
            $stmt =$db->prepare("INSERT INTO Users VALUES
                (:email, :pass, :fName, :lName, :age);");
            $stmt->bindValue(':email',$_POST['email']);
            $stmt->bindValue(':pass',$_POST['pass']);
            $stmt->bindValue(':fName',$_POST['fName']);
            $stmt->bindValue(':lName',$_POST['lName']);
            $stmt->bindValue(':age',$_POST['age']);
            $result = $stmt->execute();
            //$db->exec($stmt);

            //set session variables
            $_SESSION["email"] = $email;

            //redirect user to another page
            $str = "Location: SpoonsQuiz.php";
            header($str);

        }
        //disconnect from database
        $db = null;
    }
    catch(PDOException $e)
    {
        die('Exception : '.$e->getMessage());
    }
?>       