<?php
$host="localhost";
$db="project";
$user="root";
$pass="";

$conn = new mysqli($host,$user,$pass,$db);

if($conn->connect_errno)
{
    die("Connection error".$conn->connect_error);
}

?>