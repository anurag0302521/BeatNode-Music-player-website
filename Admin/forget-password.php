<?php
require_once "config.php";
require_once "functions.php";


session_start();
if(isset($_SESSION['email'])){
    header("Location: index.php");
}

if(isset($_POST['submit'])){

    $email = $_POST['email'];
    $sql = "SELECT * FROM admin where email = '{$email}'";
    $res = mysqli_query($conn, $sql) or die("Query failed");
    if(mysqli_num_rows($res) > 0){
        $uuid = generate_uuid();
        $url = $base_url . 'admin/reset-password.php?id='.$uuid;
        $subject = "Reset BeatNode Admin Password";
        $message = "Click on the link to reset password<br>";
        $message .= "<a href='.$url.'>Click Here</a><br>";
        $message  .= $url;
        if(send_email($email,$subject,$message)){
            $sql_token = "UPDATE admin set token = '{$uuid}' where email = '{$email}'";
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
    <div class="row" style="margin-top:70px;">
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

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
</script>
<script src="https://code.jquery.com/jquery-3.6.1.min.js"
    integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>
<script src="script/main.js"></script>
<?php echo '<script> hideme();</script>'; ?>
</body>

</html>