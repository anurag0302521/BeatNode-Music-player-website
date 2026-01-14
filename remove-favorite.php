<?php
session_start();
include_once 'admin/config.php';  

$song_id = $_GET['song_id'];

$sql = "DELETE FROM favorite where song_id = {$song_id}";
$res = mysqli_query($conn, $sql) or die("Query failed");

if($res){
    echo "Removed successfully";
    header("refresh:1; url=add-favorite.php");
}else{
    echo "something went wrong";
    header("refresh:1; url=add-favorite.php");
}



?>