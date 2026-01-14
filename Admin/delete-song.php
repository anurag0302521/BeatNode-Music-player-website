<?php
require 'config.php';

    if(isset($_GET['id'])){
        $id = $_GET['id'];

        $sql = "DELETE FROM song WHERE id = '{$id}'";
        $sql_fav = "DELETE FROM favorite WHERE song_id = '{$id}'";
        $res = mysqli_query($conn, $sql);
        $res_fav = mysqli_query($conn, $sql_fav);
        if($res && $res_fav){
            echo '<h1 style="text-align:center;background-color:green;padding:10px;margin:40px;">Song Removed Successfully</h1>';
            header("refresh:2, url=song.php");
        }else{
            echo '<h1 style="text-align:center;background-color:red;padding:10px;margin:40px;">Something Went Wrong!!</h1>';
            header("refresh:2, url=song.php");
        }
    }



?>