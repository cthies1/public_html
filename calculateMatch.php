<?php
session_start();
?>

<DOCTYPE html>
    <html>
    <head>  
        <title> Calculate Match </title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-sacle=1.0">
        <link rel="stylesheet" href="./assets/css/index.css" />
    </head>

    <body>
        <?php

            $matchID;
            $matchNum;
        try{
            //open connection to the spoons database file
            $db_file = './assets/databases/spoons.db';
            $db = new PDO('sqlite:' . $db_file);      // <------ Line 13

            //set errormode to use exceptions
            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            //the following query computes the highest match from the database and returns
            //the first name, last name, and number of questions they were compatible on.
            $query_str = $db->prepare('with compatibleAnswers as (select QuestionID,r2 from Results  natural join Compatible where userID is :username  and compatible.r1 is results.response),
            compatibleUsers as (select userID from Results natural join compatibleAnswers where QuestionID is compatibleAnswers.QuestionID and results.response is compatibleAnswers.r2 and userID is not :username),
            topCompat as (select count(*) as countMax,userID from compatibleUsers where userID not in (select email from users natural join match where users.email is match.user2 and :username is match.user1) and userID not in (select email from users natural join unmatch where users.email is unmatch.user2 and :username is unmatch.user1) group by userID),
            matchID as (select userID, matched from (select max(countMax) as matched, userID from topCompat))
            select fname, lname,email,age, matched from Users natural join matchID where users.email is  matchID.userID;');
            $query_str->bindValue(':username',$_SESSION["email"]);
            $query_str->execute();
            $topmatch = $query_str->fetchAll();


            if(sizeof($topmatch)==0){
                throw new Exception("no compatible matches");
            }

            $matchID = $topmatch[0]['Email'];
            echo " match id ".$matchID;
            echo " top match = ".$topmatch[0]['matched'];

            $query3 = $db->prepare('select count(*) as countNum from QuizQuestions where quizID=1');
            $query3->execute();
            $numQ = $query3->fetchAll();
            $qs = $numQ[0]['countNum'];
            $matchNum = ($topmatch[0]['matched']/$qs)*100;

            //the following query gives a table containing the questions the two users are compatible with
            //in the format (question text, user response, match response)
            
            $query2_str = $db->prepare('with u1 as (select response, QuestionID from results where userID is :username),
            u2 as (select response ,QuestionID from results where userID is :match),
            matchQuestions as (
            select compatible.questionID,compatible.r1,compatible.r2 from compatible, u1,u2 where compatible.QuestionID is u1.QuestionID and compatible.QuestionID is u2.questionID and compatible.r1 is u1.response and compatible.r2 is u2.response)
            select Quest, r1, r2 from question natural join matchQuestions;');
            $query2_str->bindValue(':username',$_SESSION["email"]);
            $query2_str->bindValue(':match',$matchID);
            $query2_str->execute();
            
            /*
            $query2_str = $db->prepare('with u1 as (select response, QuestionID from results where userID is "johnsmith@test.com"),
            u2 as (select response ,QuestionID from results where userID is "janesmith@test.com"),
            matchQuestions as (
            select compatible.questionID,compatible.r1,compatible.r2 from compatible, u1,u2 where compatible.QuestionID is u1.QuestionID and compatible.QuestionID is u2.questionID and compatible.r1 is u1.response)
            select Quest, r1, r2 from question natural join matchQuestions;');
            */
            //$query2_str->execute();
            $matchQuestions = $query2_str->fetchAll();
            //echo "size ".sizeof($matchQuestions);

           echo "Congratulations! Your future potential love interest is ".$matchID

            echo "<table>";
            echo "<tr>";
                echo "<th>Question</th><thWhen You Said...</th><th>They Said...</th>";
            echo "</tr>";
            foreach($matchQuestions as $tuple) {          // <------ Line 24
                echo "<tr>";
                echo "<td>$tuple[Quest]</td>";
                echo "<td>$tuple[r1]</td>";
                echo "<td>$tuple[r2]</td>";
                echo "</tr>"; 
             } 
             echo "</table>"; 

        }
        catch(PDOException $e) {
            echo "error";
            die('Exception : '.$e->getMessage());
        }
        catch(Exception $e){
            $err=1;
            $errorLink = "Location: homePage.php?username=".$_SESSION["email"]."&emptyMatch=".$err;
            header($errorLink);
            exit;
        }

        $matchLink = "inputMatch.php?user1=".$_SESSION["email"]."&user2=".$matchID."&percent=".$matchNum;
        $goHome = "homePage.php?username=".$_SESSION["email"];


        ?>
        <form action=<?php echo $matchLink;?> method = "post">
            <input type="submit" value="Accept the Match" /></br></br>
        </form>

        <form action=<?php echo $goHome;?> method = "post">
            <input type="submit" value="Return to Home Page" /></br></br>
        </form>

        

    </body>

    </html>