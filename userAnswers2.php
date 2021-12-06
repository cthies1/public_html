<?php
session_start();
?>

<DOCTYPE html>
<html>
    <head>  
        <title> User Answers </title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-sacle=1.0">
    </head>

    <body>
        <?php
            //open the sqlite database file
            $db_file = './assets/databases/spoons.db';
            $db = new PDO('sqlite:' . $db_file);
            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            // $quizID = $_GET['quizID'];

            $stmt = $db->prepare('SELECT UserID, QuestionID, response FROM Results ORDER BY userID, questionID;');
            $stmt2 = $db->prepare('SELECT COUNT(*) AS numResults FROM Results;');

            $stmt3 = $db->prepare('SELECT * FROM Question ORDER BY questionID;');
            $stmt4 = $db->prepare('SELECT COUNT(*) AS numQs FROM Question;');
            
            $stmt->execute();
            $stmt2->execute();
            $stmt3->execute();
            $stmt4->execute();

            $result = $stmt->fetchAll();
            $result2 = $stmt2->fetchAll();
            $result3 = $stmt3->fetchAll();
            $result4 = $stmt4->fetchAll();

            echo "<table>";
            echo "<tr>";
                echo "<th>userID</th>";
                $row = 0;
                while($row < $result4[0]['numQs']) {
                    echo "<th>".$result3[$row]['Quest']."</th>";
                    $row = $row+1;
                }
            echo "</tr>";

            $row2 = 0;
            $mult = 1;
            echo $result2[0]['numUsers'];
            while($row2 < $result2[0]['numResults']) {
                echo "<tr>";
                echo "<td>".$result[$row2]['UserID']."</td>";
                while($row2 < $result4[0]['numQs']*$mult) {
                    echo "<td>".$result[$row2]['response']."</td>";
                    $row2 = $row2+1;
                }
                echo "</tr>";
                $mult = $mult+1;
            }
        ?>

    </body>

</html>