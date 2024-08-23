<?php
$db_host="localhost";
$db_user="root";
$db_password="";
$db_name="newos";
$db_port="3307";

//Create connection

$conn = new mysqli($db_host, $db_user, $db_password,$db_name,$db_port);

//checking

if($conn->connect_error){
    die("connection failed");
} 
// else{
//     echo "connect";
// }

?>
