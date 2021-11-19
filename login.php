<?php
    try {
        $error = 0;
        //$update = false;
        
        if(null == ($_POST['f_name']) or !ctype_alpha($_POST['f_name'])){//fname
            $error += 100;
        }
        
        if(null == ($_POST['l_name']) or !ctype_alpha($_POST['l_name'])){//lname
            $error += 20;
        }

        preg_match("/^[0-9]{3}-[0-9]{2}-[0-9]{4}$/", $_POST['ssn'], $matches);//ssn
        if (count($matches) <= 0) {
            $error += 3;
        }

        if($error > 0) {
            $str = "Location: inputForm.php?error=".$error;
            if (isset($_GET['ssn'])) $str .= "&ssn=".$_GET['ssn'];
            if (isset($_GET['f_name'])) $str .= "&f_name=".$_GET['f_name'];
            if (isset($_GET['m_name'])) $str .= "&m_name=".$_GET['m_name'];
            if (isset($_GET['l_name'])) $str .= "&l_name=".$_GET['l_name'];
            if (isset($_GET['update'])) $str .= "&update=".$_GET['update'];
            header($str);
        }
        else {
    
            //open the sqlite database file
            $db = new PDO('sqlite:./myDB/airport.db');
            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            //insert the passenger (UNSAFE!)
            //order matters (look at your schema)
            if (isset($_GET['update'])) {
                $quer = $db->prepare("DELETE FROM passengers WHERE ssn = :s");
                $quer->bindValue(':s',$_GET['update']);
                $result = $quer->execute();
            }
            $stmt =$db->prepare("INSERT INTO passengers VALUES
                (:f_name, :m_name, :l_name, :ssn);");
            $stmt->bindValue(':f_name',$_POST['f_name']);
            $stmt->bindValue(':m_name',$_POST['m_name']);
            $stmt->bindValue(':l_name',$_POST['l_name']);
            $stmt->bindValue(':ssn',$_POST['ssn']);
            $result = $stmt->execute();
            //$db->exec($stmt);

            //redirect user to another page
            header("Location: showPassengers.php?success=true");
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