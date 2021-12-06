<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <title>Admin Home Page</title>
        <meta name="description" content="This is a home page." />
        <meta name="author" content="Chloe, Bee, Anna, Diggy" />
        <link rel="stylesheet" href="./assets/css/home.css" />
    </head>
    <body>
        <img class = "logo" src="./assets/images/logo.png" />
        <div class="page">
            <form action="login.php" method = "POST">
                <input class="button" type="submit" name="logout" value="Log Out" /></br></br>
            </form>
            <form action="userAnswers.php" method = "POST">
                <input class="button" type="submit" name="userAnswers" value="Generate Report" /></br></br>
            </form>
            <h3>Welcome Admin!</h3>
        

        <?php
          $db_file = './assets/databases/spoons.db';
         $db = new PDO('sqlite:' . $db_file);
                   
         //set errormode to use exceptions
          $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $unMatches = $db->prepare('select * from unMatch;');
        $unMatches->execute();
        $unMatches = $unMatches->fetchAll();

        echo "<table>";
        echo "<h3>";
            echo "unmatches";
        echo"</h3>";
        echo "<tr>";
        echo "<th>user1</th><th>user2</th>";
        echo "</tr>";
            echo "<tr>";
            echo "<td>".$unMatches[0]['User1']."</td><td>".$unMatches[0]['User2']."</td>";
            echo "</tr>"; 
        echo "</table></br></br></br>"; 

        $report = $db->prepare('select * from report;');
        $report->execute();
        $report = $report->fetchAll();

        echo "<table>";
        echo "<h3>";
            echo "report";
        echo"</h3>";
        echo "<tr>";
        echo "<th>userID</th><th>numReports</th>";
        echo "</tr>";
            echo "<tr>";
            echo "<td>".$report[0]['UserID']."</td><td>".$report[0]['numReports']."</td>";
            echo "</tr>"; 
        echo "</table></br></br></br>"; 

        ?>
        </div>
    </body>