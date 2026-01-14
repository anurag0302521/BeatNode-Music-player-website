<?php
require 'config.php';

    if(isset($_GET['id'])){
        $id = $_GET['id'];

        $sql = "DELETE FROM admin WHERE id = '{$id}'";
        $res = mysqli_query($conn, $sql);
        if($res){
            echo '<h1 style="text-align:center;background-color:green;padding:10px;margin:40px;">Admin Removed Successfully</h1>';
            header("refresh:2, url=user.php");
        }else{
            echo '<h1 style="text-align:center;background-color:red;padding:10px;margin:40px;">Something Went Wrong!!</h1>';
            header("refresh:2, url=user.php");
        }
    }



?>