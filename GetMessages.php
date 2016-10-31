<?php


    require 'database.php';


    $result = $conn->prepare("SELECT * FROM messages");
    $result->bind_param("s", $username);
    $result->execute();

    $result = $result->get-result();
    while ($r = $result->fetch_row()){
        echo $r[1];
        echo "\\";
        echo $r[2];
        echo "\n";
    }


?>