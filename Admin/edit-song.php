<?php include_once "header.php"; ?>
<?php require "config.php"; ?>
<?php 

if(isset($_POST['submit'])){
    $id = $_POST['id'];
    $title = $_POST['title'];
    $category = $_POST['category'];
    $duration = $_POST['duration'];
    
    if(isset($_POST['song'])){
        $song = $_POST['song'];
    }
    $old_song = $_POST['old_song'];


    $_SESSION['song_title'] = $title;

    $song_success = false;
    $song_file_name = "";



    if(isset($song) && !empty($song)){
        // Uploading song start
        $song_uploadCirectory = "\upload\songs\\";
        $song_error = [];
        $song_fileExtensionsAllowed = ['mp3', 'mp4'];

        $song_fileName = $_FILES['song']['name'];
        $song_fileSize = $_FILES['song']['size'];
        $song_fileTmpName = $_FILES['song']['tmp_name'];
        $song_fileType = $_FILES['song']['type'];

        $song_fileExtension_temp = explode('.', $song_fileName);
        $song_fileExtension = end($song_fileExtension_temp);

        $song_uploadPath = $currentDirectory . $song_uploadCirectory . basename($song_fileName);

        if(!in_array($song_fileExtension, $song_fileExtensionsAllowed)){
            $errors[] = "This file extension is not allowed. Please upload a MP3 or MP4 file";
        }

        if($song_fileSize > 104857600){
            $song_erros[] = "File exceeds maxium size (100MB)";
        }

        if(empty($song_errors)){
            $song_didUpload = move_uploaded_file($song_fileTmpName, $song_uploadPath);

            if($song_didUpload){
                $song_success = true;
                $song_file_name = $song_fileName;
            }else{
                echo "An error occurred. Please contact the administrator.";
            }
        }else{
            foreach($song_errors as $error){
                echo $error . "These are errors"."\n";
            }
        }
        //Uploading song end

    }else{
        if($song_success == true){
            $old_song = $song_file_name;
        }

        $sql_edit = "UPDATE song SET 
        title = '{$title}',
        category = '{$category}',
        song = '{$old_song}',
        duration = '{$duration}'
        WHERE id = '{$id}' ";

        $res_edit = mysqli_query($conn, $sql_edit) or die("Query Failed!!");
        if($res_edit){
            unset($_SESSION['song_title']);
            echo '<div id="hide" class="alert alert-success">Song Updated Successfully</div>';
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
        <?php if(isset($_GET['id'])){ 
            $id = $_GET['id'];
            $sql_get = "SELECT * FROM song WHERE id = '{$id}'";
            $res_get = mysqli_query($conn, $sql_get);
            if(mysqli_num_rows($res_get) > 0){
                while($row_get = mysqli_fetch_assoc($res_get)){
            
            ?>
        <form action="<?php $_SERVER['PHP_SELF']; ?>" method="post" enctype="multipart/form-data">
                <h2 class="text-white mb-3 mt-0">Edit Song</h2>

                <div class="mb-3 mt-2">
                    <input type="hidden" name="id" value="<?php echo $row_get['id']; ?>" >
                    <input type="text" class="form-control" name="title" id="title"  value="<?php if(isset($_SESSION['song_title'])){echo $_SESSION['song_title'];}else{ echo $row_get['title'];} ?>">
                </div>

                <div class="mb-3 mt-2">
                    <select name="category" id="category" class="form-control" placeholder="Choose Category">
                        <option disabled>Select Category</option>
                        <?php
                            $sql_cat = "SELECT * FROM category";
                            $res_cat = mysqli_query($conn, $sql_cat);
                            
                            if($res_cat){
                                while($row_cat = mysqli_fetch_assoc($res_cat)){
                        ?>

                        <option value="<?php echo $row_cat['id']; ?>" <?php if($row_cat['name'] == $row_get['category']){echo'selected';} ?>><?php echo $row_cat['name']; ?></option>
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
                    <p class="alert alert-warning p-1 m-0 mb-1">Selected : <?php echo $row_get['song']; ?></p>
                    <input type="hidden" name="old_song" value="<?php echo $row_get['song']; ?>">
                    <input type="file" class="form-control" name="song" id="song">
                </div>

                <div class="mb-3 mt-2">
                    <label for="" class="text-white">Song Duration</label>
                    <input type="text" class="form-control" name="duration" id="duration" placeholder="Enter Song Duration"
                    value="<?php echo $row_get['duration']; ?>">
                </div>
                <input class="btn btn-warning mt-3" name="submit" type="submit" value="Save">
                <button class="btn btn-danger mt-3" type="reset" style="float:right;">Reset</button>
            </form>

            <?php
        }
        }
        
        
        }else{echo'<h1 class="alert alert-danger">Something Went Wrong</h1>';} ?>
        </div>
    </div>
</div>
<?php include_once "footer.php"; ?>