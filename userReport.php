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
            $user = $_GET['username'];

             //open connection to the spoons database file
            $db_file = './assets/databases/spoons.db';
             $db = new PDO('sqlite:' . $db_file);      // <------ Line 13
            
            //set errormode to use exceptions
             $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            // user answers 
            $answers = $db->prepare('Select QuestionID, response from results where userID is :username order by QuestionID;')
            $stmt = $db->prepare('SELECT * FROM Question ORDER BY questionID;');
            $answers->bindValue(':username',$user);
            $answers->execute();
            $stmt->execute();
            $answers = $answers->fetchAll();
            $stmt = $stmt->fetchAll();

            echo "<table>";
            echo "<h3>";
                echo $user." Quiz Responses";
            echo"</h3>";
            echo "<tr>";
            foreach($stmt as $quest)
                echo "<th>$quest['Quest']</th>";
            echo "</tr>";
            foreach($answers as $tuple) {          // <------ Line 24
                echo "<tr>";
                echo "<td>$tuple[response]</td>";
                echo "</tr>"; 
            } 
            echo "</table>"; 

            //user matches
            $matches = $db->prepare('select * from match where user1 is :user1 order by matchPercent;');
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
            foreach($matches as $tuple) {          // <------ Line 24
                echo "<tr>";
                echo "<td>$tuple[user2]</td>";
                echo "<td>$tuple[matchPercent]</td>";
                echo "<td>$tuple[date]</td>";
                echo "</tr>"; 
            } 
            echo "</table>"; 


            //user unmatches

            //user reports

        ?>


    </body>
