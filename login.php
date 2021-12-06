<?php
session_start();

    try {
       
        // if (isset($_SESSION["email"])){    //if they haven't logged out since signing in
            
        //     //autofill the email box

        //     // <script type="text/javascript">

        //     // </script>
        // }
        
        if(isset($_POST['logout'])) {
            // remove all cookies
            setcookie("password", "", time() - 3600);
            // remove all session variables
            session_unset();
            // destroy the session
            session_destroy();
           
            // return to index
            header("Location: index.php");
        } else {
        
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
                
                if(!isset($result[0])){
                $stmtAdmin = $db->prepare('SELECT * from Admin where (Email = :email) and (Password = :pass)');
                $email = $_POST['email'];
                $password = $_POST['pass'];
                $stmtAdmin->bindValue(':email',$_POST['email']);
                $stmtAdmin->bindValue(':pass',$_POST['pass']);
                
                $stmtAdmin->execute();
                $resultAdmin = $stmtAdmin->fetchAll();
                if(isset($resultAdmin[0])){
                    $_SESSION["email"] = $email;
                    if (isset($_POST["rememberMe"])){
                    setcookie("password", $password, time() +
                                        (60 * 60));
    
                    
    
                    } else {
                    if (isset($_COOKIE["email"])){
                        setcookie("email", "");
                    }
                    if (isset($_COOKIE["password"])){
                        setcookie("password", "");
                    }
                    }
                    $str = "Location: adminHomePage.php";
                    header($str);
                    exit;
                }
                
                    if(isset($result1[0])){//password was just wrong
                        if(!isset($_GET["numAttempts"])){
                            $numAttempts = 1;
                            
                        } else {
                            $numAttempts = $_GET["numAttempts"];
                            $numAttempts = $numAttempts+1;
                        }
                        if($numAttempts >= 5){
                            $_SESSION["email"] = $email;
                            if (isset($_COOKIE["email"])){
                                setcookie("email", "");
                            }
                            $str = "Location: resetPassword.php";
                            header($str);
                        }
                        $str = "Location: index.php?credentials=false&numAttempts=".$numAttempts;
                        header($str);
                    } else {
                        
                        $str = "Location: index.php?credentials=false";
                        header($str);
                    }  
                } else {

                    $_SESSION["email"] = $email;
                    if (isset($_POST["rememberMe"])){
    
                    // Username is stored as cookie for 10 years as
                    // 10years * 365days * 24hrs * 60mins * 60secs
                    
    
                    // Password is stored as cookie for 10 years as 
                    // 10years * 365days * 24hrs * 60mins * 60secs
                    setcookie("password", $password, time() +
                                        (60 * 60));
    
                    // After setting cookies the session variable will be set
                    
    
                } else {
                    if (isset($_COOKIE["email"])){
                        setcookie("email", "");
                    }
                    if (isset($_COOKIE["password"])){
                        setcookie("password", "");
                    }
                }
                    //$str = "Location: homePage.php?username=".$_POST['email'];
                    $str = "Location: homePage.php";
                    header($str);
                    // echo "<table>";
                    // echo "<tr>";
                    //     echo "<th>fName</th><th>lName</th><th>email</th><th>password</th>";
                    // echo "</tr>";

                    // //while($arr = $stmt->fetchArray()) {
                    // //foreach($result as $tuple) {
                    // echo "<tr>";
                    // echo "<td>".$result[0]['fName']."</td>";
                    // echo "<td>".$result[0]['lName']."</td>";
                    // echo "<td>".$result[0]['Email']."</td>";
                    // echo "<td>".$result[0]['Password']."</td>";
                    // echo "</tr>"; 
                
                }    
            }
        }
        //disconnect from database
        $db = null;
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