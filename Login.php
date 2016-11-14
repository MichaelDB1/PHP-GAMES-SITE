<?php


    include 'Init.php';
    //session_start();


    //regenerates the sessionID file so that it changes every time to user logs in
    session_regenerate_id(true);
   
    //Checking if already logged in.... Don't want user to log in twice
    if(isset($_SESSION['id']) && ($_SESSION['id'])){
        header("Location: Index.php");
    }

    //Getting the databse
    require 'database.php';
    require 'CheckEntry.php';
    //setting up a message variable for possible output
    $message="";

    //If user hits login button
    if(isset($_POST['login'])) {

       
        //Setting up Variables
        $myusername = ( $_POST['username'] );
        $mypassword = ( $_POST['password'] );

        //Some validation to try and prevent hacking
        //Calling the Checker class in CheckEntry
        $username = new Checker( $myusername );
        $username = $username->result();

        $password = new Checker( $mypassword );
        $password = $password->result();


      //  $username = check($_POST['username']);
      //  $password = check($_POST['password']);
        //$username = strip_tags($_POST['username']);
       // $password = strip_tags($_POST['password']);
        //$username = stripcslashes($username);
        //$password = stripcslashes($password);
        //$username = htmlspecialchars($username, ENT_Quotes, 'UTF-8');
        //$password = htmlspecialchars($password, ENT_Quotes, 'UTF-8');

        //Database check
        $username = $conn->real_escape_string($username);
        $password = $conn->real_escape_string($password);

        //Password being converted to and md5 before entered into the Database, secures the password better
        $password = md5($password);

        //SQL script to grab the user for entered username
        $sql = "SELECT id, username, password FROM MyUsers WHERE username='$username' LIMIT 1";
        $result = $conn->query($sql);


        //Checking that the entered massword matches the password inside the database user will be taken to index page if all is ok 
        //if not either the password won't match databse password and will set message to wrong password or if no user was found message will be wrong user
        $count=mysqli_num_rows($result);
        if($count ==1){
            $row = mysqli_fetch_assoc($result);
            if($password == $row["password"]){
                $_SESSION['username'] = $username;
                $_SESSION['id'] = $row["id"];
                header("Location: Index.php");
            }
            else {
                $message = "wrong password please try again";
            }
        }
        else{
            $message = "Could not find the user $username please try again or register a new account";
        }

        $conn->close();

        
    }
?>


<html>
<head>
    <meta charset="UTF-8">
    <title>Game Laboratory Login</title>
    <link rel="stylesheet" type="text/css" href="css/LoginRegister.css">
    <link href="https://fonts.googleapis.com/css?family=Ubuntu+Condensed" rel="stylesheet">
</head>
<body>
    <div id="main">
    <div class="header">
        Game Laboratory
            </div>
    
    
    <?php 
    //Small script that displays the message variable output
    if(!empty($message)): ?>
    <P><?= $message ?></p>
    <?php endif; ?>


    <h1>Welcome to the student games site</h1>
    <span>Please login or <a href="Register.php">register here</a></span>
    <form action="login.php" method="POST" enctype="multipart/form-data">
        <input type="text" placeholder="Please enter a Username" name="username" autofocus>
        <input type="password" placeholder="Enter your passwrod" name="password">
        <input name="login" type="submit" value="login">
    </form>
    </div>

</body>
</html>


