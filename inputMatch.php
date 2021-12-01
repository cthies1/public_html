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
    //open connection to the spoons database file
    $db_file = './assets/databases/spoons.db';
    $db = new PDO('sqlite:' . $db_file);      // <------ Line 13
    
    //set errormode to use exceptions
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $query_str = $db->prepare('insert into match values ()')


}
catch(PDOException $e) {
    echo "error";
    die('Exception : '.$e->getMessage());
}

?>
</html>