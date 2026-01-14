<?php session_start(); ?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css"
        integrity="sha512-PgQMlq+nqFLV4ylk1gwUOgm6CtIIXkKwaIHp/PAIWHzig/lKZSEGKEysh0TCVbHJXCLN7WetD8TFecIky75ZfQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="../admin/CSS/style.css">
    <title>Beat Node | Admin</title>
    <script>
        function hideme(){
            setTimeout(() => {
                // document.getElementById("hide").style.display = "none";
                $('#hide').delay().slideUp(1000);
            }, 3000);
        }
    </script>
</head> 

<body>
    <div class="bg-dark">
        <div class="container">
            <nav class="navbar navbar-expand-lg navbar-dark">
                <div class="container-fluid">
                    <a class="navbar-brand" href="dashboard.php"> <a>BeatNode</a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup"
                        aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                        <div class="navbar-nav">
                            <a class="nav-link active" aria-current="page" href="dashboard.php">Home</a>
                            <!-- <a class="nav-link" href="song.php">Songs</a> -->
                            <a class="nav-link" href="user.php">Admin</a>
                            <a class="nav-link" href="category.php">Category</a>
                        </div>
                    </div>
                    <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                        <div class="navbar-nav" style="margin-left:auto;">
                            <p class="nav-link bg-primary text-white my-0 fs-6"><strong>Welcome : <?php echo $_SESSION['admin_name']; ?></strong></p>
                            <a class="nav-link" href="logout.php">logout</a>
                        </div>
                    </div>
                </div>
            </nav>
        </div>
    </div>