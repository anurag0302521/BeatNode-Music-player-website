<?php include_once "header.php"; 

if(!isset($_SESSION['admin_email'])){
    header("Location: index.php");
}
?>
<?php require "config.php"; ?>
<div class="container">
    <div class="row" style="margin-top:50px;">
    <div class="offset-md-3 col-md-6 p-3 bg-light">
    <h2 class="text-black mb-4 d-inline-block">All Category</h2>
    <h2 class="d-inline-block " style="float:right;"><a href="add-category.php"><i class="fas fa-plus-square text-warning"></i></a></h2>
<table class="table table-light table-bordered">

<?php
$sql2 = "SELECT * FROM category";
$res2 = mysqli_query($conn, $sql2);
$i = 1;
if($res2){
    if(mysqli_num_rows($res2) > 0){
        ?>
<thead>
        <tr>
            <td>Id</td>
            <td>Name</td>
            <td>Edit</td>
            <td>Delete</td>
        </tr>
</thead>
    <tbody>
        <?php
        while($row2 = mysqli_fetch_assoc($res2)){
?>
        <tr>
            <!-- <td><?php echo $row2['id']; ?></td> -->
            <td><?php echo $i++; ?></td>
            <td><?php echo $row2['name']; ?></td>
            <td><a href="edit-category.php?id=<?php echo $row2['id']; ?>"><i class="fas fa-edit text-primary"></i></a></td>
            <!-- <td><a href="delete-category.php?id=<?php echo $row2['id']; ?>"><i class="fas fa-trash-alt text-danger"></i></a></td> -->
            <td><a onclick="let a = confirm('Confirmation Message to delete Category'); if(a == true){window.location.href='delete-category.php?id='+<?php echo $row2['id']; ?>;}"><i class="fas fa-trash-alt text-danger"></i></a></td>
        </tr>

<?php
        }
    }else{
        echo '<h2 class="text-white">No Category Found</h2>';
    }
}else{
    echo '<div class="alert alert-danger">Something went wrong!!</div>';
}
?>
    </tbody>
</table>
    </div>
    </div>
</div>
<?php include_once "footer.php"; ?>