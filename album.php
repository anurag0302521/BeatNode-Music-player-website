<?php include_once 'header.php';  ?>
<?php include_once 'admin/config.php';  
?>
<head>
    <link rel="stylesheet" href="./CSS/style.css">

</head>
<style>
.hero{
    display: flex;
    flex-direction:column;
    justify-content: center;
    align-items: center;
    text-align: center;
}
.new{
    border-radius: 8px;
}
</style>

        <?php 
        
            $pid = $_GET['id'];
            $sql_fetch = "SELECT * FROM album where album_id = ".$pid;
            $res_fetch = mysqli_query($conn, $sql_fetch) or die("Query failed");
            if(mysqli_num_rows($res_fetch) > 0){
                while($row_fetch = mysqli_fetch_assoc($res_fetch)){
                    
            ?>
            <div class="container">
                <div class="row">
                    <div class="col hero mt-5" >
                    <img src="image/<?php echo $row_fetch['album_img'];?>" height="400px" width="300px"class="mb-3 new">
                    <div class="name">

                        <h1 style="color:white"><?php echo $row_fetch['album_name']; ?></h1>
                    </div>
                    </div>
                </div>
            </div>
            <?php } }  ?>
            <div class="container">
                <div class="row mt-5">
                    <div class="col-12">
            <table class="table">
                <thead>
                    <tr style="border-bottom: 3px solid white;">
                    <th scope="col" style="color:white">Title</th>
                    <th scope="col" style="color:white">Category</th>
                    <th scope="col" style="color:white">Song</th>
                    </tr>
                </thead>
                <tbody>
            <hr>
            <?php 
            $pid = $_GET['id'];
            $sql_fetch = "SELECT * FROM song1 where album_id = ".$pid;
            $res_fetch = mysqli_query($conn, $sql_fetch) or die("Query failed");
            if(mysqli_num_rows($res_fetch) > 0){
                while($row_fetch = mysqli_fetch_assoc($res_fetch)){
                    
            ?>
                <tr  style="border-bottom: 1px solid rgba(192,192,192);">
                    <td><h6 id="title" style="color:white"><?php echo $row_fetch['title'];  ?></h6></td>
                    <td><h6 id="category" style="color:white"><?php echo $row_fetch['category'];  ?></h6></td>
                    <td><audio src="admin\upload\songs\<?php echo $row_fetch['song'];  ?>" controls></audio></td>
                   
            </tr>
            <?php } }  ?>

            
                </tbody>
                </table>
        </div>
    </div>
</div>

<?php include_once'footer.php'; ?>