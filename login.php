<?php
    try {
        //open the sqlite database file
        $db = new PDO('sqlite:./myDB/spoons.db');
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        $stmt = $db->prepare("SELECT * from User where email is :username;");
        $stmt->bindValue(':username',$_POST['username']);
        $result = $stmt->execute();
        
        echo "Print: ".$result;

        //username is not associated with an account
        if(mysql_num_rows($result) == null) {//does this work???????? TODO
                header("Location: login.html?error=username");
        }

        //username exists now check password
        else {
            $stmt =$db->prepare("SELECT Password from User where Email is username;");
            $stmt->bindValue(':username',$_POST['username']);
            $result = $stmt->execute();
            
            //password is incorrect
            if(strcmp($_POST['password'],$result) != 0) {
                header("Location: login.html?error=password");
            }

            //password is correct
            else {
                header("Location: homePage.php");
            }
        }
             
        //disconnect from database
        $db = null;
    }
    catch(PDOException $e) {
        die('Exception : '.$e->getMessage());
    }

?>