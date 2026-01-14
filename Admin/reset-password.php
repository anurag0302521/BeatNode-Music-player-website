<?php
require_once "config.php";

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
    }else if( strlen($password ) <= 4){
        $_SESSION['error'] = "Password is too short";
    }
    else if( $password != $c_password){
        $_SESSION['error'] = "Password and Confirm password are not same";
    }else{
        $sql_check = "select * from admin where token = '{$token}'";
        $res_check = mysqli_query($conn, $sql_check) or die("Query failed");
        if(mysqli_num_rows($res_check) > 0){
            $password = md5($password);
            $sql = "UPDATE admin set password = '{$password}',token=NULL where token = {$token}";
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
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css"
        integrity="sha512-PgQMlq+nqFLV4ylk1gwUOgm6CtIIXkKwaIHp/PAIWHzig/lKZSEGKEysh0TCVbHJXCLN7WetD8TFecIky75ZfQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="CSS/style.css">
    <title>Beat Node | Reset Password</title>
    
    <script>
        function hideme(){
            setTimeout(() => {
                // document.getElementById("hide").style.display = "none";
                $('#hide').delay().slideUp(1000);
            }, 3000);
        }
    </script>
</head>

<body>

   
 <div class="container">
    <div class="row" style="margin-top:70px;">
        <div class="offset-md-4 col-md-4 offset-sm-2 col-sm-6 login-style bg-primary">
            <form action="<?php $_SERVER['PHP_SELF']; ?>" method="post">
                <h2 class="text-black mb-3 mt-0">Reset Password</h2>
                    <?php if(isset($_SESSION['error'])){
                            echo '<div id="" class="alert alert-danger p-2 m-0">'.$_SESSION['error'] .'</div>';
                            unset($_SESSION['error'] );
                        } ?>
                        
                        <?php if(isset($_SESSION['success'])){
                            echo '<div id="" class="alert alert-success p-2 m-0">'. $_SESSION['success'] .'</div>';
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
                <a href="index.php" class="btn btn-warning mt-3 mb-3" style="float:right;">Go Back</a>
            </form>
        </div>
    </div>
</div> 

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
</script>
<script src="https://code.jquery.com/jquery-3.6.1.min.js"
    integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>
<script src="script/main.js"></script>
<?php echo '<script> hideme();</script>'; ?>
</body>

</html>