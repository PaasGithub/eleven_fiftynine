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
    <title>Components</title>
</head>
<body>
    <?php
        if (ISSET($_GET['id'])){
            //write select query
            $checksql = "SELECT * FROM components_Table WHERE assignmentID=$assid";
            $checkresult = mysqli_query($conn, $checksql); 
            //echo (mysqli_num_rows($checkresult)>0);

            if(mysqli_num_rows($checkresult)>0){
                header("location: reassign_components.php?id=$assid");
            }
        
        }
    ?>
    <div class="content">

        <div class="page-header">
            <h1>Assign Components <small>ADMIN</small></h1>
        </div>

        <form method="POST" action="">

            <!--Number of Figures -->
            <p>Number of Figures</p>
            <input type="text" name="figNum" class="text-input"
            value= 
                <?php
                    //write query
                    $sql=  "SELECT * FROM assignment WHERE assignment_id = '$getAssID'";
                    $result = mysqli_query($conn, $sql);

                    if (mysqli_num_rows($result) > 0) {
                                        
                        while($row = mysqli_fetch_assoc($result)) {
                            echo $row["questions"];
                            
                        }
                    } 
                    else {
                        
                    }
                ?>
            >

            <!--Number of Tables -->
            <p>Number of Tables</p>
            <input type="text" name="tableNum" class="text-input">

            <!--Research -->
            <p>Include Research </p>
            <input type="text" name="inc_research" class="text-input" placeholder="YES/NO">

            <!--References -->
            <p>Include References </p>
            <input type="text" name="inc_references" class="text-input" placeholder="YES/NO">

            <!--Maximum pages -->
            <p>Max Pages </p>
            <input type="text" name="maxi_pages" class="text-input">

            <input type="submit" name="assigncomponents_submit" value="Assign">
        </form>

        <?php 
            if(isset($_POST['assigncomponents_submit'])){
    
                
                //echo $assid;
   
                //write select query
                $Selectsql = "SELECT ass_name FROM assignment WHERE assignment_id=$assid";
                $result = mysqli_query($conn, $Selectsql); 
                $row= mysqli_fetch_assoc($result);
                //echo $row['ass_name'];
                //write insert query 
                $assign_figures= $_POST['figNum'];
                $assign_tables= $_POST['tableNum'];
                $assign_research= $_POST['inc_research'];
                $assign_references= $_POST['inc_references'];
                $pagemax=$_POST['maxi_pages'];

                $sql = "INSERT INTO 
                components_Table (figures,numTables,research,include_references,
                maxPages,assignmentID) 
                VALUES ('$assign_figures','$assign_tables','$assign_research','$assign_references','$pagemax','$assid')";
                    
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