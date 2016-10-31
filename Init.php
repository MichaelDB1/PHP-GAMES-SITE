<?php

//Bit of session security to help secure more
session_set_cookie_params(time()+600, '/','localhost', false, true);
session_start();

//could also edit the php.ini file and session storage location but seemed outside of the scope of security for this assignment
?>