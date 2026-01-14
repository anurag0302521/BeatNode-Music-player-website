<?php
require_once "admin/config.php";

session_start();
if(isset($_SESSION['email'])){
    header("Location: index.php");
}

if(!isset($_GET['id'])){
    header("Location: index.php");
}

$token = $_GET['id'];

if(isset($_POST['submit'])){
    $password = $_POST['password'];
    $c_password = $_POST['c_password'];

    if(empty(trim($password))){
        $_SESSION['error'] = "Password cannot be empty!!";
    }else if( strlen($password ) < 4){
        $_SESSION['error'] = "Password is too short";
    }
    else if( $password != $c_password){
        $_SESSION['error'] = "Password and Confirm password are not same";
    }else{
        $sql_check = "select * from user where token = '{$token}'";
        $res_check = mysqli_query($conn, $sql_check) or die("Query failed");
        if(mysqli_num_rows($res_check) > 0){
            $password = md5($password);
            $sql = "UPDATE user set password = '{$password}',token=NULL where token = '{$token}'";
            $res = mysqli_query($conn, $sql) or die("Query failed");
            if($res){
                $_SESSION['success'] = 'Password updated successfully';
                header("refresh:2; url=index.php");
            }else{
                $_SESSION['error'] = "Something went wrong!!";
            }
        }else{
            $_SESSION['error'] = "User Not Found!!";
        }
    }
}
?>
<?php include_once 'header.php' ?>
   
 <div class="container">
    <div class="row" style="margin-top:150px;">
        <div class="offset-md-4 col-md-4 offset-sm-2 col-sm-6 login-style bg-primary">
            <form action="<?php $_SERVER['PHP_SELF']; ?>" method="post">
                <h2 class="text-black mb-3 mt-0">Reset Password</h2>
                    <?php if(isset($_SESSION['error'])){
                            echo '<div id="hide" class="alert alert-danger p-2 m-0">'.$_SESSION['error'] .'</div>';
                            unset($_SESSION['error'] );
                        } ?>
                        
                        <?php if(isset($_SESSION['success'])){
                            echo '<div id="hide" class="alert alert-success p-2 m-0">'. $_SESSION['success'] .'</div>';
                            unset($_SESSION['success']);
                        }?>
                <div class="input-group mb-3 mt-4">
                    <div class="input-group-text"><i class="fas fa-lock"></i></div>
                    <input type="password" class="form-control" name="password" id="password"
                        placeholder="Enter New Password">
                    <div class="input-group-text" onclick="changeType()"><i class="fas fa-eye"></i></div>
                </div>
                <div class="input-group mb-3 mt-4">
                    <div class="input-group-text"><i class="fas fa-lock"></i></div>
                    <input type="password" class="form-control" name="c_password" id="c_password" placeholder="Confirm password">
                </div>
                <input class="btn btn-warning mt-3 mb-3" name="submit" type="submit" value="Submit">
            </form>
        </div>
    </div>
</div> 

<?php include_once 'footer.php' ?>