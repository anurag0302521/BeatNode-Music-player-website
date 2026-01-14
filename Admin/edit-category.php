
<?php include_once "header.php"; ?>
<?php require "config.php"; ?>
<?php 

if(isset($_POST['submit'])){
    $id = mysqli_real_escape_string($conn, $_POST['id']);
    $name = mysqli_real_escape_string($conn, $_POST['category']);

    if(empty(trim($name))){
        echo '<div id="hide" class="alert alert-danger">Category cannot be empty</div>';
    }else{
        $sql = "UPDATE category SET name = ('{$name}') WHERE id = '{$id}'";
        $res = mysqli_query($conn, $sql);
        if($res){
            echo '<div id="hide" class="alert alert-success">Category Updated Successfully</div>';
            header("refresh:2; url=category.php");
        }else{
            echo '<div id="hide" class="alert alert-danger">Something went wrong!!</div>';
        }
    }
}

?>
<div class="container">
    <div class="row" style="margin-top:50px;">

    </div>
        <div class="offset-md-4 col-md-4 p-3 bg-dark" style="border:2px solid black;border-radius:25px;">
        <form action="<?php $_SERVER['PHP_SELF']; ?>" method="post">
                <h2 class="text-white mb-3 mt-0">Update Category</h2>
                <?php
                    if(isset($_GET['id'])){
                        $id = $_GET['id'];
                        $sql2 = "SELECT id,name FROM category where id = '{$id}'";
                        $res2 = mysqli_query($conn, $sql2);
                        if($res2){
                            $row2 = mysqli_fetch_assoc($res2);
                ?>
                <input type="hidden" name="id" value="<?php echo $row2['id']; ?>">
                <div class="input-group mb-3 mt-4">
                    <input type="text" class="form-control" name="category" id="category" placeholder="Enter Category Name" value="<?php echo $row2['name']; ?>">
                </div>
                <?php
                        }else{
                            echo '<div id="hide" class="alert alert-danger">Something went wrong!!</div>';
                        }
                    }
                    
                ?>
                <input class="btn btn-warning mt-3" name="submit" type="submit" value="Save">
            </form>
        </div>
    </div>
</div>
<?php include_once "footer.php"; ?>