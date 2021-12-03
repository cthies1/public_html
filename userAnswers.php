<DOCTYPE html>
<html>
    <head>  
        <title> User Answers </title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-sacle=1.0">
    </head>

    <body>
        <?php
        $quizID = $_GET['quizID'];
        try{
            $db_file = './assets/databases/spoons.db';
            $db = new PDO('sqlite:' . $db_file);      // <------ Line 13
            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $query_str = $db->prepare('Select  userID,response from results natural join Question natural join QuizQuestions where QuizID=:qid order by userID, Quest;');
            $query_str->bindValue(':qid',$quizID);
            $query_str->execute();
            $data = $query_str->fetchAll();

            $quer2 = $db->prepare('select Quest from question natural join QuizQuestions where QuizID=:qid order by Quest;');
            $quer2->bindValue(':qid',$quizID);
            $quer2->execute();
            $quests = $quer2->fetchAll();
            $numQ = sizeof($quests);

            $quer3 = $db->prepare('select count(*) as numusers from users');
            $quer3->execute();
            $numUsers = $quer3->fetchAll();
            $numUsers = $numUsers[0]['numusers'];

            echo "<table>";
            echo "<tr>";
            echo "<th>User ID</th>";
                foreach($quests as $tuple){
                    echo "<th>$tuple[Quest]</th>";
                }
            echo "</tr>";
            for($j = 0; $j<$numUsers; $j++){
            echo "<tr>";
            for($i = 0; $i<=$numQ; $i++) { 
                $tuple2 = $data[$i];         // <------ Line 24
                
                if($i==0){
                    echo '<pre>'; 
                    print_r($tuple2); 
                    echo '</pre>';
                    echo "<td>$tuple2[UserID]</td>";
                }
                echo "<td>$tuple2[response]</td>";
                
             } 
             echo "</tr>"; 
            }
             echo "</table>"; 

        }
        catch(PDOException $e) {
            echo "error";
            die('Exception : '.$e->getMessage());
        }

        ?>

    </body>

</html>