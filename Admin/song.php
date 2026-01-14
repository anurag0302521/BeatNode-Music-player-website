<?php 
include_once "header.php"; ?>
<?php require "config.php"; ?>
<div class="container">
    <div class="row" style="margin-top:50px;">
    <div class="col-12 p-3 bg-light" >
    <h2 class="text-black mb-4 d-inline-block">All Songs</h2>
    <h2 class="d-inline-block " style="float:right;"><a href="add-song.php"><i class="fas fa-plus-square text-warning"></i></a></h2>
<table class="table table-light table-bordered">

<?php
$sql2 = "SELECT song.id,song.title,category.name,song.duration FROM song LEFT JOIN category on category.id = song.category order by song.id desc";
$res2 = mysqli_query($conn, $sql2);
$i = 1;
if($res2){
    if(mysqli_num_rows($res2) > 0){
        ?>
<thead>
        <tr>
            <td>Id</td>
            <td>Title</td>
            <td>Category</td>
            <td>Duration</td>
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
            <td><?php echo $row2['title']; ?></td>
            <td><?php echo $row2['name']; ?></td>
            <td><?php echo $row2['duration']; ?></td>
            <td><a href="edit-song.php?id=<?php echo $row2['id']; ?>"><i class="fas fa-edit text-primary"></i></a></td>
            <td><a style="cursor:pointer;" onclick="let a = confirm('Confirmation Message to delete Song'); if(a == true){window.location.href='delete-song.php?id='+<?php echo $row2['id']; ?>;}"><i class="fas fa-trash-alt text-danger"></i></a></td>
        </tr>

<?php
        }
    }else{
        echo '<h2 class="text-black">No Song Found</h2>';
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