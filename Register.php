<?php

    include 'Init.php';

    //Checking if already logged in.... Don't want user to log in twice
    if(isset($_SESSION['id']) && ($_SESSION['id'])){
        header("Location: Index.php");
    }

//setting up a message variable for possible output
$message = "";
//Getting the databse
require 'database.php';
require 'CheckEntry.php';
//Once all feilds are not empty and the user submits this will run the registration
if(!empty($_POST['email']) && !empty($_POST['firstname'])  && !empty($_POST['lastname'])  && !empty($_POST['username'])  && !empty($_POST['password'])  && !empty($_POST['passwordConfrim'])){


    /*
    $email = strip_tags($_POST['email']);
    $firstname = strip_tags($_POST['firstname']);
    $lastname = strip_tags($_POST['lastname']);
    $username = strip_tags($_POST['username']);
    $password = strip_tags($_POST['password']);
    $passwordConfrim = strip_tags($_POST['passwordConfrim']);

    $email = stripcslashes($email);
    $firstname = stripcslashes($firstname);
    $lastname = stripcslashes($lastname);
    $username = stripcslashes($username);
    $password = stripcslashes($password);
    $passwordConfrim = stripcslashes($passwordConfrim);

    $email = htmlspecialchars($email);
    $firstname = htmlspecialchars($firstname);
    $lastname = htmlspecialchars($lastname);
    $username = htmlspecialchars($username);
    $password = htmlspecialchars($password);
    $passwordConfrim = htmlspecialchars($passwordConfrim);
    */
    

     //setting up variables
     $myemail = ( $_POST['email'] );
     $myfirstname = ( $_POST['firstname'] );
     $mylastname = ( $_POST['lastname'] );
     $myusername = ( $_POST['username'] );
     $mypassword = ( $_POST['password'] );
     $mypasswordConfrim = ( $_POST['passwordConfrim'] );
     

    //Some validation to try and prevent hacking
    //Calling the Checker class in CheckEntry
     $email = new Checker( $myemail );
     $email = $email->result();

     $firstname = new Checker( $myfirstname );
     $firstname = $firstname->result();

     $lastname = new Checker( $mylastname );
     $lastname = $lastname->result();

     $username = new Checker( $myusername );
     $username = $username->result();

     $password = new Checker( $mypassword );
     $password = $password->result();

     $passwordConfrim = new Checker( $mypasswordConfrim );
     $passwordConfrim = $passwordConfrim->result();



/*

    $email = check($_POST['email']);
    $firstname = check($_POST['firstname']);
    $lastname = check($_POST['lastname']);
    $username = check($_POST['username']);
    $password = check($_POST['password']);
    $passwordConfrim = check($_POST['passwordConfrim']);
    
    */

    //secure for SQL
    $email = $conn->real_escape_string($email);
    $firstname = $conn->real_escape_string($firstname);
    $lastname = $conn->real_escape_string($lastname);
    $username = $conn->real_escape_string($username);
    $password = $conn->real_escape_string($password);
    $passwordConfrim = $conn->real_escape_string($passwordConfrim);

    //Checking the username doesn't already exist
    $sql = "SELECT username FROM MyUsers WHERE username = '". $username ."' ";
    $result = $conn->query($sql);
    $count=mysqli_num_rows($result);
    if ($count >= 1 ){

        $message = "User with the username: $username has already been created";
    }
    //If username doesn't exist code bellow can run
    else{

    //Checking that email has only been used 3 times
    $sql = "SELECT email FROM MyUsers WHERE email = '". $email ."' ";
    $result = $conn->query($sql);
    $count=mysqli_num_rows($result);
    if ($count >= 4 ){

        $message = "The maximum amount of emails for: $email has already been created, no more than 5 accounts per email";
    }
    //if no more than 3 emails exist code bellow will run
    else{


    //Checks if the password and confirm password are the same if they are not then no data can be inserted
    if($password != $passwordConfrim){
        $message = "Passwords need to match!";
    }
    //if the password matches code bellow will run
    else{

    //Conversion of the password for database entry
    $password = md5($password);

    
    //Inserts new user into MyUsers table
    $sql = "INSERT INTO MyUsers (email, firstname, lastname, username, password) VALUES (?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_Param("sssss", $email, $firstname, $lastname, $username, $password);

    //checks if stmt can execute and if it does then message prints successfully created new user 
    // May add more functionality so that this can output the exact registration issue if it fails
    if( $stmt->execute() )
    {
        $message = "Successfully created new user";
        }
    else
        {
        $message = 'Sorry there must have been an issue creating your account';
        }
    }
    }
    }
    $conn->close();
    }

?>

<html>
<head> 
    <title>Game Laboratory Registration</title>
    <link rel="stylesheet" type="text/css" href="css/LoginRegister.css">
    <link href="https://fonts.googleapis.com/css?family=Ubuntu+Condensed"  rel="stylesheet">
</head>
<body>
    <div class="header">
         Game Laboratory
            </div>

    <?php 
    //Displays any messages from the message variable
    if(!empty($message)): ?>
    <P><?= $message ?></p>
    <?php endif; ?>

    <h1>Register to the student games site</h1>
    <span>Please register or <a href="Login.php">login here</a></span>
    <form action="Register.php" method="POST" enctype="multipart/form-data">
    <input type="text" placeholder="Enter your email" name="email" autofocus>
    <input type="text" placeholder="Enter your first name" name="firstname">
    <input type="text" placeholder="Enter your last name" name="lastname">
    <input type="text" placeholder="Please enter a Username" name="username">
    <input type="password" placeholder="Enter your passwrod" name="password">
    <input type="password" placeholder="Please confirm your password" name="passwordConfrim">
    <input name="Register" type="submit" value="register">
        </form>
</body>
</html>