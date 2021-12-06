<?php
session_start();
?>

<!DOCTYPE html>
<html lang = "en">
    <head>
    <meta charset="utf-8" />
        <title>User Report</title>
        <meta name="description" content="This is a create account page." />
        <meta name="author" content="Chloe, Bee, Anna, Diggy" />
        <link rel="stylesheet" href="./assets/css/index.css" />
    </head>

    <body>  
        <?php
            $user = $_SESSION['email'];
            // $user = $GET['username'];

             //open connection to the spoons database file
            $db_file = './assets/databases/spoons.db';
             $db = new PDO('sqlite:' . $db_file);
            
            //set errormode to use exceptions
             $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

             //user info
             $userInfo = $db->prepare('select * from users where email is :username;');
             $userInfo->bindValue(':username',$user);
             $userInfo->execute();
             $userInfo = $userInfo->fetchAll();

             $numMatches = $db->prepare('SELECT count(*) as numMatches from Match where user1 is :user;');
             $numMatches->bindValue(':user',$user);
             $numMatches->execute();
             $numMatches = $numMatches->fetchAll();

             $numReports = $db->prepare('SELECT count(*) as numReports from Report where userID is :user;');
             $numReports->bindValue(':user',$user);
             $numReports->execute();
             $numReports = $numReports->fetchAll();


             echo "<table>";
             echo "<h3>";
                 echo $user." info";
             echo"</h3>";
             echo "<tr>";
             echo "<th>First Name</th><th>Last Name</th><th>Password</th><th>Age</th><th>Num. Matches</th><th>Num. Times Reported</th>";
             echo "</tr>";
                 echo "<tr>";
                 echo "<td>".$userInfo[0]['fName']."</td><td>".$userInfo[0]['lName']."</td><td>".$userInfo[0]['Password']."</td><td>".$userInfo[0]['Age']."</td><td>".$numMatches[0]['numMatches']."</td><td>".$numReports[0]['numReports']."</td>";
                 echo "</tr>"; 
             echo "</table>"; 


            $answers = $db->prepare('SELECT QuestionID, response from results where userID is :username order by QuestionID;');
            $stmt = $db->prepare('SELECT * FROM Question ORDER BY questionID;');
            $answers->bindValue(':username',$user);
            $answers->execute();
            $stmt->execute();
            $answers = $answers->fetchAll();
            $stmt = $stmt->fetchAll();

            // user answers 
            echo "<table>";
            echo "<h3>";
                echo $user." Quiz Responses";
            echo"</h3>";
            echo "<tr>";
            foreach($stmt as $quest) {
                echo "<th>".$quest['Quest']."</th>";
            }
            echo "</tr>";
            echo "<tr>";
            foreach($answers as $tuple) {
               
                echo "<td>".$tuple['response']."</td>";
                
            } 
            echo "</tr>"; 
            echo "</table>"; 

            //user matches
            $matches = $db->prepare('SELECT * from match where user1 is :user1 order by matchPercent;');
            $matches->bindValue(':user1',$user);
            $matches->execute();
            $matches = $matches->fetchAll();

            echo "<table>";
            echo "<h3>";
                echo $user." Matches";
            echo"</h3>";
            echo "<tr>";
                echo "<th>User 2</th><th>Match Percent</th><th>Date</th>";
            echo "</tr>";
            foreach($matches as $tuple) {
                echo "<tr>";
                echo "<td>".$tuple['User2']."</td>";
                echo "<td>".$tuple['matchPercent']."</td>";
                echo "<td>".$tuple['date']."</td>";
                echo "</tr>"; 
            } 
            echo "</table>"; 


            //user unmatches
            $unmatches = $db->prepare('SELECT * from unMatch where user1 is :user1;');
            $unmatches->bindValue(':user1',$user);
            $unmatches->execute();
            $unmatches = $unmatches->fetchAll();

            echo "<table>";
            echo "<h3>";
                echo $user." Unmatches";
            echo"</h3>";
            echo "<tr>";
                echo "<th>User 2</th><th>Date</th>";
            echo "</tr>";
            foreach($unmatches as $tuple) {
                echo "<tr>";
                echo "<td>".$tuple['user2']."</td>";
                echo "<td>".$tuple['date']."</td>";
                echo "</tr>"; 
            } 
            echo "</table>"; 


        ?>


    </body>
