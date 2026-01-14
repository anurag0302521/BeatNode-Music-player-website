<?php
require_once "config.php";

session_start();

if(isset($_SESSION['admin_email'])){
    header("Location: dashboard.php");
}

if(isset($_POST['submit'])){

    $email = $_POST['email'];
    $password = $_POST['password'];
    $_SESSION['email_temp'] = $email;

    if(empty(trim($email))){
        $_SESSION['error'] = "Email cannot be empty";
    }else if(empty(trim($password))){
        $_SESSION['error'] = 'Password cannot be empty';
    }else{
        $email = mysqli_real_escape_string($conn, $email);
        $password = md5($password);

        $query = "SELECT email,password,name FROM admin WHERE email = '{$email}'";
        $res = mysqli_query($conn, $query) or die("Query Failed");
        if(mysqli_num_rows($res) > 0){
            $row = mysqli_fetch_assoc($res);
            $pass = $row['password'];
            if($pass == $password){
                // while($row = mysqli_fetch_assoc($res)){
                    $_SESSION['success'] = 'Login Successful';
                    unset($_SESSION['error']);
                    $_SESSION['admin_email'] = $row['email'];
                    $_SESSION['admin_name'] = $row['name'];
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
    <title>Beat Node | Login</title>
    
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
    <div class="row">
        <div class="offset-md-4 col-md-4 offset-sm-2 col-sm-6 login-style bg-primary">
            <form action="<?php $_SERVER['PHP_SELF']; ?>" method="post">
                <h2 class="text-black mb-3 mt-0">Login</h2>
                    <?php if(isset($_SESSION['error'])){
                            echo '<div id="hide" class="alert alert-danger p-2 m-0">'.$_SESSION['error'] .'</div>';
                            unset($_SESSION['error'] );
                        } ?>
                        
                        <?php if(isset($_SESSION['success'])){
                            echo '<div id="hide" class="alert alert-success p-2 m-0">'. $_SESSION['success'] .'</div>';
                            echo '<p>Please wait redirecting...</p>';
                            unset($_SESSION['success']);
                            unset($_SESSION['email_temp']);
                            header("refresh:3; url=dashboard.php");
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
             
                <a href="forget-password.php" class="text-white">Forget password?</a>
                <br>
                <input class="btn btn-warning mt-3" name="submit" type="submit" value="Login">
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