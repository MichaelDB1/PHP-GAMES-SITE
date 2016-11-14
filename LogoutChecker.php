<?php
    include 'Init.php';
    //checking that the session is set if not gos to login
    if(!isset($_SESSION['username']) && !isset($_SESSION['id']) ){
        header("Location: Login.php");
    }
    //set up message variable
    $message ="";
    //databse connect
    require 'database.php';

    // if the id is set (which is should be to get this far)
    if( isset($_SESSION['id'])){
    
    //gets relevant user details for output
    $sql = "SELECT username, id, email, firstname, lastname FROM MyUsers WHERE id = '". ($_SESSION['id']) ."' LIMIT 1";
    $result = $conn->query($sql);

    //outputs details onto the message variable
    $count=mysqli_num_rows($result);
    if ($count ==1){
        //row output
        $row = mysqli_fetch_assoc($result);     
        $message = "Your Username: " . $row["username"] . " - Name: " . $row["firstname"] . " " . $row["lastname"] . " - Email: " . $row["email"];      
     }
    else {
        $message = "Hmmm looks like you managed to break it";
    }
    $conn->close();
    }

    //if user presses yes gets redirect to logout script
     if(isset($_POST['yes'])){
         header("Location: Logout.php");
     }
     //if user presses no gets sent back to index.php
     if(isset($_POST['no'])){
         header("Location: Index.php");
     }  

?>

<!DOCTYPE html>
<html>
<head> 
    <title>Game Laboratory</title>
    <link rel="stylesheet" type="text/css" href="css/LoginRegister.css">
    <link href="https://fonts.googleapis.com/css?family=Ubuntu+Condensed" rel="stylesheet">
</head>
<body>

    <div class="header">
        We hope you enjoyed your time at Game Laboratory!
         <?php 
         //displays messages
            if(!empty($message)): ?>
            <P><?= $message ?></p>
        <?php endif; ?>

            </div>
         <span>Are you sure you want to Logout?</span>
         <br></br>
    <form action="LogoutChecker.php" method="POST" enctype="multipart/form-data">
        <input name="yes" type="submit" value="yes">
        <input name="no" type="submit" value="no">
    </form>

</body>
</html>