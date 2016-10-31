<?php


    require 'database.php';

    //correct this later

    //security needed to be added
    $username = $_GET['username'];

    $messages = $_GET['message'];

    if ($username == "" || $messages == ""){
        die();
    }

    $result = $conn->prepare("INSERT INTO messages VALUES('',?,?)");
    $result->bind_param("ss", $username, $messages);
    $result->execute();


?>