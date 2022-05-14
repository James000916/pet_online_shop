<?php

    session_start();
    require 'dbh.inc.php';

    $companyName = "Joyful Paws";
    
    function strip_bad_chars( $input ){
        $output = preg_replace( "/[^a-zA-Z0-9_-]/", "", $input);
        return $output;
    }
?>  

<!DOCTYPE html>

<html>
    <head>
        <title><?php echo TITLE; ?></title>
        <link href="includes/styles.css" rel="stylesheet"> 
        <link rel="shortcut icon" href="" />
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w==" crossorigin="anonymous" />
        <script src='https://www.google.com/recaptcha/api.js'></script>
    </head>
    <body id="final-example" style="background-color: #ffbe85;">
        
    <!-------     LOGIN / LOGOUT FORM               --------->
    
    <?php 
    
    if(isset($_SESSION['userId']))
    {
        echo '<img id="status" src="">';
    }
    else
    {
        echo '<img id="status" src="">';
    }
    
    ?>
        
    <div id="login">
        
        <?php 
            
            if(isset($_SESSION['user_name']))
            {
                echo'<div style="text-align: center;">
	        <a href="index.html" class="button login">Home</a>
                        <a href="includes/logout.inc.php" class="button login">Logout</a>
                    </div>';
            }
            else
            {
                if(isset($_GET['error']))
                {
                    if($_GET['error'] == 'emptyfields')
                    {
                        echo '<p class="closed">*please fill in all the fields</p>';
                    }
                    else if($_GET['error'] == 'nouser')
                    {
                        echo '<p class="closed">*username does not exist</p>';
                    }
                    else if ($_GET['error'] == 'wrongpwd')
                    {
                        echo '<p class="closed">*wrong password</p>';
                    }
                    else if ($_GET['error'] == 'sqlerror')
                    {
                        echo '<p class="closed">Website Error: Contact admin Tristan to have it fixed! Thank you!</p>';
                    }
                }

                echo '<div class="login-form w3-animate-left">
                <form method="post" action="includes/login.inc.php" id="login-form">
					<div class="form-header">
					<h2>Welcome!</h2>
					<p>Please enter your email address and password to login.</p>
					</div>
                    <div class="form-group"><label>Username</label><input class="form-control" type="text" id="name" name="mailuid" placeholder="Username..." required></div>
                    <div class="form-group"><label>Password</label><input class="form-control" type="password" id="password" name="pwd" placeholder="Password..." required></div>
                    <div class="form-group"><br>
                        <div class="g-recaptcha" data-sitekey="6LcVwqEaAAAAABVq65HcmdTITIpP61737esjMVel"></div>
                    </div><br>
                    <div class="form-group"><button class="btn btn-success btn-block btn-lg" type="submit" name="login-submit" value="Login"><i class="fas fa-lock"></i> Sign in</button></div>
                </form>
                <a href="signup.php" style="color:blue">Signup</a></div>';               
            }
        ?>

    </div>
    
    <!-------     LOGIN / LOGOUT FORM END           --------->
        <div class="wrapper">
            <div class="content">