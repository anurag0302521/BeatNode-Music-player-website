<?php include_once "header.php"; ?>
<?php require "config.php"; ?>
<?php 

if(isset($_POST['submit'])){

     $title = mysqli_real_escape_string($conn, $_POST['title']);
    $category = mysqli_real_escape_string($conn, $_POST['category']);
    $duration = mysqli_real_escape_string($conn, $_POST['duration']);



    $error = array();
    $song_success = false;

    $song_fileName = $_FILES['song']['name'];
    $song_fileSize = $_FILES['song']['size'];
    $song_fileTmpName = $_FILES['song']['tmp_name'];
    $song_fileType = $_FILES['song']['type'];
    $song_fileExtension_temp = explode('.', $song_fileName);
    $song_fileExtension = end($song_fileExtension_temp);

    $song_fileExtensionsAllowed = array("mp3","mp4");

    if(in_array($song_fileExtension,$song_fileExtensionsAllowed) == false){
        $errors[] = "This extension file not allowed, Please choose a mp3,mp4 file";
    }

    if($song_fileSize > 104857600){
        $song_erros[] = "File exceeds maxium size (100MB)";
    }


    $song_newName = time()."-".basename($song_fileName);
    $song_uploadDirectory = "upload/songs/";

    if(empty($errors) == true)
    {
        move_uploaded_file($song_fileTmpName,'C:\\xampp\\htdocs\\BeatNode\\admin\\upload\\songs\\'.$song_newName);
        $song_success = true;
    }else{
        print_r($error);
        die();
    }

    if($song_success == true){
    $sql_save = "INSERT INTO song(title,category,song,duration) VALUES('{$title}', '{$category}','{$song_newName}','{$duration}')";
    
    $res_save = mysqli_query($conn, $sql_save);

    if($res_save){
        
        unset($_SESSION['song_title']);
        echo '<div id="hide" class="alert alert-success">Song Added Successfully</div>';
        header("refresh:2; url=song.php");

    }else{
        echo '<div id="hide" class="alert alert-danger">Something went wrong!!</div>';

    }
  }
}
?>
<div class="container">
    <div class="row" style="margin-top:50px;">

    </div>
        <div class="offset-md-2 col-md-8 p-3 bg-dark" style="border:2px solid black;border-radius:10px;">
        <form action="<?php $_SERVER['PHP_SELF']; ?>" method="post" enctype="multipart/form-data">
                <h2 class="text-white mb-3 mt-0">Add Song</h2>

                <div class="mb-3 mt-2">
                    <input type="text" class="form-control" name="title" id="title" placeholder="Enter Song Title" value="<?php if(isset($_SESSION['song_title'])){echo $_SESSION['song_title'];} ?>" required>
                </div>

                <div class="mb-3 mt-2">
                    <select name="category" id="category" class="form-control" placeholder="Choose Category" required>
                        <option disabled>Select Category</option>
                        <?php
                            $sql_cat = "SELECT * FROM category";
                            $res_cat = mysqli_query($conn, $sql_cat);
                            
                            if($res_cat){
                                while($row_cat = mysqli_fetch_assoc($res_cat)){
                        ?>

                        <option value="<?php echo $row_cat['id']; ?>"><?php echo $row_cat['name']; ?></option>
                        <?php
                                }
                            }else{
                                echo '<option>No Category Found!</option>';
                            }
                        ?>
                    </select>
                </div>
                <div class="mb-3 mt-2">
                <label for="" class="form-lable text-white">Song : </label>

                    <input type="file" class="form-control" name="song" id="song" required>
                </div>

                
                <div class="mb-3 mt-2">
                    <label for="Duration" class="text-white">Song Duration</label>
                    <input type="text" class="form-control" name="duration" id="duration" placeholder="00:00:00" required>
                </div>

                <input class="btn btn-warning mt-3" name="submit" type="submit" value="Add">
                <button class="btn btn-danger mt-3" type="reset" style="float:right;">Reset</button>
            </form>
        </div>
    </div>
</div>
<?php include_once "footer.php"; ?>