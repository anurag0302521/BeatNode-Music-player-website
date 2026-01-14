<?php include_once "header.php"; ?>
<?php require "config.php"; ?>
<?php 

if(isset($_POST['submit'])){
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    $confirm_password = mysqli_real_escape_string($conn, $_POST['confirm_password']);

    $_SESSION['new_admin_name'] = $name;
    $_SESSION['new_admin_email'] = $email;


    if(empty(trim($name))){
        echo '<div id="hide" class="alert alert-danger">Name cannot be empty</div>';
    }else if(empty(trim($email))){
        echo '<div id="hide" class="alert alert-danger">Email cannot be empty</div>';
    }
    else if(empty(trim($password))){
        echo '<div id="hide" class="alert alert-danger">Password cannot be empty</div>';
    }else if( $password != $confirm_password){
        echo '<div id="hide" class="alert alert-danger">Password and Confirm Password are not same</div>';
    }else{
        $password = md5($password);
        $sql = "INSERT INTO admin(name,email,password) values('{$name}','{$email}','{$password}')";
        $res = mysqli_query($conn, $sql);
        if($res){
            unset($_SESSION['new_admin_name']);
            unset($_SESSION['new_admin_email']);
            echo '<div id="hide" class="alert alert-success">Admin Added Successfully</div>';
            header("refresh:2; url=user.php");
        }else{
            echo '<div id="hide" class="alert alert-danger">Something went wrong!!</div>';
        }
    }
}

?>
<div class="container">
    <div class="row" style="margin-top:50px;">

    </div>
        <div class="offset-md-4 col-md-4 p-3 bg-dark" style="border:2px solid black;border-radius:10px;">
        <form action="<?php $_SERVER['PHP_SELF']; ?>" method="post">
                <h2 class="text-white mb-3 mt-0">Add Admin</h2>
                <div class="mb-3 mt-2">
                <!-- <label for="" class="form-label text-white">Name : </label> -->
                    <input type="text" class="form-control" name="name" id="name" placeholder="Enter your Name" value="<?php if(isset($_SESSION['new_admin_name'])){echo $_SESSION['new_admin_name'];} ?>">
                </div>
                <div class="mb-3 mt-2">
                <!-- <label for="" class="form-label text-white">Email : </label> -->
                    <input type="email" class="form-control" name="email" id="email" placeholder="Enter your Email"
                    value="<?php if(isset($_SESSION['new_admin_email'])){echo $_SESSION['new_admin_email'];} ?>">
                </div>
                <!-- <label for="" class="form-label text-white  mt-2">Password : </label> -->

                <div class="input-group mb-3">

                    <input type="password" class="form-control" name="password" id="password"
                        placeholder="Enter your password">
                    <div class="input-group-text" onclick="changeType()"><i class="fas fa-eye"></i></div>
                </div>
                <!-- <label for="" class="form-label text-white mt-2">Confirm Password : </label> -->

                <div class="input-group mb-3 ">

                    <input type="password" class="form-control" name="confirm_password" id="confirm_password"
                        placeholder="Confirm Password">
                </div>

                <input class="btn btn-warning mt-3" name="submit" type="submit" value="Add">
                <button class="btn btn-danger mt-3" type="reset" style="float:right;">Reset</button>
            </form>
        </div>
    </div>
</div>
<?php include_once "footer.php"; ?>