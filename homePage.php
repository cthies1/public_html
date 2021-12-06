<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <title>Home Page</title>
        <meta name="description" content="This is a home page." />
        <meta name="author" content="Chloe, Bee, Anna, Diggy" />
        <link rel="stylesheet" href="./assets/css/home.css" />
    </head>
    <body>
        <img class = "logo" src="./assets/images/logo.png" />
        <div class="page">

            <div class="forms">
                <form action="login.php" method = "POST">
                    <input class="button" type="submit" name="logout" value="Log Out" /></br></br>
                </form>
                <form action="SpoonsQuiz.php" method = "POST">
                    <input class="button" type="submit" value="Retake the quiz" /></br></br>
                </form>
                <form action="calculateMatch.php" method = "POST">
                    <input class="button" type="submit" value="Calculate my best match" /></br></br>
                </form>
                <form action="userAnswers.php" method = "POST">
                    <input class="button" type="submit" value="User Answers" /></br></br>
                </form>
                <form action="userReport.php" method = "POST">
                    <input class="button" type="submit" value="User Report" /></br></br>
                </form>
            </div>
            <?php
            $variable = $_SESSION["email"];
            $variable = substr($variable, 0, strpos($variable, "@"));?>
            <h3>Welcome back <?php echo $variable?>!</h3>

            <?php
                //path to the SQLite database file
                $db_file = './myDB/spoons.db';
                if(isset($_POST['dfilt'])){
                    $dfilt = $_POST['dfilt'];
                    //echo $dfilt;
                } else if(isset($_GET['dfilt'])){
                    $dfilt = $_GET['dfilt'];
                    if($dfilt==1){
                        $dfilt = "show all";
                    }
                } else {
                    $dfilt = "show all";
                }
                if(isset($_POST['mfilt'])){
                    $mfilt = $_POST['mfilt'];
                    //echo $mfilt;
                } else if(isset($_GET['mfilt'])){
                    $mfilt = $_GET['mfilt'];
                    if($mfilt==1){
                        $mfilt = "show all";
                    }
                } else {
                    $mfilt = "show all";
                }

                $link = "homePage.php";
            ?>

            <form action=<?php echo $link; ?> method="post">
            <span class="dropdown">Show only results from </span>
                <select name="dfilt">
                    <option value="show all" selected>show all</option>
                    <option value="today">today</option>
                    <option value="this week">this week</option>
                    <option value="this month">this month</option>
                    <option value="this year">this year</option>
                </select>
                <input class="button2" type="submit" value="Filter" />
            </form>

            <form action=<?php echo $link; ?> method ="post">
            <span class="dropdown">Show only matches greater than </span> 
                <select name="mfilt">
                    <option value="90%">90%</option>
                    <option value="75%">75%</option>
                    <option value="50%">50%</option>
                    <option value="30%">30%</option>
                    <option value="show all" selected>show all</option>
                </select>
                <input class="button2" type="submit" value="Filter" />
            </form>

            </br></br>

            <?php
                /*
                    matchFilter returns the lower bound of the match percentage to 
                    filter the matches from.

                    $mfilt is a string containing the match percent to filter on of the format "[num]%".
                    return a number from 0 to 100
                */
                function matchFilter($mfilt){
                    //echo " matchFilter = ".$mfilt;
                    if(strcmp($mfilt,"show all")==0){
                        return 0;
                    }
                    else {
                        //remove the percentage from the end and return the string as an int
                        //echo " result = ".intval(substr_replace($mfilt ,"",-1));
                        return intval(substr_replace($mfilt ,"",-1));
                    }
                }

                /*
                    get the current date:
                    getdate() function returns array with:
                    the month stored in index 5, day of month stores in index 3, year stored in index 6.
                    store these values in its own array

                */
                $arr = getdate();
                $tDate = array($arr['mon'],$arr['mday'],$arr['year']);
                //echo "tdate: ".$tDate[0];

                /*
                    dateFilter returns the lower bound of the dates to filter the matches from.

                    $dfilt is a string containing the timeline of the dates
                    @return a string representation of the date filter in mm/d/yyyy format.
                */    
                function dateFilter($dfilt){
                    //filtDate will hold the filter date
                    global $tDate;
                    $filtDate = $tDate;
                    //only show matches from the current day
                    if(strcmp($dfilt,"today")==0){
                        return dateToString($tDate);
                    }

                    //only show matches from the past week
                    else if(strcmp($dfilt,"this week")==0){
                        //more than 7 days in the current month, subtract 7
                        if($tDate[1]>7){
                            $filtDate[1] = $tDate[1]-7;
                        }

                        //if subtracting a week will take you into the prev. month
                        else {
                            //if subtracting a week will take you into the prev. year
                            if($tDate[0]==1){
                                //December has 31 days
                                $filtDate[0] = 12;
                                $filtDate[1] = ($tDate[1]-7)%31;
                                $filtDate[2] = $tDate[2]-1;
                            }
                            else {
                                //update the month and the correct num. days
                                $daysInMonth = cal_days_in_month(CAL_GREGORIAN,$tDate[0],$tDate[2]);
                                $filtDate[0] = $tDate[0]-1;
                                $filtDate[1] = ($tDate[1]-7)%$daysInMonth;
                            }
                        }
                    }

                    //only show matches from the past month: updating the month takes you to
                    //the same day of the previous month. ex: feb 13th ->jan 13th
                    else if(strcmp($dfilt,"this month")==0){
                        $filtDate[0] = $tDate[0]-1;
                        //if subtracting a month takes you into the previous year
                        if($filtDate[0]==0){
                            $filtDate[0] = 12;
                            $filtDate[2] = $tDate[2]-1;
                        }
                    }

                    //only show matches from the past year
                    else if(strcmp($dfilt,"this year")==0){
                        $filtDate[2] = $tDate[2]-1;
                    }

                    //no filter: show all matches
                    else {
                        $filtDate[0] = 0;
                        $filtDate[1] = 0;
                        $filtDate[2] = 0;
                    }
                    return dateToString($filtDate);
                }

                /*
                    dateToString takes in a date in array format, where the month is stored in 
                    index 0, the day at index 1, the year at index 2 and returns a string
                    representation of the date.
                */
                function dateToString($arr){
                    if($arr[2]==0){
                        return "00/00/0000";
                    }
                    return "{$arr[0]}/{$arr[1]}/{$arr[2]}";
                }

                try {
                //open connection to the spoons database file
                $db_file = './assets/databases/spoons.db';
                $db = new PDO('sqlite:' . $db_file);      // <------ Line 13

                //set errormode to use exceptions
                $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                $dateFilt = dateFilter($dfilt); 
                $matchFilt = matchFilter($mfilt);

                //return all matches, and store the result set
                $query_str = $db->prepare('with Matches as (SELECT * from Match where User1 is :username)
                SELECT fname, lname, date, matchpercent, email as matchID, age
                from Matches , Users
                where (users.email is matches.user1 and matches.user1 is not :username) or (users.email is matches.user2 and matches.user2 is not :username) and matches.user2 not in (select user2 from unmatch where user1 is :username) and (date >= :date) and matchPercent > :percent
                order by matchPercent desc;');  // <----- Line 19
                $query_str->bindValue(':username',$_SESSION["email"]);
                $query_str->bindValue(':date',$dateFilt);
                $query_str->bindValue(':percent',$matchFilt);
                $query_str->execute();
                $result_set = $query_str->fetchAll();


                if(strcmp($dfilt,"show all")==0){
                    $dfilt=1;
                }
                if(strcmp($mfilt,"show all")==0){
                    $mfilt=1;
                }

                //store results in a table displaying the matches
                echo "<table>";
                echo "<tr>";
                    echo "<th>First Name</th><th>Last Name</th><th>Email</th><th>Match Percent</th><th>Date Matched</th><th>Age</th><th>Report user?</th><th>Unmatch user?</th>";
                echo "</tr>";
                foreach($result_set as $tuple) {          // <------ Line 24
                    echo "<tr>";
                    echo "<td>$tuple[fName]</td>";
                    echo "<td>$tuple[lName]</td>";
                    echo "<td>$tuple[matchID]</td>";
                    echo "<td>$tuple[matchPercent]</td>";
                    echo "<td> $tuple[date]</td>";
                    echo "<td> $tuple[age]</td>";
                    $reportLink = "generateReport.php?username=".$tuple['matchID']."&reporter=".$_SESSION["email"]."&dfilt=".$dfilt."&mfilt=".$mfilt;
                    echo "<td><a href=$reportLink>Report User</a></td>";
                    $unmatchLink = "unMatch.php?user2=".$tuple['matchID']."&user1=".$_SESSION["email"]."&dfilt=".$dfilt."&mfilt=".$mfilt;
                    echo "<td><a href=$unmatchLink>Unmatch User</a></td>";
                    echo "</tr>"; 
                } 
                echo "</table>"; 

                }
                catch(PDOException $e) {
                die('Exception : '.$e->getMessage());
                }

                if(isset($_GET['emptyMatch'])){
                echo "There are no new matches at this time. Try retaking the quiz to see if you get different results!";
                }
                $spoonsLink = "SpoonsQuiz.php";
                $matchLink = "calculateMatch.php";

            ?>

            <!-- <div class="match">
                <form action="calculateMatch.php" method = "POST">
                    <input class="last" type="submit" value="<" /></br></br>
                </form>
                <div class="match_card">
                    <img class="profile_pic" src="https://via.placeholder.com/250x300">
                    <div class="profile_info">
                        <h3>fName lName</h3>
                        <h4>__% Match</h4>
                        <p>email</p>
                        <p>age</p>
                        <p>date matched</p>

                        <form action="reportUser.php" method = "POST">
                            <input class="button2" type="submit" value="Report" /></br></br>
                        </form>

                        <form action="unmatchUser.php" method = "POST">
                            <input class="button2" type="submit" value="Unmatch" /></br></br>
                        </form>

                    </div>
                    
                </div>
                <form action="calculateMatch.php" method = "POST">
                    <input class="next" type="submit" value=">" /></br></br>
                </form>
            </div> -->
            
        </div>
        
    </body>

</html>


<!-- 
    fname
    lastname
    email
    percent
    age
    compatable questions


    spoons quiz (already taken)
    calculate match
    next match
    show celeb best match
 -->