<?php 
    require_once "../eleven_config/eleven_conn.php";
    include "../bstrap.html";  

   // Initialize the session
  session_start();

  // Check if the user is logged in, if not then redirect him to login page
  if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: ../users/login.php");
    exit;
  }

    $_SESSION['id']= $_GET['id'];
    $assid=$_SESSION['id'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel = 'stylesheet' href = '../style/styling.css'>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <title>Re-Help</title>
</head>
<body>
    <div class="content">

        <div class="page-header">
            <h1>Reassign Help <small>ADMIN</small></h1>
        </div>

        <form method="POST" action="">

            <!--FI name -->
            <p>FI Name</p>
            <input type="text" name="FI_Name" class="text-input"
            value= 
                <?php
                    //write query
                    $sql=  "SELECT * FROM assignhelp_table WHERE assignment_iD = '$assid'";
                    $result = mysqli_query($conn, $sql);

                    if (mysqli_num_rows($result) > 0) {
                                        
                        while($row = mysqli_fetch_assoc($result)) {
                            echo $row["Faculty_Intern"];
                            
                        }
                    } 
                    
                ?>
            >

            <!--FI EMAIL -->
            <p>FI Email</p>
            <input type="text" name="FI_Email" class="text-input"
            value= 
                <?php
                    //write query
                    $sql=  "SELECT * FROM assignhelp_table WHERE assignment_iD = '$assid'";
                    $result = mysqli_query($conn, $sql);

                    if (mysqli_num_rows($result) > 0) {
                                        
                        while($row = mysqli_fetch_assoc($result)) {
                            echo $row["FI_email"];
                            
                        }
                    } 
                    
                ?>
            >

            <!--Writingcenter rep  -->
            <p>Writing Center Rep </p>
            <input type="text" name="wc_rep" class="text-input"
            value= 
                <?php
                    //write query
                    $sql=  "SELECT * FROM assignhelp_table WHERE assignment_iD = '$assid'";
                    $result = mysqli_query($conn, $sql);

                    if (mysqli_num_rows($result) > 0) {
                                        
                        while($row = mysqli_fetch_assoc($result)) {
                            echo $row["writingCenterRep"];
                            
                        }
                    } 
                    
                ?>
            >

            <!--Writingcenter email -->
            <p>Writing Center Email </p>
            <input type="text" name="wc_email" class="text-input"
            value= 
                <?php
                    //write query
                    $sql=  "SELECT * FROM assignhelp_table WHERE assignment_iD = '$assid'";
                    $result = mysqli_query($conn, $sql);

                    if (mysqli_num_rows($result) > 0) {
                                        
                        while($row = mysqli_fetch_assoc($result)) {
                            echo $row["writingCRepEmail"];
                            
                        }
                    } 
                    
                ?>
            >

            <!--mathcenter rep email -->
            <p>Math Center Rep</p>
            <input type="text" name="mc_rep" class="text-input"
            value= 
                <?php
                    //write query
                    $sql=  "SELECT * FROM assignhelp_table WHERE assignment_iD = '$assid'";
                    $result = mysqli_query($conn, $sql);

                    if (mysqli_num_rows($result) > 0) {
                                        
                        while($row = mysqli_fetch_assoc($result)) {
                            echo $row["mathCenterRep"];
                            
                        }
                    } 
                    
                ?>
            >

            <!--mathcenter rep email -->
            <p>Math Center Email </p>
            <input type="text" name="mc_email" class="text-input"
            value= 
                <?php
                    //write query
                    $sql=  "SELECT * FROM assignhelp_table WHERE assignment_iD = '$assid'";
                    $result = mysqli_query($conn, $sql);

                    if (mysqli_num_rows($result) > 0) {
                                        
                        while($row = mysqli_fetch_assoc($result)) {
                            echo $row["mathCRepEmail"];
                            
                        }
                    } 
                    
                ?>
            >

            <input type="submit" name="assignhelp_submit" value="Update">
        </form>

        <?php 
            if(isset($_POST['assignhelp_submit'])){
                echo $assid;
                //write update query
                $updatesql = "UPDATE assignhelp_table SET ass_Name='$assign_name',
                Faculty_Intern='$FIname',
                FI_email='$FIemail',
                writingCenterRep='$wcRep',
                writingCRepEmail='$wcEmail'
                mathCenterRep='$mcRep'
                mathCRepEmail='$mcEmail'
                WHERE assignment_iD= '$assid' ";

                //execute query
                if ($conn->query($updatesql) === TRUE) {
                    echo "Record updated successfully";
                    
                } 
                else {
                    echo "Error updating record: " . $conn->error;
                }
            } 
        ?>
    </div>
</body>
</html>