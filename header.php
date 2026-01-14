<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>BEATNODE</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css"
        integrity="sha512-PgQMlq+nqFLV4ylk1gwUOgm6CtIIXkKwaIHp/PAIWHzig/lKZSEGKEysh0TCVbHJXCLN7WetD8TFecIky75ZfQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="CSS/style.css">
    
    
</head>
<style>
    
    #navbar_u img{
            display: block;
            width: 65px;
            height: 65px;
            margin: auto;
            margin-left:15px;
            /* position: relative; */
            right: 6px;
            /* position: sticky; */
            
            /* top: 0; */
            border-radius: 50%;
            font-style:normal;
            text-shadow:none;
            font-family: 'Forum', cursive;
  
        }
        #navbar_u img.user1{
            width: 50px;
            height: 50px;
        }
    
        @import url('https://fonts.googleapis.com/css2?family=Forum&display=swap');

        a.navbar-brand i{
            font-style:normal;
            text-shadow:none;
            font-family: 'Forum', cursive;
        }
        .user{
            justify-content: flex-end;
            display: flex;
            padding-left: 170px;
            
        }
        .extra{
            margin-top:9px;
        }
        
       
       ​

</style>

<body>
<div class="bg-dark header-container">
        <div class="container-fluid">
            <nav class="navbar navbar-expand-lg navbar-dark" id="navbar_u">
                <div class="container-fluid">
                <img src="image/logo.png" alt="logo"/ height="30px">
                    <a class="navbar-brand" href="index.php" style="text-shadow: 2px 4px 8px red;font-size: 30px "><i>BEATNODE</i></a>
                    /* <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup"
                        aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                        <div class="navbar-nav"> */
                            <a class="nav-link active extra" aria-current="page" href="index.php">Home</a>
                            <?php
                            if(!isset($_SESSION)){
                                session_start();
                            }

                            if(isset($_SESSION['email'])){
                                echo '<a class="nav-link extra" href="add-favorite.php">Add Favorite</a>';
                                echo '<a class="nav-link extra" href="logout.php">Logout</a>';
                            }else{
                                echo '<a class="nav-link extra" href="login.php">Login</a>';
                                echo '<a class="nav-link extra" href="signup.php">Signup</a>';
                            }  ?>
                            /* -------------- */
                            <?php 
            if(isset($_SESSION['email'])){
                
                echo '<h5 class="text-white navbar-collapse collapse w-250 order-2 dual-collapse2 user"><img class="user1" src="image/logo4.png" alt="logo">'.$_SESSION['name'].'</h5> class="text-white">';
                
            }?>
                            
                        </div>
                        
                    </div>
                </div>
            </nav>
        </div>
</div>