<?php
    $user = $_GET['username'];
    $reporter = $_GET['reporter'];
    try{
        //open the sqlite database file
        $db_file = './assets/databases/spoons.db';
        $db = new PDO('sqlite:' . $db_file);
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $check = $db->prepare('select numReports from Report where userID is :username;');
        $check->bindValue(':username',$user);
        $check->execute();
        $check = $check->fetchAll();
        if($check){
            $numReports = $check[0]['numReports']+1;
            $quer = $db->prepare('update report set numReports=:nR where userID is :username;');
            $quer->bindValue(':nR',$numReports);
            $quer->bindValue(':username',$user);
            $quer->execute();
            if($numReports==3){
                $quer2 = $db->prepare('delete from user where userID is :username;');
                $quer2->bindValue(':username',$user);
                $quer2->execute();
            }
            $str = "Location: homePage.php?username=".$reporter."&reported=1";
            header($str);
            exit;
        }
        else{
            $quer = $db->prepare('insert into report values (:user, "mean",1);');
            $quer->bindValue(':user',$user);
            $quer->execute();

        }

    }
    catch(PDOException $e)
    {
        die('Exception : '.$e->getMessage());
    }

?>