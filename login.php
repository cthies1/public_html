<?php
    try {
        $error = 0;
        
        if(null == ($_POST['email'])){//email
            $error += 10;
        }
        
        if(null == ($_POST['password'])){//password
            $error += 2;
        }

        if($error > 0) {
            $str = "Location: login.php?error=".$error;
            header($str);
        }
        else {

            try {
                //open the sqlite database file
                $db_file = './assets/databases/spoons.db';
                $db = new PDO('sqlite:' . $db_file);
                $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
                echo "Starting checks";

                $stmt->bindValue(':email',$_POST['email']);
                $stmt->bindValue(':password',$_POST['password']);
                $result = $stmt->execute();
        
                if(isset($_GET['email'])) {
                    $email = $_GET['email'];
                        echo "Username: ".$username;
                    $stmt = $db->prepare("SELECT * from Users where Email is $email;");
                    $result = $stmt->execute();
                    if($result == null) {   //is username associated with an account
                        header("Location: login.html?error=username");
                    } else {    //username exists now check password
                        if(isset($_GET['password'])) {
                            $password = $_GET['password'];
                                echo "Password: ".$password;
                            $stmt = $db->prepare("SELECT * from Users where Password is $password;");
                            $result = $stmt->execute();
                        } else {
                            if($result == null) {   //password is incorrect
                                header("Location: login.html?error=password");
                            } else {    //password is correct
                                header("Location: homePage.php");
                            }
                        }
                    }
                }
                //disconnect from database
                $db = null;
        
            } catch(PDOException $e) {
                die('Exception : '.$e->getMessage());
            }
        }
        //disconnect from database
        $db = null;
    }
    catch(PDOException $e)
    {
        die('Exception : '.$e->getMessage());
    }


/*
    try {
        //open the sqlite database file
        $db_file = './assets/databases/spoons.db';
        $db = new PDO('sqlite:' . $db_file);
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        echo "Starting checks";

        if(isset($_GET['username'])) {
            $username = $_GET['username'];
                echo "Username: ".$username;
            $stmt = $db->prepare("SELECT * from Users where Email is $username;");
            $result = $stmt->execute();
            if($result == null) {   //is username associated with an account
                header("Location: login.html?error=username");
            } else {    //username exists now check password
                if(isset($_GET['password'])) {
                    $password = $_GET['password'];
                        echo "Password: ".$password;
                    $stmt = $db->prepare("SELECT * from Users where Password is $password;");
                    $result = $stmt->execute();
                } else {
                    if($result == null) {   //password is incorrect
                        header("Location: login.html?error=password");
                    } else {    //password is correct
                        header("Location: homePage.php");
                    }
                }
            }
        }
        //disconnect from database
        $db = null;

    } catch(PDOException $e) {
        die('Exception : '.$e->getMessage());
    }
*/




/*        
        if(isset($_GET['password'])) $password = $_GET['password'];
        
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
            $stmt =$db->prepare("SELECT Password from Users where Email is username;");
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
*/ 
?>       