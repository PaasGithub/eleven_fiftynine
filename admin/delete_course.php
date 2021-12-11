<?php
    // Initialize the session
    session_start();

  // Check if the user is logged in, if not then redirect him to login page
  if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: ../users/login.php");
    exit;
  }
    $_SESSION['id']= $_GET['delete_id'];
    $getcourseID= $_SESSION['id'];

    require_once "../eleven_config/eleven_conn.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel = 'stylesheet' href = '../style/styling.css'>
    <title>Delete Course</title>
</head>
<body>
    
    <div class="content">
        <h1> Delete Status </h1>
        <div class="button-group">
            <a href="create_assignment.php" class="btn btn-big">Add Post</a>
            <a href="manage.php" class="btn btn-big">Manage Posts</a>
        </div>
        
        <br>

        <?php
            if(ISSET($_GET['delete_id'])){
                
                //$getID= $GET['delete_id'];
                //write query
                $delsearchsql=  "SELECT * FROM courseTable WHERE course_ID = '$getcourseID'";
                $delsql=  "DELETE FROM courseTable WHERE course_ID= '$getcourseID'";
                $delsearchResult = mysqli_query($conn, $delsearchsql);
                $delResult = mysqli_query($conn, $delsql);

                if (mysqli_num_rows($delsearchResult) > 0) {
                    if ($delResult) {
                        echo "Record deleted successfully";
                    } 
                    else {
                        echo "Error deleting record: " . mysqli_error($conn);
                    }
                }

                else{
                    echo "Not found.";
                }
            }
        ?>
    </div>
</body>
</html>