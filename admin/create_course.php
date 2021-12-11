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
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel = 'stylesheet' href = '../style/styling.css'>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">

    <title>Courses</title>
</head>
<body>


    <div class="content">
        <div class="page-header">
            <h1>Create Course <small>ADMIN</small></h1>
        </div>

        <div class="button-group">
            <a href="create_assignment.php" class="btn btn-big">Add Post</a>
            <a href="manage.php" class="btn btn-big">Manage Posts</a>
        </div>


        <form method="POST" action="">

            <!--course name -->
            <p>Course Name</p>
            <input type="text" name="courseName" class="text-input">

            <!--Lecturer name -->
            <p>Lecturer</p>
            <input type="text" name="lecturerName" class="text-input">    

            <!--FI name -->
            <p>Faculty Intern</p>
            <input type="text" name="FIname" class="text-input">           

            <!--credit-->
            <p>Credit</p>
            <input type="text" name="course_credit" class="text-input">

            <input type="submit" name="create_course" value="Create">

        </form>

        <?php 
            if(isset($_POST['create_course'])){
                //createAssignment("assign_Name","assign_date","due_date","enter_questions","marks");
                //write query 
                $course_name= $_POST['courseName'];
                $lecturer_name=$_POST['lecturerName'];
                $FI_name= $_POST['FIname'];
                $courseCredit= $_POST['course_credit'];

                $sql = "INSERT INTO 
                courseTable (course_name,lecturer,FI,Credit) 
                VALUES ('$course_name','$lecturer_name','$FI_name','$courseCredit')";
                    
                
                //execute query
                if (mysqli_query($conn, $sql)) {
                    echo "New record created successfully:";
                    echo $course_name;
                } 
                else {
                    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
                }
                
            }
        ?>

    </div>    
</body>
</html>