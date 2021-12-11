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
</head>
    <title>Index</title>
</head>

<body>
    <div class="content">

        <div class="page-header">
        <h1>Home <small>USER</small></h1>
        </div>

        <br>

        <form method="POST" action="">

            <select name="selectCourse">
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
                    <option value=<?php echo $row['course_name']; ?>>
                        <?php echo $row['course_name']; ?>
                    </option>
                <?php endforeach;?>

            </select>

            <input type="submit" name="dropdownSubmit" value="Search">
        </form>
    </div>



    <!--Content-->
    <div class= "content">
        
        <?php 
            
            $chosenCourse= $_POST["selectCourse"];
            $dispAss= array();

            //write query
            $dispsql = "SELECT * FROM assignment WHERE course='$chosenCourse' ";
            $dispresult = mysqli_query($conn, $dispsql);
                

            while($post = mysqli_fetch_assoc($dispresult)) 
            {$dispAss[] = $post;
            }
        
            foreach ($dispAss as $post): 
        
        ?>
            
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title"><a href="post.php?id=<?php echo $post['assignment_id']; ?>"><?php echo $post['ass_name']; ?></a></h3>
            </div>
            <div class="panel-body">
                <!-- <i class="far fa-user"><?php echo $post['Author'];?></i> -->
                &nbsp;
                <i class="far fa-calendar"> <?php echo date('F j, Y',strtotime($post['assign_date'])); ?></i>
                <p class="preview-text">
                    <?php echo html_entity_decode(substr($post['questions'],0,100) . '...' );?>
                </p>
                <a href="post.php?id=<?php echo $post['assignment_id']; ?>" class="btn">Read More</a>
            </div>
        </div>
                                
        <?php endforeach;?>
    </div>
    
</body>
</html>