<?php 
    if(session_id()) {
        echo "";
    }
    else {
        session_start();
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

<?php 
    if(isset($_SESSION['login'])) {
        if($_SESSION['login'] == false) {
            header("Location: login.php");

        }
        if($_SESSION['login'] == true) {
?>

    <div class="headbar backgroundblack">
        <img src="IMG/logo.png" class="img-65">   
        <a href="index.php" class="headingtitle-white centervertically sidetosidepadding linkstyleremove">VentureAnalytica</a>
        <form class="grid" method="POST">
            <button name="logout" type="submit" class="buttonstyleremove backgrounddarkblue normaltext-white center sidetosidepadding toppadding bottompadding buttondark">Log Out</button>
        </form>   
    </div>

<?php  
        }
    } else {
        header("Location: login.php");
    }

    if(isset($_POST['logout'])) {
        header("Location: login.php");
        session_unset();
    }
?>