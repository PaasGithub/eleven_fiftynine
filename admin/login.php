<?php
    require_once "../eleven_config/eleven_conn.php";
    // Check if the user is already logged in, if yes then redirect him to welcome page
    if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
        header("location: index.php");
    exit;
    }
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel = 'stylesheet' href = '../style/signin_login.css'>
   
    <title>Log-In</title>
</head>

<body>
    <div class= "entry_content">

        <div class="sign_logInheader">
            <h1>Login </h1>
        </div>

        <form method="POST" action="">
            <!-- create username form. -->
            <p>Name</p>
            <input type="text" name="username" class="text-input" required>


            <!-- create Password form. -->
            <p>Password</p>
            <input type="password" name="passcode" class="text-input" id="psw" 
            pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" required>

            <input type="submit" name="submitLogIn" class="sub_button" value="Log-In">
            <p>Do not have an account? <a href = 'signin.php'>Sign Up</a> </p>
        </form>
    </div>

    <?php
        if(isset($_POST['submitLogIn'])){
            //createAssignment("assign_Name","assign_date","due_date","enter_questions","marks");
            //write query 
            $name= $_POST['username'];
            $pass= $_POST['passcode'];

            //Validate Username
            $namequery = "SELECT * FROM eleven_users WHERE username='$name' ";
            $passwordquery = "SELECT passcode FROM eleven_users WHERE username='$name' ";
            $checknameresult = mysqli_query($conn, $namequery); 
            $checkpassresult = mysqli_query($conn, $passwordquery); 
            $row= mysqli_fetch_assoc($checkpassresult) ;
            $allinforow=mysqli_fetch_assoc($checknameresult) ;
            //echo (mysqli_num_rows($checkresult)>0);
            //mysqli_num_rows($checkpassresult)==0
            //echo $row['passcode'];
            
            if(mysqli_num_rows($checknameresult)==0){
                echo "Username or password is wrong.";
            }

            // VAlidate Email
            else if(password_verify($pass,$row['passcode'])){
                header("location: index.php");    
                // Password is correct, so start a new session
                session_start();
                            
                // Store data in session variables
                $_SESSION["loggedin"] = true;
                //$_SESSION["id"] = $allinforow['user_id'];
                $_SESSION["username"] = $name;  
            }
            
            else{
                echo "username or Password is wrong.";  
            }
        }  
    ?>
</body>
