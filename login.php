<?php 
    include_once 'database.php';

    if(session_id()) {
        echo "";
    }
    else {
        session_start();
    } 

    if(isset($_SESSION['login'])) {
        if($_SESSION['login'] == true) {
            header("Location: index.php");
        }
    }

?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="CSS/style.css" rel="stylesheet" type="text/css">
        <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
        <link href="font-awesome-6-pro-main/css/all.css" rel="stylesheet">
        <link type="image/png" rel="shortcut icon" href="IMG/logo.png">
        <script type="text/javascript" src="functions.js"></script>
        <title>VentureAnalytica</title>
    </head>
    <body>
        <style>
            body {
                background:#000010; 
            }
        </style>

        <div class="logsplit">
            <div class="logingrid">
                <div></div>
                <div class="grid">
                    <br>
                    <div>
                        <text class="smallheading-white">Login</text>
                        <br><br>
                        <form class="grid gap-r-15" method="POST">
                            <div class="grid gap-r-7">
                                <input class="inputfield styleremove" placeholder="Email" name="email" type="text"> 
                                <input class="inputfield styleremove" placeholder="Password" name="password" type="password">
                            </div>
                            <button type="submit" name="login" class="buttonstyleremove backgrounddarkblue normal-bold-white sidetosidepadding toppadding bottompadding buttondark">Login</button>
                            <p id="loginerror" class="smalltext-error highlight">
                                <?php 
                                    if(isset($_GET['login'])) {
                                        $login = $_GET['login'];
                                        if($_GET['login'] == 'unsuccessful') {
                                            echo "Email or Password is Incorrect";
                                        }
                                    }
                                ?>
                            </p>
                            <text class="white smalltext">Don't have an account?<a href="signup.php" class="linkcolor linkstyleremove smalltext buttonicondark"> Sign up</a></text>
                        </form>
                    </div>
                </div>
                <div></div>
            </div>
            <div class="grid">
                <br><br>
                <text class="heading-white center"> 
                    <?php if ($_SESSION['signup'] == true) {
                        if (isset($_GET['successful'])) {
                            echo $_GET['successful'];
                        }
                        else {
                            echo "Welcome to VentureAnalytica!";
                        }
                    } else {
                        echo "Welcome to VentureAnalytica!";
                    }
                    ?>
                </text>
                <img class="img-75 center" src="IMG/logo.png">
                <text class="headingtitle-white center">Priortize What Matters, Maximize Your Time</text>
            </div>
        </div>

        <?php 
            if(isset($_POST['login'])) {
                $sql = "SELECT * FROM users";
                $qry = mysqli_query($conn, $sql);
                $results = mysqli_fetch_all($qry, MYSQLI_ASSOC);
            
                $email = mysqli_real_escape_string($conn, $_POST['email']);
                $password = mysqli_real_escape_string($conn, $_POST['password']);
            
                foreach ($results as $result) {
            
                    if ($email == $result['email']) {
                        if($password == $result['passwrd']) {
                            $_SESSION["login"] = true;
                            $_SESSION["userinformation"] = array();
                            array_push($_SESSION["userinformation"], $result['email']);
                            array_push($_SESSION["userinformation"], $result['fullname']);
                            array_push($_SESSION["userinformation"], $result['passwrd']); 
                            break;
                        }
                        else {
                            $_SESSION["login"] = false;
                        }
                    }
                    else {
                        $_SESSION["login"] == false;
                    }
                }
                    
                if ($_SESSION["login"] == true) {
                    header("Location: index.php");
                        
                }
            
                if ($_SESSION["login"] == false) {
                    header("Location: login.php?login=unsuccessful");
                }
            }
        ?>


    </body>
</html>