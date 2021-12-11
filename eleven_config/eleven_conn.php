<?php require 'datab_credentials.php';

    //create conncetion 

    $conn = mysqli_connect(SERVERNAME,USERNAME,PASSWORD,DATABASE);

	//check connection
	if(mysqli_connect_errno()){
		die("Connection failed" . mysqli_connect_error()); 
	}
    else{
        //echo "Connection successful.";
    }

?>