<?php

    //wipes out session data then the html redirects to login
    session_start();
    session_unset();
    session_destroy();
?>

<!DOCTYPE html>
<html>
<head>
    <title></title>
</head>
<body>
<meta http-equiv="refresh" content="1; url=login.php" />

</body>
</html>
