<?php
$host = "localhost";             //Host Name
$user = "root";            //Database user name
$pass = "";            //Database user password
$db = "beatnode";               //Database name

$conn = mysqli_connect($host, $user, $pass, $db) or die("Connection Failed");

$base_url = 'http://localhost/BeatNode/';

$admin_email = '';
$admin_email_pass = '';


// if($conn){
//     echo"Success";
// }else{
//     echo "Failed";
// }




?>