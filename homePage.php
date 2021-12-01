<!DOCTYPE html>
<html>
    <head>  
        <title> Home Page </title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-sacle=1.0">
    </head>

    <body>

    <!-- 
        Home Page is the page that the user will be directed to once logging in.
        Home page will take in the login information from a user and display all of the matches
        in a table. The user will have the option to filter out matches from the table based on the date
        they matched and based on the percentage of the match.

        NOTE other features, such as links to take quizzes or update their information, will be added later.
    -->

    <?php

        
        $homeID = $_GET['username'];
        echo("hello {$homeID}! Welcome back.");
        //path to the SQLite database file
        $db_file = './myDB/spoons.db';
        if(isset($_POST['dfilt'])){
            $dfilt = $_POST['dfilt'];
            echo $dfilt;
        }
        else{
            $dfilt = "show all";
        }
        if(isset($_POST['mfilt'])){
            $mfilt = $_POST['mfilt'];
            echo $mfilt;
        }
        else{
            $mfilt = "show all";
        }

        $link = "homePage.php?username=".$homeID;
    ?>

        <form action=<?php echo $link;?> method ="post">
         Show only results from
        <select name="dfilt">
        <option value="today">today</option>
        <option value="this week">this week</option>
        <option value="this month">this month</option>
        <option value="this year">this year</option>
        <option value="show all" selected>show all</option>
        </select>
        <input type="submit" value="Submit" />
        </form>

        <form action=<?php echo $link;?> method ="post">
        Only show matches greater than 
        <select name="mfilt">
        <option value="90%">90%</option>
        <option value="75%">75%</option>
        <option value="50%">50%</option>
        <option value="30%">30%</option>
        <option value="show all" selected>show all</option>
        </select>
        <input type="submit" value="Submit" />
        </form>

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
                else{
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
                    else{
                        //if subtracting a week will take you into the prev. year
                        if($tDate[0]==1){
                            //December has 31 days
                            $filtDate[0] = 12;
                            $filtDate[1] = ($tDate[1]-7)%31;
                            $filtDate[2] = $tDate[2]-1;
                        }
                        else{
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
                else{
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
        ?>

        <?php
        try{
            //open connection to the spoons database file
            $db_file = './assets/databases/spoons.db';
            $db = new PDO('sqlite:' . $db_file);      // <------ Line 13

            //set errormode to use exceptions
            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

           $dateFilt = dateFilter($dfilt); 
           $matchFilt = matchFilter($mfilt);

            //return all matches, and store the result set
            $query_str = $db->prepare('with Matches as (select * from Match where User1 is :username or User2 is :username)
            select fname, lname, date, matchpercent 
             from Matches , Users
             where (users.email is matches.user1 and matches.user1 is not :username)or (users.email is matches.user2 and matches.user2 is not :username)and (date>"00/00/0000") and matchPercent>0
             order by matchPercent desc;');  // <----- Line 19
             $query_str->bindValue(':username',$homeID);
             $query_str->execute();
            $result_set = $query_str->fetchAll();

            //store results in a table displaying the matches
            echo "<table>";
            echo "<tr>";
                echo "<th>First Name</th><th>Last Name</th><th>Match Percent</th><th>Date Matched</th>";
            echo "</tr>";
            foreach($result_set as $tuple) {          // <------ Line 24
                echo "<tr>";
                echo "<td>$tuple[fName]</td>";
                echo "<td>$tuple[lName]</td>";
                echo "<td>$tuple[matchPercent]</td>";
                echo "<td> $tuple[date]</td>";
                echo "</tr>"; 
             } 
             echo "</table>"; 

        }
        catch(PDOException $e) {
            die('Exception : '.$e->getMessage());
        }
        $spoonsLink = "SpoonsQuiz.php?username=".$homeID;
        $matchLink = "calculateMatch.php?username=".$homeIDl
        ?>
        <form action=<?php echo $spoonsLink;?> method = "post">
            <input type="submit" value="Spoon's quiz" /></br></br>
        </form>

        <form action=<?php echo $matchLink;?> method = "post">
            <input type="submit" value="Calculate match" /></br></br>
        </form>
    </body>

</html>