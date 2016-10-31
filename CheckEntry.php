<?php

class Checker{

    protected $returnValue = "";
    public function __construct( $inputString ){

    //Sets value to the string input
    $value = $inputString;

    //Coverts value to make it safe
    $value = strip_tags($value);
    $value = stripcslashes($value);
    $value = htmlspecialchars($value, ENT_QUOTES, 'UTF-8');
    $this->returnValue = $value;
    }

    //returns result back to call script
    public function result(){
    return $this->returnValue;        
    }

}


?>