<?php 
    require_once "../eleven_config/eleven_conn.php";
    include "../bstrap_users.html";

    // Initialize the session
  session_start();

  // Check if the user is logged in, if not then redirect him to login page
  if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
  }
    $_SESSION['id']= $_GET['id'];
    

    if(ISSET($_GET['id'])){
        $getID= $_SESSION['id'];
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
    <title>Post</title>
</head>

<body>
    <!-- print out assignmnet name and questions   -->
    <?php
        //echo $getID;
        $assignment= array();

        //write query
        $sql = "SELECT * FROM assignment WHERE assignment_id = '$getID'";
        $result = mysqli_query($conn, $sql);
            
        
        while($post = mysqli_fetch_assoc($result)) 
        {$assignment[] = $post;
        }
        foreach ($assignment as $post)
        :
    ?>


    <div class="content">

        <h1 class="post-title"><?php echo $post['ass_name']; ?></h1>
        <div class = 'post-content'>
        <p>
        <?php echo html_entity_decode($post['questions']);?></p>
        </div>

            
        <?php endforeach;?>

    </div>   

    
    <div class="post-title">
        <h1>View Components </h1>
    </div>
    

    <div class="table2position">

        <!-- viVIEW COMPONENTS-->
        <table class="table2">
            <thead>
                <th>Figures </th>
                <th>Tables</th>
                <th>Reasearch</th>
                <th>References</th>
            </thead>

            <tbody>
                <?php
                    $components= array();

                    //write query
                    $sql = "SELECT * FROM components_Table WHERE assignmentID='$getID' ";
                    $result = mysqli_query($conn, $sql);
                        
                    
                    while($row = mysqli_fetch_assoc($result)) 
                    {$components[] = $row;
                    }
                    foreach ($components as $row)
                    :
                ?>

                    <tr>
                        <td><?php echo $row['figures']; ?></td>
                        <td><?php echo $row['numTables']; ?></td>
                        <td><?php echo $row['research']; ?></td>
                        <td><?php echo $row['include_references']; ?></td>
                    </tr>
                <?php endforeach;?>
                
            </tbody>
        </table>
        <!--END view COMPONENTS-->
    </div>

        <!--COMPONENTS table for progress-->
        <div class="post-title">
            <h1>Progress</h1>
        </div>

    <div class="table2position">
        <table class="table2">
            <thead>
                <th>Components</th>  
                <th>Completed</th>
            </thead>

            <tbody>
                <?php
                    $tableHeading=array("Figures","Table","Reserach","References");
                    foreach ($tableHeading as $row)
                    :
                ?>

                <tr>
                    <td><?php echo $row ?></td>
                    <td><input type = "checkbox" id="check" /> </td>
                </tr>    
                <?php endforeach;?>


            </tbody>
        </table>
    </div>
</body>
</html>
