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
            <h3>Welcome back <?php echo $_SESSION["email"]?>!</h3>

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
                    <option value="today">today</option>
                    <option value="this week">this week</option>
                    <option value="this month">this month</option>
                    <option value="this year">this year</option>
                    <option value="show all" selected>show all</option>
                </select>
                <input class="button" type="submit" value="Filter" />
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
                <input class="button" type="submit" value="Filter" />
            </form>




            <form action="SpoonsQuiz.php" method = "POST">
                <input class="button" type="submit" value="Retake the quiz" /></br></br>
            </form>
            <form action="calculateMatch.php" method = "POST">
                <input class="button" type="submit" value="Calculate my best match" /></br></br>
            </form>

            <div class="match">
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
                    </div>
                    
                </div>
                <form action="calculateMatch.php" method = "POST">
                    <input class="next" type="submit" value=">" /></br></br>
                </form>
            </div>
            

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