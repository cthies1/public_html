<?php
session_start();

    $user = $_GET['username'];
    $reporter = $_GET['reporter'];
    $dFilt = $_GET['dfilt'];
    $mFilt = $_GET['mfilt'];
    try{
        //open the sqlite database file
        $db_file = './assets/databases/spoons.db';
        $db = new PDO('sqlite:' . $db_file);
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $check = $db->prepare('select numReports from Report where userID is :username;');
        $check->bindValue(':username',$user);
        $check->execute();
        $check = $check->fetchAll();

        function dateToString($arr){
            if($arr[2]==0){
                return "00/00/0000";
            }
            return "{$arr[0]}/{$arr[1]}/{$arr[2]}";
        }
        $arr = getdate();
        $tDate = array($arr['mon'],$arr['mday'],$arr['year']);
        $tDate = dateToString($tDate);
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

            $quer = $db->prepare('insert into unmatch values (:reporter, :user,:date);');
            $quer->bindValue(':reporter',$reporter);
            $quer->bindValue(':user',$username);
            $quer->bindValue(':date',$tdate);
            $quer->execute();

            $quer = $db->prepare('insert into unmatch values (:user, :reporter, :date);');
            $quer->bindValue(':reporter',$reporter);
            $quer->bindValue(':user',$username);
            $quer->bindValue(':date',$tdate);
            $quer->execute();

            $str = "Location: homePage.php?username=".$reporter."&dFilt=".$dFilt."&mFilt=".$mFilt;
            header($str);
            exit;
        }
        else{
            $quer = $db->prepare('insert into report values (:user, "mean",1);');
            $quer->bindValue(':user',$user);
            $quer->execute();
            $str = "Location: homePage.php?username=".$reporter."&dfilt=".$dFilt."&mfilt=".$mFilt;
            header($str);
            exit;

        }

    }
    catch(PDOException $e)
    {
        die('Exception : '.$e->getMessage());
    }

?>