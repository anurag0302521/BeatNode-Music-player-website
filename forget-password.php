<?php
require_once "admin/config.php";
require_once "admin/functions.php";


session_start();
if(isset($_SESSION['email'])){
    header("Location: index.php");
}

if(isset($_POST['submit'])){

    $email = $_POST['email'];
    $sql = "SELECT * FROM user where email = '{$email}'";
    $res = mysqli_query($conn, $sql) or die("Query failed");
    if(mysqli_num_rows($res) > 0){
        $uuid = generate_uuid();
        $url = $base_url . 'reset-password.php?id='.$uuid;
        $subject = "Reset BeatNode Password";
        $message = "Click on the link to reset password<br>";
        $message .= "<a href='.$url.'>Click Here</a><br>";
        $message  .= $url;
        if(send_email($email,$subject,$message)){
            $sql_token = "UPDATE user set token = '{$uuid}' where email = '{$email}'";
            $res_token = mysqli_query($conn, $sql_token) or die("Query failed");
            $_SESSION['success'] = "Check email for password reset link";
        }else{
            $_SESSION['error'] = "Something went wrong"; 
        }
    }else{
        $_SESSION['error'] = "User Not Exist!!";
    }
    
}
?>
<?php include_once 'header.php' ?>
   
 <div class="container">
    <div class="row" style="margin-top:150px;">
        <div class="offset-md-4 col-md-4 offset-sm-2 col-sm-6 login-style bg-primary">
            <form action="<?php $_SERVER['PHP_SELF']; ?>" method="post">
                <h2 class="text-black mb-3 mt-0">Forget Password</h2>
                    <?php if(isset($_SESSION['error'])){
                            echo '<div id="hide" class="alert alert-danger p-2 m-0">'.$_SESSION['error'] .'</div>';
                            unset($_SESSION['error'] );
                        } ?>
                        
                        <?php if(isset($_SESSION['success'])){
                            echo '<div id="hide" class="alert alert-success p-2 m-0">'. $_SESSION['success'] .'</div>';
                            unset($_SESSION['success']);
                        }?>
                <div class="input-group mb-3 mt-4">
                    <div class="input-group-text"><i class="fas fa-envelope"></i></div>
                    <input type="email" class="form-control" name="email" id="email" placeholder="Enter your email">
                </div>
                <input class="btn btn-warning mt-3 mb-3" name="submit" type="submit" value="Submit">
            </form>
        </div>
    </div>
</div> 

<?php include_once 'footer.php' ?>