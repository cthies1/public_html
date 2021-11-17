<?php
    try {
        //open the sqlite database file
        $db = new PDO('sqlite:./myDB/spoons.db');
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        // if($_POST['username'] != '' && $_POST['password'] != '') {
        //     $name = $_POST['username'];
        //     $pass = md5($_POST['password']);
        
        //     $query = mysql_query("SELECT * FROM `users` WHERE `email` = '$name' AND `password` = '$pass'");
            
        //     $rows = mysql_num_rows($query);
        //     if($rows > 0) {
        //         //successfull login
        //         $_SESSION['username'] = $name;
        //     } else {
        //         $msg = "Invalid Login Credentials";
        //     }

        //         mysql_close($connection);
        // } else {
        //     $msg = "Please Provide All Details";
        // }

        $stmt = $db->prepare("SELECT * from User where Email is 'johnsmith@test.com'");
        //$stmt->bindValue(':username',$_POST['username']);
        $result = $stmt->execute();
        
        echo "Print: ".$result;

        //is username associated with an account
        //if(mysql_num_rows($result) < 1) {//does this work???????? TODO
        if($result == null) {
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