<!DOCTYPE html>
<html>
    <link rel="stylesheet" href="./assets/css/SpoonsQuiz.css">
<head>
    <title>Welcome! </title>
</head>
<body>
    <?php
        $homeID = $_GET['username'];
        $link = "inputQuizAnswers.php?username=".$homeID;
    ?>

    <form action= <?php echo $link; ?> method = "POST">
        <img class="logo" src="./assets/images/logo.png" />
        <body1>
            <h1>Welcome to Spoons!</h1>
            <h2> To get some matches, we need to know about you first! <br> Take this quiz to tell us about yourself!</h2>
            <?php
                if(isset($_GET["error"])){
                        $err = $_GET["error"];
                        
                    if($err >= 10){
                        echo "<font color='red'>*Hi, Sorry, you Must answer all Questions</br>";
                        $err = $err-1;
                    }
                }
            ?>
            <li>
                <h3>What is your Sign?</h3>
                <div>
                    <input type="radio" name="question-1-answers" id="question-1-answers-A" value="Aries" />
                    <label for="question-1-answers-A">Aries</label>
                </div>
                <div>
                    <input type="radio" name="question-1-answers" id="question-1-answers-B" value="Taurus" />
                    <label for="question-1-answers-B">Taurus</label>
                </div>
                <div>
                    <input type="radio" name="question-1-answers" id="question-1-answers-C" value="Gemini" />
                    <label for="question-1-answers-C">Gemini</label>
                </div>
                <div>
                    <input type="radio" name="question-1-answers" id="question-1-answers-D" value="Cancer" />
                    <label for="question-1-answers-D">Cancer</label>
                </div>
                <div>
                    <input type="radio" name="question-1-answers" id="question-1-answers-D" value="Leo" />
                    <label for="question-1-answers-E">Leo</label>
                </div>
                <div>
                    <input type="radio" name="question-1-answers" id="question-1-answers-F" value="Virgo" />
                    <label for="question-1-answers-F">Virgo</label>
                </div>
                <div>
                    <input type="radio" name="question-1-answers" id="question-1-answers-G" value="Libra" />
                    <label for="question-1-answers-G">Libra</label>
                </div>
                <div>
                    <input type="radio" name="question-1-answers" id="question-1-answers-H" value="Scropio" />
                    <label for="question-1-answers-H">Scorpio</label>
                </div>
                <div>
                    <input type="radio" name="question-1-answers" id="question-1-answers-I" value="Sagittarius" />
                    <label for="question-1-answers-I">Sagittarius</label>
                </div>
                <div>
                    <input type="radio" name="question-1-answers" id="question-1-answers-J" value="Capricorn" />
                    <label for="question-1-answers-J">Capricorn</label>
                </div>
                <div>
                    <input type="radio" name="question-1-answers" id="question-1-answers-K" value="Aquarius" />
                    <label for="question-1-answers-K">Aquarius</label>
                </div>
                <div>
                    <input type="radio" name="question-1-answers" id="question-1-answers-L" value="Pisces" />
                    <label for="question-1-answers-L">Pisces</label>
                </div>
            </li>
            <br>
            <li>
                <h3>Do you prefer to be a Big or Little spoon? </h3>
                <div>
                    <input type="radio" name="question-2-answers" id="question-2-answers-A" value="Little Spoon" />
                    <label for="question-2-answers-A">Little Spoon</label>
                </div>
                <div>
                    <input type="radio" name="question-2-answers" id="question-2-answers-B" value="Big Spoon" />
                    <label for="question-2-answers-B">Big Spoon</label>
                </div>
                <div>
                    <input type="radio" name="question-2-answers" id="question-2-answers-C" value="Both" />
                    <label for="question-2-answers-C">A little bit of both</label>
                </div>

            </li>
            <br>
            <li>
                <h3>What is your primary love language? </h3>
                <div>
                    <input type="radio" name="question-3-answers" id="question-3-answers-A" value="WofA" />
                    <label for="question-3-answers-A">Words of Affirmation</label>
                </div>
                <div>
                    <input type="radio" name="question-3-answers" id="question-3-answers-B" value="PT" />
                    <label for="question-3-answers-B">Physical Touch</label>
                </div>
                <div>
                    <input type="radio" name="question-3-answers" id="question-3-answers-C" value="RG" />
                    <label for="question-3-answers-C">Receiving Gifts</label>
                </div>
                <div>
                    <input type="radio" name="question-3-answers" id="question-3-answers-D" value="QT" />
                    <label for="question-3-answers-D">Quality Time</label>
                </div>
                <div>
                    <input type="radio" name="question-3-answers" id="question-3-answers-E" value="AofS" />
                    <label for="question-3-answers-E">Acts of Service</label>
                </div>
            </li>
            <br>
            <li>
                <h3>Are you religious?</h3>
                <div>
                    <input type="radio" name="question-4-answers" id="question-4-answers-A" value="religious" />
                    <label for="question-4-answers-A">Yes, I am religious</label>
                </div>
                <div>
                    <input type="radio" name="question-4-answers" id="question-4-answers-B" value="not religious" />
                    <label for="question-4-answers-B">No, I am not religious</label>
                </div>
            </li>
            <br>
            <li>
                <h3>What kind of music do you listen to?</h3>
                <div>
                    <input type="radio" name="question-5-answers" id="question-5-answers-A" value="Country" />
                    <label for="question-5-answers-A">Country</label>
                </div>
                <div>
                    <input type="radio" name="question-5-answers" id="question-5-answers-B" value="Rock" />
                    <label for="question-5-answers-B">Rock</label>
                </div>
                <div>
                    <input type="radio" name="question-5-answers" id="question-5-answers-C" value="Rap" />
                    <label for="question-5-answers-C">Rap</label>
                </div>
                <div>
                    <input type="radio" name="question-5-answers" id="question-5-answers-D" value="Indie" />
                    <label for="question-5-answers-D">Indie</label>
                </div>
                <div>
                    <input type="radio" name="question-5-answers" id="question-5-answers-E" value="Pop" />
                    <label for="question-5-answers-E">Pop</label>
                </div>
                <div>
                    <input type="radio" name="question-5-answers" id="question-5-answers-F" value="Jazz" />
                    <label for="question-5-answers-F">Jazz</label>
                </div>
                <div>
                    <input type="radio" name="question-5-answers" id="question-5-answers-G" value="Soul" />
                    <label for="question-5-answers-G">Soul</label>
                </div>
                <div>
                    <input type="radio" name="question-5-answers" id="question-5-answers-H" value="R&B" />
                    <label for="question-5-answers-H">R&B</label>
                </div>
                <div>
                    <input type="radio" name="question-5-answers" id="question-5-answers-I" value="EDM" />
                    <label for="question-5-answers-I">EDM</label>
                </div>
                <div>
                    <input type="radio" name="question-5-answers" id="question-5-answers-J" value="Classical" />
                    <label for="question-5-answers-J">Classical</label>
                </div>
                <div>
                    <input type="radio" name="question-5-answers" id="question-5-answers-K" value="Oldies" />
                    <label for="question-5-answers-K">Oldies</label>
                </div>
            </li>
            <br>
            <li>
                <h3>Where is your ideal place to live?</h3>
                <div>
                    <input type="radio" name="question-6-answers" id="question-6-answers-A" value="Forest" />
                    <label for="question-6-answers-A">The forest</label>
                </div>
                <div>
                    <input type="radio" name="question-6-answers" id="question-6-answers-B" value="City" />
                    <label for="question-6-answers-B">The city</label>
                </div>
                <div>
                    <input type="radio" name="question-6-answers" id="question-6-answers-C" value="Mountians" />
                    <label for="question-6-answers-C">The mountians</label>
                </div>
                <div>
                    <input type="radio" name="question-6-answers" id="question-6-answers-D" value="Small Town" />
                    <label for="question-6-answers-D">A small town</label>
                </div>
                <div>
                    <input type="radio" name="question-6-answers" id="question-6-answers-E" value="Suburbs" />
                    <label for="question-6-answers-E">The suburbs</label>
                </div>
                <div>
                    <input type="radio" name="question-6-answers" id="question-6-answers-F" value="Beach" />
                    <label for="question-6-answers-F">The beach</label>
                </div>
            </li>
            <br>
            <li>
                <h3>Are you an introvert or an extrovert?</h3>
                <div>
                    <input type="radio" name="question-7-answers" id="question-7-answers-A" value="Introvert" />
                    <label for="question-y-answers-A">Introvert</label>
                </div>
                <div>
                    <input type="radio" name="question-7-answers" id="question-7-answers-B" value="Extrovert" />
                    <label for="question-7-answers-B">Extrovert</label>
                </div>
                <div>
                    <input type="radio" name="question-7-answers" id="question-7-answers-C" value="In the middle" />
                    <label for="question-7-answers-C">In the middle</label>
                </div>
            </li>
            <br>
            <li>
                <h3>Which of the following is your biggest pet peeve?</h3>
                <div>
                    <input type="radio" name="question-8-answers" id="question-8-answers-A" value="C with M Open" />
                    <label for="question-8-answers-A">Chewing with Mouth Open</label>
                </div>
                <div>
                    <input type="radio" name="question-8-answers" id="question-8-answers-B" value="Interrupting" />
                    <label for="question-8-answers-B">Interrupting</label>
                </div>
                <div>
                    <input type="radio" name="question-8-answers" id="question-8-answers-C" value="Being late" />
                    <label for="question-8-answers-C">Being late</label>
                </div>
                <div>
                    <input type="radio" name="question-8-answers" id="question-8-answers-D" value="Slow Walker" />
                    <label for="question-8-answers-D">Slow walkers</label>
                </div>
                <div>
                    <input type="radio" name="question-8-answers" id="question-8-answers-E" value="Micro-Management" />
                    <label for="question-8-answers-E">Micro-Management</label>
                </div>
                <div>
                    <input type="radio" name="question-8-answers" id="question-8-answers-F" value="I P S" />
                    <label for="question-8-answers-F">Ignoring personal space</label>
                </div>
            </li>
            <br>
            <li>
                <h3>Do you Smoke?</h3>
                <div>
                    <input type="radio" name="question-9-answers" id="question-9-answers-A" value="Yes" />
                    <label for="question-9-answers-A">Yes</label>
                </div>
                <div>
                    <input type="radio" name="question-9-answers" id="question-9-answers-B" value="No" />
                    <label for="question-9-answers-B">No</label>
                </div>
                <div>
                    <input type="radio" name="question-9-answers" id="question-9-answers-C" value="Sometimes" />
                    <label for="question-9-answers-C">Sometimes</label>
                </div>
            </li>
            <br>
            <li>
                <h3>Do you drink?</h3>
                <div>
                    <input type="radio" name="question-10-answers" id="question-10-answers-A" value="Yes" />
                    <label for="question-10-answers-A">Yes</label>
                </div>
                <div>
                    <input type="radio" name="question-10-answers" id="question-10-answers-B" value="No" />
                    <label for="question-10-answers-B">No</label>
                </div>
                <div>
                    <input type="radio" name="question-10-answers" id="question-10-answers-C" value="Sometimes" />
                    <label for="question-10-answers-C">Sometimes</label>
                </div>
            </li>
            <br>
            <li>
                <h3>Are you flexible with change</h3>
                <div>
                    <input type="radio" name="question-11-answers" id="question-11-answers-A" value="Yes" />
                    <label for="question-11-answers-A">Yes</label>
                </div>
                <div>
                    <input type="radio" name="question-11-answers" id="question-11-answers-B" value="No" />
                    <label for="question-11-answers-B">No</label>
                </div>
            </li>
            <br>
            <li>
                <h3>Do you want kids</h3>
                <div>
                    <input type="radio" name="question-12-answers" id="question-12-answers-A" value="Yes" />
                    <label for="question-12-answers-A">Yes</label>
                </div>
                <div>
                    <input type="radio" name="question-12-answers" id="question-12-answers-B" value="No" />
                    <label for="question-12-answers-B">No</label>
                </div>
                <div>
                    <input type="radio" name="question-12-answers" id="question-12-answers-C" value="Maybe" />
                    <label for="question-12-answers-C">Maybe</label>
                </div>
            </li>
            <br>
            <li>
                <h3>What is your ideal age range?</h3>
                <div>
                    <input type="radio" name="question-13-answers" id="question-13-answers-A" value="18-25" />
                    <label for="question-13-answers-A">18-25</label>
                </div>
                <div>
                    <input type="radio" name="question-13-answers" id="question-13-answers-B" value="25-35" />
                    <label for="question-13-answers-B">25-35</label>
                </div>
                <div>
                    <input type="radio" name="question-13-answers" id="question-13-answers-C" value="35-45" />
                    <label for="question-13-answers-C">35-45</label>
                </div>
                <div>
                    <input type="radio" name="question-13-answers" id="question-13-answers-D" value="45-55" />
                    <label for="question-13-answers-D">45-55</label>
                </div>
                <div>
                    <input type="radio" name="question-13-answers" id="question-13-answers-E" value="55-65" />
                    <label for="question-13-answers-E">55-65</label>
                </div>
                <div>
                    <input type="radio" name="question-13-answers" id="question-13-answers-F" value="65-75" />
                    <label for="question-14-answers-F">65-75</label>
                </div>
                <div>
                    <input type="radio" name="question-13-answers" id="question-13-answers-G" value="75-85" />
                    <label for="question-13-answers-G">75-85</label>
                </div>
                <div>
                    <input type="radio" name="question-13-answers" id="question-13-answers-H" value="85-95" />
                    <label for="question-13-answers-H">85-95</label>
                </div>
                <div>
                    <input type="radio" name="question-13-answers" id="question-13-answers-I" value="95-105" />
                    <label for="question-13-answers-I">95-105</label>
                </div>
                <div>
                    <input type="radio" name="question-13-answers" id="question-13-answers-J" value="105-115" />
                    <label for="question-13-answers-J">105-115</label>
                </div>
            </li>
            <br>
            <br>
            <br>
            <input class="button button1" type="submit" value="Submit" /></br></br>
        </form>
    </body1>
</body>
</html>