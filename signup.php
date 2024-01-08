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
        <style>
            body {
                background:#000010; 
            }
        </style>

        <script>
            $(document).ready(function(){
                $("input[name='email1']").keyup(function(){
                    var email1 = $("input[name='email1']").val();
                    $.post("validation.php", {email1: email1}, function(data, status){
                        $("#signupemailerror").html(data);
                    });
                });
                $("input[name='password1']").keyup(function(){
                    var password1 = $("input[name='password1']").val();
                    console.log('ff')
                    $.post("validation.php", {password1: password1}, function(data, status){
                        $("#signuppassworderror").html(data);
                    });
                });
                $("input[name='repassword1']").keyup(function(){
                    var repassword1 = $("input[name='repassword1']").val();
                    var password1 = $("input[name='password1']").val();
                    console.log(password1)
                    $.post("validation.php", {repassword1: repassword1, password1: password1}, function(data, status){
                        repassworderror = data.split("|.|");
                        $("#signuprepassworderror").html(repassworderror[1]);
                    });
                });
            });
        </script>

        <div class="logsplit">
            <div class="logingrid">
                <div></div>
                <div class="grid">
                    <br>
                    <div>
                        <text class="smallheading-white">Sign Up</text>
                        <br><br>
                        <form class="grid gap-r-15" action="validation.php" method="POST">
                            <div class="grid gap-r-7">
                                <div class="grid">
                                    <input class="inputfield styleremove" placeholder="First Name and Last Name" name="fullname" type="text"> 
                                    <p id="fullnameerror" class="smalltext-error highlight"></p>
                                </div>
                                <div class="grid">
                                    <input class="inputfield styleremove" placeholder="Email" name="email1" type="text"> 
                                    <p id="signupemailerror" class="smalltext-error highlight"></p>
                                </div>
                                <div class="grid">
                                    <input class="inputfield styleremove" placeholder="Password" name="password1" type="password"> 
                                    <p id="signuppassworderror" class="smalltext-error highlight"></p>
                                </div>
                                <div class="grid">
                                    <input class="inputfield styleremove" placeholder="Retype Password" name="repassword1" type="password"> 
                                    <p id="signuprepassworderror" class="smalltext-error highlight"></p>
                                </div>
                            </div>
                            <button type="submit" name="signup" class="buttonstyleremove backgrounddarkblue normal-bold-white sidetosidepadding toppadding bottompadding buttondark">Sign Up</button>
                            <?php if(isset($_GET['error'])) {?>
                                    <div class="smallheading highlight center"><?php echo $_GET['error']?></div>
                            <?php }?>
                            <text class="white smalltext">Have an account?<a href="login.php" class="linkcolor linkstyleremove smalltext buttonicondark"> Login in</a></text>
                        </form>
                    </div>
                </div>
                <div></div>
            </div>
            <div class="grid">
                <br><br>
                <text class="heading-white center"><span class="goodletter">W</span>elcome to VentureAnal<span class="goodletter">y</span>tica!</text>
                <img class="img-75 center" src="IMG/logo.png">
                <text class="headingtitle-white center">Priortize What Matters, Maximize Your Time</text>
            </div>
        </div>
    </body>
</html>