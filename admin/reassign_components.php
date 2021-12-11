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
    <title>Re-Components</title>
</head>
<body>
    <div class="content">

        <div class="page-header">
            <h1>Reassign Components <small>ADMIN</small></h1>
        </div>

        <form method="POST" action="">

            <!--Number of Figures -->
            <p>Number of Figures</p>
            <input type="text" name="figNum" class="text-input"
            value= 
                <?php
                    //write query
                    $sql=  "SELECT * FROM components_Table WHERE assignmentID = '$assid'";
                    $result = mysqli_query($conn, $sql);

                    if (mysqli_num_rows($result) > 0) {
                                        
                        while($row = mysqli_fetch_assoc($result)) {
                            echo $row["figures"];
                            
                        }
                    } 
                    
                ?>
            >

            <!--Number of Tables -->
            <p>Number of Tables</p>
            <input type="text" name="tableNum" class="text-input"
            value= 
                <?php
                    //write query
                    $sql=  "SELECT * FROM components_Table WHERE assignmentID = '$assid'";
                    $result = mysqli_query($conn, $sql);

                    if (mysqli_num_rows($result) > 0) {
                                        
                        while($row = mysqli_fetch_assoc($result)) {
                            echo $row["numTables"];
                            
                        }
                    } 
                    
                ?>
            >

            <!--Research -->
            <p>Include Research </p>
            <input type="text" name="inc_research" class="text-input" placeholder="YES/NO"
            value= 
                <?php
                    //write query
                    $sql=  "SELECT * FROM components_Table WHERE assignmentID = '$assid'";
                    $result = mysqli_query($conn, $sql);

                    if (mysqli_num_rows($result) > 0) {
                                        
                        while($row = mysqli_fetch_assoc($result)) {
                            echo $row["research"];
                            
                        }
                    } 
                    
                ?>
            >

            <!--References -->
            <p>Include References </p>
            <input type="text" name="inc_references" class="text-input" placeholder="YES/NO"
            value= 
                <?php
                    //write query
                    $sql=  "SELECT * FROM components_Table WHERE assignmentID = '$assid'";
                    $result = mysqli_query($conn, $sql);

                    if (mysqli_num_rows($result) > 0) {
                                        
                        while($row = mysqli_fetch_assoc($result)) {
                            echo $row["include_references"];
                            
                        }
                    } 
                    
                ?>
            >

            <!--Maximum pages -->
            <p>Max Pages </p>
            <input type="text" name="maxi_pages" class="text-input"
            value= 
                <?php
                    //write query
                    $sql=  "SELECT * FROM components_Table WHERE assignmentID = '$assid'";
                    $result = mysqli_query($conn, $sql);

                    if (mysqli_num_rows($result) > 0) {
                                        
                        while($row = mysqli_fetch_assoc($result)) {
                            echo $row["maxPages"];
                            
                        }
                    } 
                    
                ?>
            >

            <input type="submit" name="updatecomponents_submit" value="UPDATE">
        </form>

        <?php
            if(isset($_POST['updatecomponents_submit'])){
                $assign_figures= $_POST['figNum'];
                $assign_tables= $_POST['tableNum'];
                $assign_research= $_POST['inc_research'];
                $assign_references= $_POST['inc_references'];
                $pagemax=$_POST['maxi_pages'];
                
                $updatesql = "UPDATE components_Table SET figures='$assign_figures',
                numTables='$assign_tables',
                research='$assign_research',
                include_references='$assign_references',
                maxPages='$pagemax'
                WHERE assignmentID= '$assid' ";

                
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