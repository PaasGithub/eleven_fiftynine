<?php 
    require_once "../eleven_config/eleven_conn.php";
    include "../bstrap.html";  

    // Initialize the session
    session_start();

    $_SESSION['id']= $_GET['id'];
    $assid=$_SESSION['id'];

    // Check if the user is logged in, if not then redirect him to login page
    if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
        header("location: ../users/login.php");
    exit;
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel = 'stylesheet' href = '../style/styling.css'>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <title>Help</title>
</head>
<body>
    <?php
        if (ISSET($_GET['id'])){
            //write select query
            $checksql = "SELECT * FROM assignhelp_table WHERE assignment_iD=$assid";
            $checkresult = mysqli_query($conn, $checksql); 
            //echo (mysqli_num_rows($checkresult)>0);

            if(mysqli_num_rows($checkresult)>0){
                header("location: reassign_help.php?id=$assid");
            }
        
        }
    ?>

    <div class="content">
        <div class="page-header">
            <h1>Assign Help <small>ADMIN</small></h1>
        </div>
        <form method="POST" action="">

            <!--FI name -->
            <p>FI Name</p>
            <input type="text" name="FI_Name" class="text-input">

            <!--FI EMAIL -->
            <p>FI Email</p>
            <input type="text" name="FI_Email" class="text-input">

            <!--Writingcenter rep  -->
            <p>Writing Center Rep </p>
            <input type="text" name="wc_rep" class="text-input">

            <!--Writingcenter email -->
            <p>Writing Center Email </p>
            <input type="text" name="wc_email" class="text-input">

            <!--mathcenter rep email -->
            <p>Math Center Rep</p>
            <input type="text" name="mc_rep" class="text-input">

            <!--mathcenter rep email -->
            <p>Math Center Email </p>
            <input type="text" name="mc_email" class="text-input">

            <input type="submit" name="assignhelp_submit" value="Assign">
        </form>

        <?php 
            if(isset($_POST['assignhelp_submit'])){
                //echo $assid;

                //write select query
                $Selectsql = "SELECT ass_name FROM assignment WHERE assignment_id=$assid";
                $result = mysqli_query($conn, $Selectsql); 
                $row= mysqli_fetch_assoc($result);
                //echo $row['ass_name'];
                //write insert query 
                $assign_name= $row['ass_name'];
                $FIname= $_POST['FI_Name'];
                $FIemail= $_POST['FI_Email'];
                $wcRep=$_POST['wc_rep'];
                $wcEmail=$_POST['wc_email'];
                $mcRep=$_POST['mc_rep'];
                $mcEmail=$_POST['mc_email'];
                
                
                
                $sql = "INSERT INTO 
                assignhelp_table (ass_Name,Faculty_Intern,FI_email,writingCenterRep,
                writingCRepEmail,mathCenterRep,mathCRepEmail,assignment_iD) 
                VALUES ('$assign_name','$FIname','$FIemail','$wcRep',
                '$wcEmail','$mcRep','$mcEmail','$assid')";
                    
                //execute query
                if (mysqli_query($conn, $sql)) {
                    echo "Successfully assigned";
                } 
                else {
                    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
                }
            } 
        ?>
    </div>    

</body>
</html>