<?php

if (isset($_POST['login-submit']))
{    
    require 'dbh.inc.php';
    
    $mailuid = $_POST['mailuid'];
    $password = $_POST['pwd'];
    
    if (empty($mailuid) || empty($password))
    {
        header("Location: ../signin.php?error=emptyfields");
        exit();
    }
    else
    {
        $sql = "SELECT * FROM users WHERE user_name=?;";
        $stmt = mysqli_stmt_init($conn);
        
        if (!mysqli_stmt_prepare($stmt, $sql))
        {
            header("Location: ../signin.php?error=sqlerror");
            exit();
        }
        else
        {
            mysqli_stmt_bind_param($stmt, "s", $mailuid);
            mysqli_stmt_execute($stmt);
            
            $result = mysqli_stmt_get_result($stmt);
            
            if($row = mysqli_fetch_assoc($result))
            {                
                $pwdCheck = password_verify($password, $row['user_pwd']);
                if ($pwdCheck == false)
                {
                    header("Location: ../signin.php?error=wrongpwd");
                    exit();
                }
                else if($pwdCheck == true)
                {
                    session_start();
                    $_SESSION['userId'] = $row['user_id'];
                    $_SESSION['userUid'] = $row['user_name'];
                    $_SESSION['emailUsers'] = $row['user_email'];
                    
                    header("Location: ../signin.php?login=success");
                    exit();
                }
                else
                {
                    header("Location: ../signin.php?error=wrongpwd");
                    exit();
                }
            }
            else
            {
                header("Location: ../signin.php?error=nouser");
                exit();
            }
        }
    }
}
 else 
{
    header("Location: ../signin.php");
    exit();
}