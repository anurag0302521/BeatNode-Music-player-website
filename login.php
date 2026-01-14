<?php
require "admin/config.php";

session_start();
if(isset($_SESSION['email'])){
    header("Location: index.php");
}

if(isset($_POST['submit'])){

    $email = $_POST['email'];
    $password = $_POST['password'];

    if(empty(trim($email))){
        $_SESSION['error'] = "Email cannot be empty";
    }else if(empty(trim($password))){
        $_SESSION['error'] = 'Password cannot be empty';
    }else{
        $email = mysqli_real_escape_string($conn, $email);
        $password = md5($password);

        $query = "SELECT id,email,password,name FROM user WHERE email = '{$email}'";
        $res = mysqli_query($conn, $query) or die("Query Failed");
        if(mysqli_num_rows($res) > 0){
            $row = mysqli_fetch_assoc($res);
            $pass = $row['password'];
            if($pass == $password){
                // while($row = mysqli_fetch_assoc($res)){
                    $_SESSION['success'] = 'Login Successful';
                    unset($_SESSION['error']);
                    $_SESSION['id'] = $row['id'];
                    $_SESSION['email'] = $row['email'];
                    $_SESSION['name'] = $row['name'];
                // }
            }else{
                $_SESSION['error'] = 'Invalid Crediantials';
            }
        }else{
            $_SESSION['error'] = 'User not found!!';
        }
    }
}
?>
<?php include_once 'header.php' ?>
  <style>
    .box{
        border-radius: 10px;
        background-color: rgb(202, 131, 169);
        /* backdrop-filter: blur(20px); */
        border:1px solid black;
    }
    .txt{
        text-align: center;
        font: 2.5em sans-serif;
        
    }
  </style> 
 <div class="container">
    <div class="row" style="margin-top:150px;">
        <div class="offset-md-4 col-md-4 offset-sm-2 col-sm-6 login-style box">
            <form action="<?php $_SERVER['PHP_SELF']; ?>" method="post">
                <h2 class="text-black mb-3 mt-0 log txt">Login</h2>
                    <?php if(isset($_SESSION['error'])){
                            echo '<div id="hide" class="alert alert-danger p-2 m-0">'.$_SESSION['error'] .'</div>';
                            unset($_SESSION['error'] );
                        } ?>
                        
                        <?php if(isset($_SESSION['success'])){
                            echo '<div id="hide" class="alert alert-success p-2 m-0">'. $_SESSION['success'] .'</div>';
                            unset($_SESSION['success']);
                            unset($_SESSION['email_temp']);
                            $_SESSION['email'] = $email;
                            header("refresh:3; url=index.php");
                        }?>
                <div class="input-group mb-3 mt-4">
                    <div class="input-group-text"><i class="fas fa-envelope"></i></div>
                    <input type="email" class="form-control" name="email" id="email" value="<?php if(isset($_SESSION['email_temp'])){echo $_SESSION['email_temp']; } ?>" placeholder="Enter your email">
                </div>
                <div class="input-group mb-3 mt-4">
                    <div class="input-group-text"><i class="fas fa-lock"></i></div>
                    <input type="password" class="form-control" name="password" id="password"
                        placeholder="Enter your password">
                    <div class="input-group-text" onclick="changeType()"><i class="fas fa-eye"></i></div>
                </div>
                <a class="text-white" href="forget-password.php">
                    Forget Password?
                </a><br>
                <input class="btn btn-warning mt-3 mb-3" name="submit" type="submit" value="Login">
            </form>
        </div>
    </div>
</div> 

<?php include_once 'footer.php' ?>