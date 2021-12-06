<?php
session_start();

    $user = $_SESSION["email"];
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

        //grab today's date
        function dateToString($arr){
            if($arr[2]==0){
                return "00/00/0000";
            }
            return "{$arr[0]}/{$arr[1]}/{$arr[2]}";
        }
        $arr = getdate();
        $tDate = array($arr['mon'],$arr['mday'],$arr['year']);
        $tDate = dateToString($tDate);

        //if the user already has a report generated against them
        if($check){
            echo 'user already in system \n';
            $numReports = $check[0]['numReports']+1;
            $quer = $db->prepare('update report set numReports=:nR where userID is :username;');
            $quer->bindValue(':nR',$numReports);
            $quer->bindValue(':username',$user);
            $quer->execute();
            //if they have 3 reports against them, remove them from the database
            if($numReports==3){
                echo '3 reports against them \n';
                $quer2 = $db->prepare('delete from users where userID is :username;');
                $quer2->bindValue(':username',$user);
                $quer2->execute();
            }
            //unmatch the reporter from the person they reported
            echo 'unmatching \n';
            $quer = $db->prepare('insert into unmatch values (:reporter, :user, :date);');
            $quer->bindValue(':reporter',$reporter);
            $quer->bindValue(':user',$user);
            $quer->bindValue(':date',$tDate);
            $quer->execute();


           // $str = "Location: homePage.php?username=".$reporter."&dFilt=".$dFilt."&mFilt=".$mFilt;
            //header($str);
            //exit;
            //echo "getting past the exit!";
        }
        else{
            //insert a new person into the report table with a value of 1
            echo 'adding new perp to the system \n';
            $quer = $db->prepare('insert into report values (:user, "mean",1);');
            $quer->bindValue(':user',$user);
            $quer->execute();

            /*
            echo 'dropping match \n';
            $quer = $db->prepare('delete from match where user1 is :reporter and user2 is :user;');
            $quer->bindValue(':reporter',$reporter);
            $quer->bindValue(':user',$user);
            $quer->execute();

            $quer = $db->prepare('delete from match where user1 is :user and user2 is :reporter;');
            $quer->bindValue(':reporter',$reporter);
            $quer->bindValue(':user',$user);
            $quer->execute();
            */

            echo "inserting unmatch ";
            $quer = $db->prepare('insert into unmatch values (:user, :reporter, :date);');
            $quer->bindValue(':reporter',$reporter);
            $quer->bindValue(':user',$user);
            $quer->bindValue(':date',$tdate);
            $quer->execute();

            $quer = $db->prepare('insert into unmatch values (:reporter, :user, :date);');
            $quer->bindValue(':reporter',$reporter);
            $quer->bindValue(':user',$user);
            $quer->bindValue(':date',$tdate);
            $quer->execute();


            //$str = "Location: homePage.php?username=".$reporter."&dfilt=".$dFilt."&mfilt=".$mFilt;
            //header($str);
            //exit;

        }

    }
    catch(PDOException $e)
    {

       die('Exception : '.$e->getMessage());
    }

?>