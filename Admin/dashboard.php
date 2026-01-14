<?php include_once "header.php"; 
include_once "config.php"; 
if(!isset($_SESSION['admin_email'])){
    header("Location: index.php");
}
?>


<!-- Box Count Container start -->
<div class="container overflow-hidden mt-2">
    <div class="row gx-3">
        <div class="col">
            <div class="card bg-primary">
                <div class="card-body ">
                    <h5 class="card-title d-inline-block">Total Songs</h5>
                    <i class="fas fa-music fs-5" style="float:right;margin-left:auto;padding:10px;"></i>
                    <hr>
                    <h5>
                        <?php 
                        $sql_song_couunt = "SELECT id FROM song";
                        $res_song_count = mysqli_query($conn, $sql_song_couunt);
                        if($res_song_count){
                            echo mysqli_num_rows($res_song_count);
                        }else{
                            echo "000";
                        }
                        ?>
                    </h5>
                </div>
            </div>
        </div>

        <div class="col">
            <div class="card bg-primary">
                <div class="card-body ">
                    <h5 class="card-title d-inline-block">Total Category</h5>
                    <i class="fa fa-list-alt fs-5" style="float:right;margin-left:auto;padding:10px;"></i>
                    <hr>
                    <h5>
                        <?php 
                        $sql_song_couunt = "SELECT id FROM category";
                        $res_song_count = mysqli_query($conn, $sql_song_couunt);
                        if($res_song_count){
                            echo mysqli_num_rows($res_song_count);
                        }else{
                            echo "000";
                        }
                        ?>
                    </h5>
                </div>
            </div>
        </div>

        <div class="col">
            <div class="card bg-primary">
                <div class="card-body ">
                    <h5 class="card-title d-inline-block">Total Admin</h5>
                    <i class="fas fa-user-tie fs-5" style="float:right;margin-left:auto;padding:10px;"></i>
                    <hr>
                    <h5>
                        <?php 
                        $sql_song_couunt = "SELECT id FROM admin";
                        $res_song_count = mysqli_query($conn, $sql_song_couunt);
                        if($res_song_count){
                            echo mysqli_num_rows($res_song_count);
                        }else{
                            echo "000";
                        }
                        ?>
                    </h5>
                </div>
            </div>
        </div>

        <div class="col">
            <div class="card bg-primary">
                <div class="card-body ">
                    <h5 class="card-title d-inline-block">Total User</h5>
                    <i class="fas fa-user fs-5" style="float:right;margin-left:auto;padding:10px;"></i>
                    <hr>
                    <h5>
                        <?php 
                        $sql_song_couunt = "SELECT id FROM user";
                        $res_song_count = mysqli_query($conn, $sql_song_couunt);
                        if($res_song_count){
                            echo mysqli_num_rows($res_song_count);
                        }else{
                            echo "000";
                        }
                        ?>
                    </h5>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Box Count Container end -->
<?php include_once "song.php"; 
?>



<?php include_once "footer.php"; 
?>