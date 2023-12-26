<?php
error_reporting(E_ALL);
ini_set('display_errors', 0);

    $host="localhost";
    $db="project";
    $user="root";
    $pass="";

    $conn = new mysqli($host,$user,$pass,$db);

    if($conn->connect_errno)
    {
        die("Connection error".$conn->connect_error);
    }
//    else{
//     echo"connection successfull";
//    }

?>