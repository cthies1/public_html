<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <title>User Login Form</title>
        <meta name="description" content="This is a user login page." />
        <meta name="author" content="Chloe, Bee, Anna, Diggy" />
        <link rel="stylesheet" href="./assets/css/index.css" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css">
    </head>
    <body>
        <div class="page">
            <img src="./assets/images/logo.png" />
            <p>
                <?php
                if(isset($_GET["error"])){
                    $err = $_GET["error"];
                    
                    if($err >= 10){
                        echo "<font color='red'>*Must enter email </br>";
                        $err = $err-10;
                    }
                    if($err >= 2){
                        echo "<font color='red'>*Must enter password </br>";
                        $err = $err-2;
                    }
                }
                if(isset($_GET["credentials"])){
                    echo "<font color='red'>*Incorrect email or password</br>";
                }
                if(isset($_GET["numAttempts"]) AND $_GET["numAttempts"] >= 5){
                    echo "<font color='red'>*5 failed login attempts</br>";
                }
                
                
                if (isset($_SESSION["email"])) $email = $_SESSION["email"];
                // if(isset($_GET["email"])) $email = $_GET["email"];
                else $email = "";
                if (isset($_COOKIE["password"])) $pass = $_COOKIE["password"];
                // if(isset($_GET["pass"])) $pass = $_GET["pass"];
                else $pass = "";

                $link = "login.php";
                if(isset($_GET["numAttempts"])){
                    $link = "login.php?numAttempts=".$_GET["numAttempts"];
                }

                echo "<font color='black'>";
                ?>
                <div class="forms">
                    <h3>Login:</h3>
                    <form action="<?php echo $link ?>" method="post" style="width: 157px;">
                        <div class="text-box">Email: </div>
                        <input type="email" name="email" value="<?php echo $email; ?>" style="padding-top: 4px;" /></br></br>
                        <span class="text-box">Password: </span>
                        <input type="password" name="pass" value="<?php echo $pass; ?>" required="" id="id_password" style="padding-top: 4px;" />
                        <i class="far fa-eye" id="togglePassword" style="margin-left: -28px; color: #8973D2; cursor: pointer;"></i></br></br>
                        <input type="checkbox" name="rememberMe" /> Keep me logged in</br></br>
                        <input class="button" type="submit" value="Login" /></br></br>
                    </form>
                    <form action="createAccount.php" method = "post">
                        <input class="button" type="submit" value="Create Account" />
                    </form>
                </div>
            </p>
        </div>
        
        <script>
            const togglePassword = document.querySelector('#togglePassword');
            const password = document.querySelector('#id_password');
            
            togglePassword.addEventListener('click', function (e) {
                // toggle the type attribute
                const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
                password.setAttribute('type', type);
                // toggle the eye slash icon
                this.classList.toggle('fa-eye-slash');
            });
        </script>

        <?php
            //open the sqlite database file
            $db_file = './assets/databases/spoons.db';
            $db = new PDO('sqlite:' . $db_file);

            $stmt = $db->prepare('SELECT * from Users');
            $stmt2 = $db->prepare('SELECT COUNT(*) as num from Users');
            
            $stmt->execute();
            $stmt2->execute();

            $result = $stmt->fetchAll();
            $result2 = $stmt2->fetchAll();
            echo "Numrows: ".$result2[0]['num'];

            echo "<table>";
            echo "<tr>";
                echo "<th>fName</th><th>lName</th><th>email</th><th>password</th>";
            echo "</tr>";

            $row = 0;
            while($row < 10) {
                echo "<tr>";
                    echo "<td>".$result[$row]['fName']."</td>";
                    echo "<td>".$result[$row]['lName']."</td>";
                    echo "<td>".$result[$row]['Email']."</td>";
                    echo "<td>".$result[$row]['Password']."</td>";
                echo "</tr>";
                $row = $row+1;
            }
        ?>
        
    </body>
</html>
