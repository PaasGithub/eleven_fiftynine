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
    $getAssID= $_SESSION['id'];

   
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel = 'stylesheet' href = '../style/styling.css'>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <title>Update</title>
</head>

<body>
    <div class=content>
    <div class="page-header">
            <h1>EDIT ASSIGNMENT <small>ADMIN</small></h1>
        </div>

        <form method="POST" action="">

            <!--assignment name -->
            <p>Assignmnet Name</p>
            <input type="text" name="assign_Name" class="text-input"
            value= 
                <?php 
            
                    //write query
                    $sql=  "SELECT * FROM assignment WHERE assignment_id = '$getAssID'";
                    $result = mysqli_query($conn, $sql);

                    if (mysqli_num_rows($result) > 0) {
                                        
                        while($row = mysqli_fetch_assoc($result)) {
                            echo $row["ass_name"];
                            
                        }
                    } 
                    else {
                        echo 'not found';
                    }
                    
                ?>
            >

            <!--assigned date -->
            <p>Assigned Date</p>
            <input data-format="DD-MM-YYYY" data-template="D MMM YYYY" name="assign_date" 
            value= 
                <?php 
                    

                    //write query
                    $sql=  "SELECT * FROM assignment WHERE assignment_id = '$getAssID'";
                    $result = mysqli_query($conn, $sql);

                    if (mysqli_num_rows($result) > 0) {
                                        
                        while($row = mysqli_fetch_assoc($result)) {
                            echo $row["assign_date"];
                            
                        }
                    } 
                    else {
                        echo 'not found';
                    }
                    
                ?>
            >
        

            <!--due date -->
            <p>Due Date</p>
            <input name="due_date" data-format="DD-MM-YYYY" data-template="D MMM YYYY"
            value=
                <?php 

                    //write query
                    $sql=  "SELECT * FROM assignment WHERE assignment_id = '$getAssID'";
                    $result = mysqli_query($conn, $sql);

                    if (mysqli_num_rows($result) > 0) {
                                        
                        while($row = mysqli_fetch_assoc($result)) {
                            echo $row["due_date"];
                            
                        }
                    } 
                    else {
                        echo 'not found';
                    }
                    
                ?>
            > 

                
            <!--Enter questions form-->
            <p>Questions:</p>
 
            <?php 

                //write query
                $sql=  "SELECT * FROM assignment WHERE assignment_id = '$getAssID'";
                $result = mysqli_query($conn, $sql);

                if (mysqli_num_rows($result) > 0) {
                                    
                    while($row = mysqli_fetch_assoc($result)) {
                        echo '<textarea name="enter_questions" cols="100" rows="10">'.$row["questions"].'</textarea>';
                        
                    }
                } 
                else {
                    echo 'not found';
                }
                
            ?>
      

            <!-- marks -->
            <p>Total Marks</p>
            <input type="int" name="marks" class="text-input"
            value=
                <?php 
                    $getAssID= $_SESSION['id'];

                    //write query
                    $sql=  "SELECT * FROM assignment WHERE assignment_id = '$getAssID'";
                    $result = mysqli_query($conn, $sql);

                    if (mysqli_num_rows($result) > 0) {
                                        
                        while($row = mysqli_fetch_assoc($result)) {
                            echo $row["total_marks"];
                            
                        }
                    } 
                    else {
                        echo 'not found';
                    }
                    
                ?>
            >

            <br>

            <input type="submit" name="update_assignment" value="Edit">
        </form>

        <?php
            if(isset($_POST['update_assignment'])){
                $edited_assignname= $_POST['assign_Name'];
                $edited_assignDate= $_POST['assign_date'];
                $edited_assignDue= $_POST['due_date'];
                $edited_assQuestions=$_POST['enter_questions'];
                $edited_assignMarks=$_POST['marks'];
                
                $updatesql = "UPDATE assignment SET ass_name='$edited_assignname',
                assign_date='$edited_assignDate',
                due_date='$edited_assignDue',
                questions='$edited_assQuestions',
                total_marks='$edited_assignMarks'
                WHERE assignment_id= '$getAssID' ";

                
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