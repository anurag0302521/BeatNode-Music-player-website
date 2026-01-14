<?php include_once 'header.php';  ?>
<?php include_once 'admin/config.php';  
?>
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
<script>
  AOS.init();
</script>
<div class="container">
    <div class="row mt-5">
        <div class="col-12">
            <h1 style="color:white">Add Favorite</h1>
            <table class="table">
                <thead>
                    <tr>
                    <th scope="col" style="color:white">Title</th>
                    <th scope="col" style="color:white">Category</th>
                    <th scope="col" style="color:white">Song</th>
                    <th scope="col" style="color:white">Favorite</th>
                    <th scope="col" style="color:white">Action</th>
                    </tr>
                </thead>
                <tbody>
            <hr>
            <?php 
            
            $sql_fetch = "SELECT song.id,song.title,category.name,song.song FROM song LEFT JOIN category on song.category = category.id";
            $res_fetch = mysqli_query($conn, $sql_fetch) or die("Query failed");
            if(mysqli_num_rows($res_fetch) > 0){
                while($row_fetch = mysqli_fetch_assoc($res_fetch)){
                    $favorite = false;
                    $sql_check_fav = "SELECT song_id from favorite";
                    $res_check_fav = mysqli_query($conn, $sql_check_fav) or die("Query failed");
                    if(mysqli_num_rows($res_check_fav) > 0){
                        while($row_check_fav = mysqli_fetch_assoc($res_check_fav)){
                            if($row_fetch['id'] == $row_check_fav['song_id']){
                                $favorite = true;
                                break;
                            }
                        }
                    }
            ?>
                <tr>
                    <td><h6 id="title" style="color:white"><?php echo $row_fetch['title'];  ?></h6></td>
                    <td><h6 id="category" style="color:white"><?php echo $row_fetch['name'];  ?></h6></td>
                    <td><audio src="admin/upload/songs/<?php echo $row_fetch['song'];  ?>" controls></audio></td>
                    <td><?php if($favorite){echo '<i class="fas fa-heart fill-red"></i>';}  ?></td>
                    <td><a href="save-favorite.php?song_id=<?php echo $row_fetch['id'];  ?>" class="btn btn-warning"><i class='fas fa-heart'></i></a>
                    <a href="remove-favorite.php?song_id=<?php echo $row_fetch['id'];  ?>" class="btn btn-warning"><i class='fas fa-trash'></i></a></td>
            </tr>
            <?php } }  ?>

            
                </tbody>
                </table>
        </div>
    </div>
</div>

<?php include_once'footer.php'; ?>