<?php 
    require_once "../eleven_config/eleven_conn.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel = 'stylesheet' href = '../style/signin_login.css'>
   
    <title>Sign-Up</title>
</head>

<body>
    <div class= "entry_content">
        <div class="sign_logInheader">
            <h1>Sign-Up </h1>
        </div>

        <form method="POST" action="">
            <!-- create username form. -->
            <h4>Name</h4>
            <input type="text" name="username" class="text-input" required>

            <!-- create Email form. -->
            <h4>Email</h4>
            <input type="text" name="email" class="text-input" required>

            <!-- create Password form. -->
            <h4>Password</h4>
            <input type="password" name="passcode" class="text-input" id="psw" 
            pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" required>

            <input type="submit" name="submitSignIn" class="sub_button" value="Sign-Up">
            <p>Already have an account? <a href = 'login.php'>Log In </a> </p>
        <form>

       
    </div>

    
    <div id="message">
        <h3>Password must contain the following:</h3>
        <p id="letter" class="invalid">A <b>lowercase</b> letter</p>
        <p id="capital" class="invalid">A <b>capital (uppercase)</b> letter</p>
        <p id="number" class="invalid">A <b>number</b></p>
        <p id="length" class="invalid">Minimum <b>8 characters</b></p>
    </div>
  

    <?php
        if(isset($_POST['submitSignIn'])){
            //createAssignment("assign_Name","assign_date","due_date","enter_questions","marks");
            //write query 
            $name= $_POST['username'];
            $e_mail= $_POST['email'];
            $pass= password_hash($_POST['passcode'],PASSWORD_BCRYPT);

            $usernameerror ='';
            $emailerror = '';

            //Validate Username
            $namequery = "SELECT * FROM eleven_users WHERE username='$name'";
            $emailquery = "SELECT * FROM eleven_users WHERE email='$e_mail'";
            $checknameresult = mysqli_query($conn, $namequery); 
            $checkemailresult = mysqli_query($conn, $emailquery); 
            //echo (mysqli_num_rows($checkresult)>0);

            if(mysqli_num_rows($checknameresult)>0){
                echo "The username is already registered";
            }

            // VAlidate Email
            elseif(mysqli_num_rows($checkemailresult)>0){
                echo "This email already exists!";
            }
            
            else{
                //insert into elevenuser database
                $sql = "INSERT INTO 
                eleven_users (username,email,passcode,is_admin) 
                VALUES ('$name','$e_mail','$pass','0')";
                    
                //execute query
                if (mysqli_query($conn, $sql)) {
                    header("location: login.php");
                    
                } 
                else {
                    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
                }
            }
        }
    ?>

    <!--password vlaidation js-->
    <script>
    var myInput = document.getElementById("psw");
    var letter = document.getElementById("letter");
    var capital = document.getElementById("capital");
    var number = document.getElementById("number");
    var length = document.getElementById("length");

    // When the user clicks on the password field, show the message box
    myInput.onfocus = function() {
    document.getElementById("message").style.display = "block";
    }

    // When the user clicks outside of the password field, hide the message box
    myInput.onblur = function() {
    document.getElementById("message").style.display = "none";
    }

    // When the user starts to type something inside the password field
    myInput.onkeyup = function() {
    // Validate lowercase letters
    var lowerCaseLetters = /[a-z]/g;
    if(myInput.value.match(lowerCaseLetters)) { 
        letter.classList.remove("invalid");
        letter.classList.add("valid");
    } else {
        letter.classList.remove("valid");
        letter.classList.add("invalid");
    }

    // Validate capital letters
    var upperCaseLetters = /[A-Z]/g;
    if(myInput.value.match(upperCaseLetters)) { 
        capital.classList.remove("invalid");
        capital.classList.add("valid");
    } else {
        capital.classList.remove("valid");
        capital.classList.add("invalid");
    }

    // Validate numbers
    var numbers = /[0-9]/g;
    if(myInput.value.match(numbers)) { 
        number.classList.remove("invalid");
        number.classList.add("valid");
    } else {
        number.classList.remove("valid");
        number.classList.add("invalid");
    }

    // Validate length
    if(myInput.value.length >= 8) {
        length.classList.remove("invalid");
        length.classList.add("valid");
    } else {
        length.classList.remove("valid");
        length.classList.add("invalid");
    }
    }
    </script>
    
</body>
</html>