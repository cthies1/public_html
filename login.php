<?php
    try {
        $error = 0;
        //open the sqlite database file
        $db = new PDO('sqlite:./myDB/spoons.db');
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        $stmt =$db->prepare("SELECT * from User where email is username;");
        $stmt->bindValue(':username',$_POST['username']);
        $result = $stmt->execute();
        //username is not associated with an account
        if(mysql_num_rows($result)<1){//does this work???????? TODO
           
                $str = "Location: inputForm.php?error=username";
                header($str);
            
        }
        else{
        $stmt =$db->prepare("SELECT Password from User where Email is username;");
        $stmt->bindValue(':username',$_POST['username']);
        $result = $stmt->execute();
        //if the password is incorrect
        if(strcmp($_POST['password'],$result) != 0){
           
        
            $str = "Location: inputForm.php?error=password";
            header($str);
        }
        
        }
        
        //redirect user to another page
        //header("Location: showPassengers.php");
        //error if username is not in database: 
       
        
       
        //disconnect from database
        $db = null;
    }
    catch(PDOException $e)
    {
        die('Exception : '.$e->getMessage());
    }

?>