<?php
    define('Joyful Paws',"Signup");
    
    if(isset($_SESSION['userId']))
    {
        header("Location: index.html");
        exit();
    }
?>
<html>
<head>
        <title>Registration Page</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="signup.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w==" crossorigin="anonymous" />
    <script src='https://www.google.com/recaptcha/api.js'></script>
</head>
<div id="contact">
    
    <?php
    
        $userName = '';
        $email = '';
    
        if(isset($_GET['error']))
        {
            if($_GET['error'] == 'emptyfields')
            {
                echo '<p class="closed">*Fill In All The Fields</p>';
                $userName = $_GET['uid'];
                $email = $_GET['mail'];
            }
            else if ($_GET['error'] == 'invalidmailuid')
            {
                echo '<p class="closed">*Please enter a valid email and user name</p>';
            }
            else if ($_GET['error'] == 'invalidmail')
            {
                echo '<p class="closed">*Please enter a valid email</p>';
            }
            else if ($_GET['error'] == 'invaliduid')
            {
                echo '<p class="closed">*Please enter a valid user name</p>';
            }
            else if ($_GET['error'] == 'passwordcheck')
            {
                echo '<p class="closed">*Passwords do not match</p>';
            }
            else if ($_GET['error'] == 'usertaken')
            {
                echo '<p class="closed">*This User name is already taken</p>';
            }
            else if ($_GET['error'] == 'sqlerror')
            {
                echo '<p class="closed">Website Error: Contact admin Tristan to have it fixed! Thank you!</p>';
            }
        }
        else if (isset($_GET['signup']) == 'success')
        {
            echo "<script>alert('Congratulations! Your account has been created successfully!')</script>";
                        echo "<script>window.open('signin.php', '_self')</script>";
        }
    ?>
	<div class="signup-form w3-animate-right">
    <form action="includes/signup.inc.php" method='post' id="contact-form" enctype="multipart/form-data">
		<div class="form-header">
				<h2>Registration</h2>
				<p>Please enter your email address, username, and password to create an account.</p>
		</div>
        <div class="form-group">
		<label>Username</label><br>
		<input class="form-control" type="text" id="name" name="uid" placeholder="Username" required value=<?php echo $userName; ?>>
		</div>
        <div class="form-group">
		<label>Email</label><br>
		<input class="form-control" type="email" id="email" name="mail" placeholder="email" required value=<?php echo $email; ?>>
		</div>
        <div class="form-group">
		<label>Password</label><br>
		<input class="form-control" type="password" id="pwd" name="pwd" placeholder="password" required>
		</div>
        <div class="form-group">
		<label>Confirm password</label><br>
		<input class="form-control" type="password" id="pwd-repeat" name="pwd-repeat" placeholder="repeat password" required>
        <div class="form-group"><br><br>
            <div class="g-recaptcha" data-sitekey="6LcVwqEaAAAAABVq65HcmdTITIpP61737esjMVel"></div>
        </div>
		</div><br>     
        <div class="form-group">
    		<button class="btn btn-primary btn-block btn-lg" type="submit" class="button next" name="signup-submit" required>
                <i class="fas fa-user-plus"></i> Sign up
            </button>
		</div>
        
    </form>
	<a href="signin.php" style="color:blue">Signin</a></div>';
	</div>
</div>
</body>
</html>