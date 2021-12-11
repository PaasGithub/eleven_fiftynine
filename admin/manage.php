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
    <title>Manage</title>
</head>

<body>
    <div class=content>

        <h2>Courses</h2>
        <table class="table">
            <thead>
                <th>Course Name</th>
                <th>Lecturer</th>
                <th>Credit</th>
                <th colspan="2">Action</th>
            </thead>

            <tbody>
                <?php
                    $courses= array();

                    //write query
                    $sql = "SELECT * FROM courseTable";
                    $result = mysqli_query($conn, $sql);
                        
                    
                    while($row = mysqli_fetch_assoc($result)) 
                    {$courses[] = $row;
                    }
                    foreach ($courses as $row)
                    :
                ?>

                    <tr>
                        <td><?php echo $row['course_name']; ?></td>
                        <td><?php echo $row['lecturer']; ?></td>
                        <td><?php echo $row['Credit']; ?></td>
                        <td><a href="edit_course.php?id=<?php echo $row['course_name']; ?>" class="edit">edit</a></td>
                        <td>
                            <a onclick="return confirm('Record will be deleted. Proceed?');" href="delete_course.php?delete_id=<?php echo $row['course_ID']; ?>" class="delete">delete</a>
                            <!-- <input type="button" name="del_assignment" value="delete"> -->
                        </td>
                    </tr>
                <?php endforeach;?>
                
            </tbody>
        </table>

        <div class="button-group">
            <a href="create_course.php" class="btn btn-big">Add Course</a>
        </div>
        <br>

 <!--ASSIGNMENT  TABLE-->
        <h2>Assignments</h2>
        <table class="table">
            <thead>
                <th>Assignmnet Name</th>
                <th>Course</th>
                <th>Due Date</th>
                <th>Total Marks</th>
                <th colspan="2">Action</th>
            </thead>

            <tbody>
                <?php
                    $assignments= array();

                    //write query
                    $sql = "SELECT * FROM assignment";
                    $result = mysqli_query($conn, $sql);
                        
                    
                    while($row = mysqli_fetch_assoc($result)) 
                    {$assignments[] = $row;
                    }
                    foreach ($assignments as $row)
                    :
                ?>

                    <tr>
                        <td><?php echo $row['ass_name']; ?></td>
                        <td><?php echo $row['course']; ?></td>
                        <td><?php echo $row['due_date']; ?></td>
                        <td><?php echo $row['total_marks']; ?></td>
                        <td><a href="edit.php?id=<?php echo $row['assignment_id']; ?>" class="edit">edit</a></td>
                        <td>
                            <a onclick="return confirm('Record will be deleted. Proceed?');" 
                            href="delete.php?delete_id=<?php echo $row['assignment_id']; ?>" class="delete">delete</a>
                            <!-- <input type="button" name="del_assignment" value="delete"> -->
                        </td>
                    </tr>
                <?php endforeach;?>
                
            </tbody>
        </table>

        <div class="button-group">
            <a href="create_assignment.php" class="btn btn-big">Add Posts</a>
        </div>
        <br>
        
        <h2>Assign Help<h2>
        <table class="table">
            <thead>
                <th>Assignmnet Name</th>
                <th>ASSIGNED</th>
                <th>Action</th>
            </thead>
            <tbody>
                <?php
                    $assignments= array();

                    //write query
                    $sql = "SELECT * FROM assignment";
                    $result = mysqli_query($conn, $sql);
                    
                    while($row = mysqli_fetch_assoc($result)) 
                    {$assignments[] = $row;
                    }
                    foreach ($assignments as $row)
                    :
                ?>

                    <tr>
                        <td><?php echo $row['ass_name']; ?></td>
                        <td>
                            <?php
                                //write query
                                $AssignmnetName=$row['ass_name'];
                                $helpsql = "SELECT * FROM assignhelp_table WHERE ass_Name='$AssignmnetName'";
                                $helpresult= mysqli_query($conn,$helpsql);

                                if (mysqli_num_rows($helpresult) > 0) {
                                    echo "Yes";
                                }
                                else{
                                    echo "No";
                                }
                            ?>
                        </td>
                        <td><a href="assign_help.php?id=<?php echo $row['assignment_id']; ?>" 
                        class="assignHelp">Assign</a></td>
                    </tr>
                <?php endforeach;?>
            </tbody>
        </table>

        <br>

        <!--ASSIGN COMPONENTS TABLE-->
        <h2>Assign Components<h2>
        <table class="table">
            <thead>
                <th>Assignmnet Name</th>
                <th>ASSIGNED</th>
                <th colspan="2">Action</th>
            </thead>
            <tbody>
                <?php
                    $assignments= array();

                    //write query
                    $assignsql = "SELECT * FROM assignment";
                    $assignresult = mysqli_query($conn, $assignsql);
                    
                    while($assignrow = mysqli_fetch_assoc($assignresult)) 
                    {$assignments[] = $assignrow;
                    }
                    foreach ($assignments as $assignrow)
                    :
                ?>

                    <tr>
                        <td><?php echo $assignrow['ass_name']; ?></td>
                        <td>
                            <?php
                                //write query
                                $AssignmnetID=$assignrow['assignment_id'];
                                $compsql = "SELECT * FROM components_Table WHERE assignmentID='$AssignmnetID'";
                                $compresult= mysqli_query($conn,$compsql);

                                if (mysqli_num_rows($compresult) > 0) {
                                    echo "Yes";
                                }
                                else{
                                    echo "No";
                                }
                            ?>
                        </td>
                        <td><a href="assign_components.php?id=<?php echo $assignrow['assignment_id']; ?>" 
                        class="assignHelp">Assign</a></td>
                        <td><a href="reassign_components.php?id=<?php echo $assignrow['assignment_id']; ?>" 
                        class="assignHelp">Reassign</a></td>
                    </tr>
                <?php endforeach;?>
            </tbody>
        </table>
       
    </div>
</body>
</html>

