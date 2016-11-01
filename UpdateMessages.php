<?php


    require 'database.php';
	require 'CheckEntry.php';

    //correct this later

    //security needed to be added
	
	
	
	
	
   // $myusername = $_GET['username'];

   //$mymessage = $_GET['message'];
   
  
	
	

     $myusername = 'something';
     $mymessage = 'something';
	 
	 $username = new Checker( $myusername );
     $username = $username->result();
	 
	 $message = new Checker( $mymessage );
     $message = $message->result();
     
	 

    $username = $conn->real_escape_string($username);
    $message = $conn->real_escape_string($message);

    
	///fixed this mike... took awhile before i realised that message wasn't meant to be plural
	$sql = "INSERT INTO messages (username, message) VALUES (?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_Param("ss", $username, $message);
	
	

    $stmt->execute();
	
	
	$stmt->close();

?>