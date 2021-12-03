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
            echo "numq = ".$numQ;

            $quer3 = $db->prepare('select count(*) as numusers from users');
            $quer3->execute();
            $numUsers = $quer3->fetchAll();
            $numUsers = $numUsers[0]['numusers'];

            //echo '<pre>'; 
            //print_r($data); 
            //echo '</pre>';

            echo "<table>";
            echo "<tr>";
            echo "<th>User ID</th>";
                foreach($quests as $tuple){
                    echo "<th>$tuple[Quest]</th>";
                }
            echo "</tr>";
                 
            for($i = 0; $i<sizeof($data); $i++) { 
                $tuple2 = $data[$i]; 
                echo $i."...";
                if($i==(0 % ($numQ+1))){
                    echo "<tr>";
                    echo $i."...";
                    echo "<td>$tuple2[UserID]</td>";

                }        // <------ Line 24
                echo "<td>$tuple2[response]</td>";
                if($i== (0 % ($numQ+1))){
                    echo "</tr>"; 
                }
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