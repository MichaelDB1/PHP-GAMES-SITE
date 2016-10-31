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

?>

<!DOCTYPE html>
<html>
<head> 
    <title>Game Laboratory</title>
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <script src="js/message.js"></script>
    <link href="https://fonts.googleapis.com/css?family=Ubuntu+Condensed" rel="stylesheet">
</head>
<body>

    <div class="header">
        Welcome to Game Laboratory
         <?php 
         //message variable displayed
            if(!empty($message)): ?>
            <P><?= $message ?></p>
        <?php endif; ?>

            </div>


     <h1>Enjoy exploring Game Laboratorys many student made games.</h1>

    <div class="msg-container">
	<div class="header">Messenger</div>
	<div class="msg-area" id="msg-area"></div>
	<div class="bottom"><input type="text" name="msginput" class="msginput" id="msginput" onkeydown="if (event.keyCode == 13) sendmsg()" value="" placeholder="Enter your message here ... (Press enter to send message)"></div>
</div>

</body>
</html>