<?php
session_start();

    $user1 = $_GET['user1'];
    $user2 = $_GET['user2'];
    $dFilt = $_GET['dfilt'];
    $mFilt = $_GET['mfilt'];
    try{
        //open the sqlite database file
        $db_file = './assets/databases/spoons.db';
        $db = new PDO('sqlite:' . $db_file);
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        function dateToString($arr){
            if($arr[2]==0){
                return "00/00/0000";
            }
            return "{$arr[0]}/{$arr[1]}/{$arr[2]}";
        }
        $arr = getdate();
        $tDate = array($arr['mon'],$arr['mday'],$arr['year']);
        $tDate = dateToString($tDate);

         $quer = $db->prepare('insert into unMatch values (:user1, :user2, :date);');
         $quer->bindValue(':user1',$user1);
         $quer->bindValue(':user2',$user2);
         $quer->bindValue(':date',$tDate);
         $quer->execute();

         $quer = $db->prepare('insert into unMatch values (:user2, :user1, :date);');
         $quer->bindValue(':user1',$user1);
         $quer->bindValue(':user2',$user2);
         $quer->bindValue(':date',$tDate);
         $quer->execute();
         echo "dfilt = ".$dFilt;
         echo " mfilt = ".$mFilt;
         $str = "Location: homePage.php?username=".$user1."&dfilt=".$dFilt."&mfilt=".$mFilt;
          header($str);
           exit;


    }
    catch(PDOException $e)
    {
        die('Exception : '.$e->getMessage());
    }

?>