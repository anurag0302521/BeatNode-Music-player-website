<?php
session_start();
include_once 'admin/config.php';  

$song_id = $_GET['song_id'];
$user_id = $_SESSION['id'];
$song_title = '';
$song_category = 0;
$song = '';
$song_duration = '';

$sql_check = "SELECT * FROM favorite where song_id = {$song_id}";
$res_check = mysqli_query($conn, $sql_check) or die("Query failed");
if(mysqli_num_rows($res_check) > 0){
        echo "Already in your favorite list";
        header("refresh:1; url=add-favorite.php");
}else{
    $sql_fetch = "SELECT * FROM song where id = '{$song_id}'";
    $res_fetch = mysqli_query($conn, $sql_fetch) or die("Query failed");
    if(mysqli_num_rows($res_fetch) > 0){
        $row_fetch = mysqli_fetch_assoc($res_fetch);
        $song_title =  $row_fetch['title'];
        $song_category = $row_fetch['category'];
        $song = $row_fetch['song'];
        $song_duration = $row_fetch['duration'];

        $sql_save = "INSERT INTO favorite(user_id,song_id,title,category,song,duration) VALUES('{$user_id}','{$song_id}','{$song_title}','{$song_category}','{$song}','{$song_duration}')";
        $res_save = mysqli_query($conn, $sql_save) or die("Query failed");
        if($res_save){
            echo "Added successfully";
            header("refresh:1; url=add-favorite.php");
        }else{
            echo "Something went wrong";
            header("refresh:1; url=add-favorite.php");
        }
    }else{
        echo "something went wrong";
        header("refresh:1; url=add-favorite.php");
    }
}








?>