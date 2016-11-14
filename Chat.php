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
<meta name="viewport" content="width=device-width, initial-scale=1">
  <head>
     <title>Game Laboratory</title>
    <link rel="stylesheet" type="text/css" href="css/web.css">
    <script src="js/webset.js"></script>
    <script src="js/message.js"></script>
    <link href="https://fonts.googleapis.com/css?family=Ubuntu+Condensed" rel="stylesheet">
  </head>

<body>


<div id="mySidenav" class="sidenav">
  <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
  <a href="Index.php">Main Board</a>
  <a href="Profile.php">My Profile</a>
  <a href="Users.php">Users</a>
  <a href="UserMessages.php">Messages</a>
  <a href="LogoutChecker.php">Logout</a>
</div>

        <span style="font-size:35px;cursor:pointer; width: 100%;" onclick="openNav()"> <div class="menu">&#9776; Menu ------->
        <?php 
         //message variable displayed
            if(!empty($message)): ?>
            <?= $message ?>
        <?php endif; ?></div>
        </span>


    <div class="header">
        Welcome to Game Laboratory


            </div>

     <h1>Enjoy exploring Game Laboratorys many student made games.</h1>

     </body>
</html>