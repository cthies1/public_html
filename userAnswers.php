<?php
session_start();
?>

<DOCTYPE html>
<html>
    <head>  
        <title> User Answers </title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-sacle=1.0">
        <link rel="stylesheet" href="./assets/css/report.css" />
    </head>

    <body>
        <img class="logo" src="./assets/images/logo.png" />
        <h3>User Answers</h3>
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
                echo "<th>Generate Report</th>";
            echo "</tr>";

            $row2 = 0;
            $mult = 1;
            while($row2 < $result2[0]['numResults']) {
                echo "<tr>";
                if(isset($result[$row2]['UserID'])) echo "<td>".$result[$row2]['UserID']."</td>";
                while($row2 < $result4[0]['numQs']*$mult) {
                    if(isset($result[$row2]['response'])) echo "<td>".$result[$row2]['response']."</td>";
                    $row2 = $row2+1;
                }
                $reportLink = "userReport.php?user=".$result[$row2-1]['UserID'];
                if(isset($result[$row2-1]['response'])) echo "<td><a href=$reportLink>Generate User Report</a></td>";
                echo "</tr>";
                $mult = $mult+1;
            }
            echo "</table>";

            $quer = $db->prepare('select * from report;');
            $quer->execute();
            $quer = $quer->fetchAll();

            echo "<table>";
            echo "<h3>";
            echo "Reported Users";
        echo"</h3>";
            echo "<tr>";
                echo "<th>userID</th><th>num. Times Reported</th>";
            echo "</tr>";
                foreach($quer as $tuple){
                    echo "<tr>";
                        echo "<td>".$tuple['UserID']."</td><td>".$tuple['numReports']."</td>";
                    echo "</tr>";
                }
            echo "</table>";

            $quer = $db->prepare("select userID from report where userID not in (select email from users);");
            //$quer = $db->prepare('select email as UserID from users where email is "bbridge@test.com" ;');
            $quer->execute();
            $quer = $quer->fetchAll();

            echo "<table>";
            echo "<h3>";
            echo "Blocked Emails";
        echo"</h3>";
            echo "<tr>";
                echo "<th>userID</th>";
            echo "</tr>";
                foreach($quer as $tuple){
                    echo "<tr>";
                        echo "<td>".$tuple['UserID']."</td>";
                    echo "</tr>";
                }
            echo "</table>";


        ?>
        <?php
          $goHome = "adminHomePage.php?username=".$_SESSION["email"];
        ?>
        <form action=<?php echo $goHome;?> method = "post">
            <input class="button" type="submit" value="Return to Home Page" /></br></br>
        </form>

    </body>

</html>