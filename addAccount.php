<?php
    try {
        $error = 0;
        
        if(null == ($_POST['email'])){  //email
            $error += 1000000;
        } else if(null == ($_POST['email'])){  //email already in use      STILL NEEDS TO BE FIXED
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

            echo "database open ...    ";

            //enter info into db

            echo "entered info into db...";

            $str = "Location: homePage.php?username=".$username;
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