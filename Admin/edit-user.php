<?php include_once "header.php"; ?>
<?php require "config.php"; ?>
<?php 

if(isset($_POST['submit'])){
    $id = mysqli_real_escape_string($conn, $_POST['id']);
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);


    if(empty(trim($name))){
        echo '<div id="hide" class="alert alert-danger">Name cannot be empty</div>';
    }else if(empty(trim($email))){
        echo '<div id="hide" class="alert alert-danger">Email cannot be empty</div>';
    }else{
        $sql = "UPDATE admin SET name = '{$name}', email = '{$email}' WHERE id = '{$id}'";
        $res = mysqli_query($conn, $sql);
        if($res){
            echo '<div id="hide" class="alert alert-success">Updated Successfully</div>';
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
                <h2 class="text-white mb-3 mt-0">Update Admin Detials</h2>
                <?php
                    if(isset($_GET['id'])){
                        $id = $_GET['id'];
                        $sql2 = "SELECT name,email FROM admin where id = '{$id}'";
                        $res2 = mysqli_query($conn, $sql2);
                        if($res2){
                            $row2 = mysqli_fetch_assoc($res2);
                ?>
               
                <div class="mb-3 mt-2">
                <input type="hidden" name="id" value="<?php echo $id; ?>">
                <label for="" class="form-label text-white">Name : </label>
                    <input type="text" class="form-control" name="name" id="name" placeholder="Enter your Name" value="<?php echo $row2['name']; ?>">
                </div>
                <div class="mb-3 mt-2">
                <label for="" class="form-label text-white">Email : </label>
                    <input type="email" class="form-control" name="email" id="email" placeholder="Enter your Email"
                    value="<?php echo $row2['email']; ?>">
                </div>
                <?php
                        }else{
                            echo '<div id="hide" class="alert alert-danger">Something went wrong!!</div>';
                        }
                    }
                    
                ?>
                <input class="btn btn-warning mt-3" name="submit" type="submit" value="Save">
                <button class="btn btn-danger mt-3" type="reset" style="float:right;">Reset</button>
            </form>
        </div>
    </div>
</div>
<?php include_once "footer.php"; ?>