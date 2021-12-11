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
    $getcourseID= $_SESSION['id'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel = 'stylesheet' href = '../style/styling.css'>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <title>Edit</title>
</head>

<body>
    <div class=content>
        <div class="page-header">
            <h1>EDIT COURSE <small>ADMIN</small></h1>
        </div>

        <form method="POST" action="">

            <!--course name -->
            <p>Course Name</p>
            <input type="text" name="courseName" class="text-input"
            value= 
                <?php 
            
                    //write query
                    $sql=  "SELECT * FROM courseTable WHERE course_name = '$getcourseID'";
                    $result = mysqli_query($conn, $sql);

                    if (mysqli_num_rows($result) > 0) {
                                        
                        while($row = mysqli_fetch_assoc($result)) {
                            echo $row["course_name"];
                            
                        }
                    } 
                    else {
                        echo 'not found';
                    }
                    
                ?>
            >

            <!--Lecturer name -->
            <p>Lecturer</p>
            <input type="text" name="lecturerName" class="text-input"
            value= 
                <?php 
                    

                    //write query
                    $sql=  "SELECT * FROM courseTable WHERE course_name = '$getcourseID'";
                    $result = mysqli_query($conn, $sql);

                    if (mysqli_num_rows($result) > 0) {
                                        
                        while($row = mysqli_fetch_assoc($result)) {
                            echo $row["lecturer"];
                            
                        }
                    } 
                    else {
                        echo 'not found';
                    }
                    
                ?>
            >
        

            <!--FI name -->
            <p>Faculty Intern</p>
            <input type="text" name="FIname" class="text-input"
            value=
                <?php 

                    //write query
                    $sql=  "SELECT * FROM courseTable WHERE course_name = '$getcourseID'";
                    $result = mysqli_query($conn, $sql);

                    if (mysqli_num_rows($result) > 0) {
                                        
                        while($row = mysqli_fetch_assoc($result)) {
                            echo $row["FI"];
                            
                        }
                    } 
                    else {
                        echo 'not found';
                    }
                    
                ?>
            > 

            <!--credit-->
            <p>Credit</p>
            <input type="text" name="course_credit" class="text-input"
            value=
                <?php 

                    //write query
                    $sql=  "SELECT * FROM courseTable WHERE course_name = '$getcourseID'";
                    $result = mysqli_query($conn, $sql);

                    if (mysqli_num_rows($result) > 0) {
                                        
                        while($row = mysqli_fetch_assoc($result)) {
                            echo $row["Credit"];
                            
                        }
                    } 
                    else {
                        echo 'not found';
                    }
                    
                ?>
            > 

            <br>

            <input type="submit" name="update_course" value="Edit">
        </form>

        <?php
            if(isset($_POST['update_course'])){
                $edited_coursename= $_POST['courseName'];
                $edited_lecturer= $_POST['lecturerName'];
                $edited_FI= $_POST['FIname'];
                $edited_credit=$_POST['course_credit'];
                
                $updatesql = "UPDATE courseTable SET course_name='$edited_coursename',
                lecturer='$edited_lecturer',
                FI='$edited_FI',
                Credit='$edited_credit'
                WHERE course_name= '$getcourseID' ";

                
                if ($conn->query($updatesql) === TRUE) {
                    echo "Record updated successfully";
                    
                } 
                else {
                    echo "Error updating record: " . $conn->error;
                }
            } 
        ?>

        <div class="button-group">
            <a href="manage.php" class="btn btn-big">Manage Posts</a>
        </div>

    </div>
    
</body>
</html>