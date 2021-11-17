<DOCTYPE html>
    <html>
    <head>  
        <title> Calculate Match </title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-sacle=1.0">
    </head>

    <body>
        <?php
        try{
            //open connection to the spoons database file
            $db = new PDO('sqlite:' . $db_file);      // <------ Line 13

            //set errormode to use exceptions
            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            //the following query computes the highest match from the database and returns
            //the first name, last name, and number of questions they were compatible on.
            $query_str = "with compatibleAnswers as (select QuestionID,r2 from Results  natural join Compatible where userID is "$username"  and compatible.r1 is results.response),
            compatibleUsers as (select userID from Results natural join compatibleAnswers where QuestionID is compatibleAnswers.QuestionID and results.response is compatibleAnswers.r2 and userID is not "$username"),
            topCompat as (select count(*) as countMax,userID from compatibleUsers group by userID),
            matchID as (select userID, matched from (select max(countMax) as matched, userID from topCompat))
            select fname, lname,email matched from users natural join matchID where users.email is  matchID.userID;"
            $topmatch = $db->query($query_str);

            $matchID = $topmatch[0][email];

            //the following query gives a table containing the questions the two users are compatible with
            //in the format (question text, user response, match response)
            $query2_str = "with u1 as (select response, QuestionID from results where userID is "$username"),
            u2 as (select response ,QuestionID from results where userID is "$matchID"),
            matchQuestions as (
            select compatible.questionID,compatible.r1,compatible.r2 from compatible, u1,u2 where compatible.QuestionID is u1.QuestionID and compatible.QuestionID is u2.questionID and compatible.r1 is u1.response)
            select Quest, r1, r2 from question natural join matchQuestions;"
            $matchQuestions = $db->query($query2_str);

        }
        catch(PDOException $e) {
            die('Exception : '.$e->getMessage());
        }

        ?>
        

    </body>

    </html>