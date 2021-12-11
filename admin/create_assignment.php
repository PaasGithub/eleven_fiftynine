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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <title>Create</title>
</head>

<body>

    <div class="content">
        <div class="page-header">
            <h1>Create Assignment <small>ADMIN</small></h1>
        </div>

        <div class="button-group">
            <a href="create_course.php" class="btn btn-big">Add Course</a>
            <a href="manage.php" class="btn btn-big">Manage Posts</a>
        </div>

        <form method="POST" action="">

            <!-- create course form. -->
            <p>Course</p>
            <input type="text" name="assignCourse" class="text-input">

            <!--assignment name -->
            <p>Assignmnet Name</p>
            <input type="text" name="assign_Name" class="text-input">

            <!--assigned date -->
            <p>Assigned Date</p>
            <input data-format="DD-MM-YYYY" data-template="D MMM YYYY" name="assign_date" value="09-01-2013">
           

            <!--due date -->
            <p>Due Date</p>
            <input name="due_date" value="15-05-1984" data-format="DD-MM-YYYY" data-template="D MMM YYYY"> 

                 
            <!--Enter questions form-->
            <p>Questions:</p>
            <textarea name="enter_questions" cols="100" rows="10"></textarea >

            <!-- marks -->
            <p>Total Marks</p>
            <input type="int" name="marks">

            <br>

            <input type="submit" name="create_assignment" value="Create">


        </form>

  
        <?php 
            if(isset($_POST['create_assignment'])){
                //createAssignment("assign_Name","assign_date","due_date","enter_questions","marks");
                //write query 
                $assign_course= $_POST['assignCourse'];
                $assign_name= $_POST['assign_Name'];
                $assignDate= $_POST['assign_date'];
                $assignDue= $_POST['due_date'];
                $assignQuestions=$_POST['enter_questions'];
                $assignMarks=$_POST['marks'];

                $sql = "INSERT INTO 
                assignment (course,ass_name,assign_date,due_date,questions,total_marks) 
                VALUES ('$assign_course','$assign_name','$assignDate','$assignDue','$assignQuestions','$assignMarks')";
                    
                //execute query
                if (mysqli_query($conn, $sql)) {
                    echo "New record created successfully:";
                    echo $assign_name;
                    
                } 
                else {
                    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
                }
            }
        ?>
        

    </div>    

    
</body>
</html>