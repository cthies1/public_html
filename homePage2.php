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