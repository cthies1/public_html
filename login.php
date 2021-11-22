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
            $str = "Location: login.php?error=".$error;
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
            // //check email and password
            $stmt = $db->prepare('SELECT * from Users where (Email = ":email") and (Password = ":pass")');
            //$stmt = "SELECT * from Users where (Email is :email) and (Password is :pass) ;";
            //$stmt = "SELECT * from Users;";
            $email = $_POST['email'];
            $password = $_POST['pass'];
            $stmt->bindValue(':email',$_POST['email']);
            $stmt->bindValue(':pass',$_POST['pass']);
            
            //echo $stmt;
            //$result = $db->query($stmt);
            $result = $stmt->execute();
            var_dump($result);

            if($result){
                echo "<table>";
                echo "<tr>";
                    echo "<th>fName</th><th>lName</th><th>email</th>";
                echo "</tr>";
                echo $result;
                $arr = array();
                while($arr = $result->fetchArray()) {
                    //foreach($result as $tuple) {
                    echo "<tr>";
                    echo "<td>".$arr['fName']."</td>";
                    echo "<td>$arr[lName]</td>";
                    echo "<td>$arr[Email]</td>";
                    echo "</tr>"; 
                }
            }
            else{
                echo "Invalid username or password.";
            }
            
            //} 
            // if ($result == null) {  //incorrect email or password
            //     header("Location: login.php?credentials=false");
            // } else {    //correct credentials, login
            //     header("Location: homePage.php");
            // }
            
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