<?php
include_once 'database.php';

    if(session_id()) {
        echo "";
    }
    else {
        session_start();
    }
    
$error2 = 0;

    if(isset($_POST['email1'])){
        $email = $_POST['email1'];
        if(filter_var($email, FILTER_VALIDATE_EMAIL)) {
            echo "";
        }
        else {
            echo "Email is invalid";
            $error2 += 1;
        }

        $sql = "SELECT email FROM users ORDER BY id ASC";
        $qry = mysqli_query($conn, $sql);
        $emailres = mysqli_fetch_all($qry, MYSQLI_ASSOC);        

        foreach ($emailres as  $emailr){
            if ($email == $emailr['email']){
                echo "Email is already taken";
                $error2 += 1;
            }
        }
    }

    if(isset($_POST['password1'])) {
        $error = 0;
        $message = "Minimum length is 8<br> Need 1 symbol: #,-,?,),(,*,@<br>Need 1 capital letter<br>";
        $password = $_POST['password1'];
        if (strlen($password)<8) {
            if ($error==0) {
                echo $message;
                $error = 1;
                $error2 += 1;
            }
        }
        $symbolarr = ['#','_','?',')','(','*','@', ','];
        $snum = 0;
        foreach ($symbolarr as $symbol) {
            $sinclusion = str_contains($password, $symbol);
            if ($sinclusion == true) {
                $snum += 1;
            }
        }
        if($snum == 0) {
            if ($error==0){
                echo $message;
                $error = 1;
                $error2 += 1;
            }
        }
        if(strtolower($password) == $password){
            if ($error==0){
                echo $message;
                $error =1;
                $error2 += 1;
            }
        }
    }

    if(isset($_POST['repassword1'])) {
        if(isset($_POST['password1'])){
            $password = $_POST['password1'];
            $repassword = $_POST['repassword1'];
            if($password != $repassword) {
                echo "|.|Passwords do not match";
                $error2 += 1;
            }
        }
        else {
            $error2 += 1;
        }
    }

    if(isset($_POST['signup'])){
        if ($error2>0) {
            $_SESSION['signup'] = false;
            header("Location: signup.php?error=Did not meet all signup requirements");
        }
        else {
            $_SESSION['signup'] = true;
            $email = mysqli_real_escape_string($conn, $_POST['email1']);
            $fullname = mysqli_real_escape_string($conn, $_POST['fullname']);
            $password = mysqli_real_escape_string($conn, $_POST['password1']);

            $sql = "INSERT INTO users(email, fullname, passwrd) VALUES('$email', '$fullname', '$password');";
            mysqli_query($conn, $sql);
            header("Location: login.php?successful=Thanks for signing up!");
        }
    }