<?php include_once 'header.php';  ?>
<?php include_once 'admin/config.php';  
//session_start();
?>
<head>
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
<script>
  AOS.init();
</script>
    <style>
        .song-list{
    max-height: 380px;
    overflow-y: scroll;

}
.popular-list{
    padding-left: 36px;
    margin-top:10px;
    padding-right: 36px;
    
}
 .img-new{
 
  width:100%;
  margin: 0 auto;
  white-space:nowrap;
  overflow-x:auto; 
  /* overflow-x: hidden; */
  
  
}
.hov:hover{
    transform: scale(1.0);
    box-shadow: 0 0 30px rgba(0, 0, 0, 0.5);
    height:200px;
}



    </style>
    
</head>

<div class="container-fluid new" style="margin-top:2%">
    <div class="row widgets new">
        <div class="col-md-3 col-4-border playlist" style="border-color:white" data-aos="fade-right">
            <h1 class="pt-3 pl-2" style="color: white">
                Playlist
                <hr>
                
            </h1>
            <ul class="song-list">
                <?php 
                $index = 0;
                $sql_song = "SELECT * FROM song order by id desc";
                $res_song = mysqli_query($conn, $sql_song) or die("Query Failed");
                if(mysqli_num_rows($res_song) > 0){
                    while($row_song = mysqli_fetch_assoc($res_song)){
                ?>
                        <li data-src="admin/upload/songs/<?php echo $row_song['song']; ?>" 
                        data-name="<?php echo $row_song['title']; ?>" 
                        data-index="<?php echo $index; ?>">
                        <span><?php echo $row_song['title']; ?></span>
                        <span style="float:right;"><?php echo $row_song['duration']; ?></span></li>
                <?php 
                    $index++;       
                    }
                }
                ?>
                <!-- <li data-src="songs/bin-tere.mp3" data-name="Bin Tere" data-index="0"><span>Bin
                        Tere</span><span>02:00</span></li>-->
            </ul>
            <audio src="" id="audio"></audio>
        </div>

        <div class="col-md-4 mt-4"  data-aos="fade-up">
            <div class="music-player">
                <div class="player">
                    <img src="image/beat.png" alt="" class="record">
                    <h4 id="title">Song Title</h4>
                    <div class="process-bar">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-2 p-0 m-0"><span id="start-time" >00:00</span></div>
                                <div class="col-8 p-0 m-0"><input id="process-bar-update" value="0" type="range" min="0" max="0" /> </div>
                                <div class="col-2 p-0 m-0"><span id="end-time">03:00</span></div>

                            </div>
                        </div>
                    </div>
                    <div class="container-fluid pb-3 mt-3">
                        <div class="row">
                            <div class="slidecontainer">
                                <i id="low-volume" class="fas fa-volume-down audio" ></i>
                                <input type="range" min="0" max="100" value="10" class=" slider slide">
                                <i class="fas fa-volume-up"></i>
                                
                            </div>
                        <div class="">
                                <div class="controls">
                                    <i id="" class="fas fa-music"   style="color: rgb(0, 170, 51);" title="Music" ></i>
                                    <i class="previous" id="previous"><i class="fas fa-step-backward" title="previous"></i></i>
                                    <i class="play-pause" id="play-pause"><i class="fas fa-play main-button" title="play"></i></i>
                                    <i class="next" id="next"><i class="fas fa-step-forward" title="next"></i></i>
                                    <i id="" class="fas fa-heart"  style="color: red;" title="Heart" ></i>
                                    
                                    
                                </div>
                            </div>
                           
                            
                        </div>
                        <!-- /*start*/ -->
                        <!-- <div class="row vol">

                            
                            <div class="col-4 lomusic">
                                

                            </div> -->
                            <!-- <div class="col-8">
                              

                            </div>
                            
                        </div> -->
                        <!-- close -->
                    </div>
                </div>
            </div>

        </div>

        <div class="col-md-3 col-4-border mr-2 sec-box" style="border-color:white" data-aos="fade-right">
            
            <?php 
            if(isset($_SESSION['email'])){
                echo '<b><h4 class="pt-3 pl-2 text-white text-center"><span class="text-center">Welcome</span> <br>'.$_SESSION['name'].'</h4></b><hr class="text-white">';
                echo '<h3 class="pt-1 pl-2" style="color: white">Favorite Songs</h3><hr class="text-white">';
                ?>
            <div class="playlist">
            <ul class="fav-song-list " >
                <?php 
                $index = 0;
                $sql_song = "SELECT * FROM favorite WHERE user_id = {$_SESSION['id']}";
                $res_song = mysqli_query($conn, $sql_song) or die("Query Failed");
                if(mysqli_num_rows($res_song) > 0){
                    while($row_song = mysqli_fetch_assoc($res_song)){
                ?>
                        <li data-src="admin/upload/songs/<?php echo $row_song['song']; ?>" 
                        data-name="<?php echo $row_song['title']; ?>" 
                        data-index="<?php echo $index; ?>">
                        <span><?php echo $row_song['title']; ?></span>
                        <span style="float:right;"><?php echo $row_song['duration']; ?></span></li>
                <?php 
                    $index++;       
                    }
                }
                ?>
            </ul>
            </div>
        <?php
            }else{
                echo '<h5 style="color:white"><b>Favorite Songs</b></h5><h5 style="color:white">Login required</h5>';
            }  
            ?>
            
            </hr>

        </div>
    </div>
</div>
<div>
    <div class="popular-list">
    <h1 style="color:white">Top Playlist</h1>
    <div>
    <section class="img-new">
  <div class="pic-container">
    <div class="pic-row">

<?php
    $sql_fetch = "SELECT * FROM album order by rand()";
    $res_fetch = mysqli_query($conn, $sql_fetch) or die("Query failed");
    if(mysqli_num_rows($res_fetch) > 0){
        while($row_fetch = mysqli_fetch_assoc($res_fetch)){
    ?>
  
    <a href="http://localhost/beatnode/album.php?id=<?php echo $row_fetch['album_id'];?>"> <img class="hov"  src="image/<?php echo $row_fetch['album_img'];?>" height="200px" width="200px" style="object-fit: cover;border-radius: 10px;" data-aos="zoom-in-right"> </a>
<?php } } ?>
    <!-- <a href="http://localhost/beatnode/add-favorite.php"><img src="image/tanha.jpg"></a>
    <a href="http://localhost/beatnode/add-favorite.php"><img src="image/images1.jpg"></a>
    <a href="http://localhost/beatnode/add-favorite.php"><img src="image/images1.jpg"></a>
    <a href="http://localhost/beatnode/add-favorite.php"><img src="image/images1.jpg"></a>
    <a href="http://localhost/beatnode/add-favorite.php"><img src="image/images1.jpg"></a>
    <a href="http://localhost/beatnode/add-favorite.php"><img src="image/images1.jpg"></a>
    <a href="http://localhost/beatnode/add-favorite.php"><img src="image/images1.jpg"></a>
    <a href="http://localhost/beatnode/add-favorite.php"><img src="image/images1.jpg"></a> -->
      
    </div>
  </div>
</section>
<div class="" >
    <h1 style="color:white">Artist</h1>
    <section class="art"data-aos="zoom-in-up">
        <img class="artist" id="nomar" src="image/images.jpeg" title="Arijit Singh">
        <img class="artist" src="image/alen1.jpg" title="Alan Walker">
        <img class="artist" src="image/bad.jpg" title="Badshah">
        <img class="artist" src="image/Sonu.jpg" title="Sonu Nigam">
        <img class="artist" src="image/atif.jpg" title="Atif Aslam">
        <img class="artist" src="image/justin.jpg" title="Justin Beiber">
        <img class="artist" src="image/kumar.jpg" title="Kumar Sanu">
        <img class="artist" src="image/kailash.jpg" title="Kailash Kher">
        <img class="artist" src="image/javed.jpg" title="Javed Ali">
        <img class="artist" src="image/shaan.jpg" title="Shaan">

        <!-- <img class="artist" src="image/shreya.jpg"> -->    


    </section>
</div>​
    </div>
    </div>
    
</div>

        
<?php include_once'footer.php'; ?>