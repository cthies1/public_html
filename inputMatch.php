TYPE html>
<html>
<head>  
        <title> Input Match </title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-sacle=1.0">
</head>
<?php
$user1 = $_GET['user1'];
$user2 = $_GET['user2'];
$percent = $_GET['percent'];

try{
    function dateToString($arr){
        if($arr[2]==0){
            return "00/00/0000";
        }
        return "{$arr[0]}/{$arr[1]}/{$arr[2]}";
    }

    $arr = getdate();
    $tDate = array($arr['mon'],$arr['mday'],$arr['year']);
    $tDate = dateToString($tDate);


    //open connection to the spoons database file
    $db_file = './assets/databases/spoons.db';
    $db = new PDO('sqlite:' . $db_file);      // <------ Line 13
    echo "user 1 = ".$user1."\n";
    echo "user 2 = ".$user2."\n";
    echo "percent = ".$percent."\n";
    echo "date = ".$tDate."\n";

    
    //set errormode to use exceptions
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $query_str = $db->prepare('insert into match values (:user1, :user2, :percent, :date);');
    $query_str->bindValue(':user1',$user1);
    $query_str->bindValue(':user2',$user2);
    $query_str->bindValue(':percent',$percent);
    $query_str->bindValue(':date',$tDate);
    $query_str->execute();

    $query2_str = $db->prepare('insert into match values (:user2, :user1, :percent, :date);');
    $query2_str->bindValue(':user1',$user1);
    $query2_str->bindValue(':user2',$user2);
    $query2_str->bindValue(':percent',$percent);
    $query2_str->bindValue(':date',$tDate);
    $query2_str->execute();

    $link = "homePage.php&username=".$user1;
    header($link);


}
catch(PDOException $e) {
    echo "error";
    die('Exception : '.$e->getMessage());
}

?>
</html>