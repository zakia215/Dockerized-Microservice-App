<?php
    require_once $_ENV['PWD'] . '/app/view/browse/lib.php';
    if(!isset($_SESSION['is_admin'])){
        header('Location: /');
    }
    if(!$_SESSION['is_admin']){
        header('Location: /403page');
    }
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Spotiplay - Discover your favorite music</title>
    <link rel="stylesheet" href="../../../public/styles//add-artist/addartist.css">
    <link rel="stylesheet" type="text/css" href="../../../public/styles/navbar.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Averia+Serif+Libre:ital,wght@0,400;0,700;1,400;1,700&display=swap" rel="stylesheet">
    <link rel="stylesheet" type= "text/css" href="../../../public/styles/navbar.css">
    <link rel="stylesheet" type="text/css" href = "../../../public/styles/browse.css">
</head>

<body>
    <div class="nav">
        <?php require_once $_ENV['PWD'] . "/app/view/navbar/navbar.php" ?>
    </div>
    <div class="container">
        <?php echo_right_navbar(basename($_SESSION['profile_picture'])); ?>
        <form id="add-artist-form" method = "post">
            <div class="artist-name">
                <input type="text" id="artistName" name="artistName" placeholder="Artist Name">
                <button type="button" id="edit-artist-name">Edit</button>
            </div>
            <div class="image-container" id="image-container">
                <img src="../../../public/img/foto_jahim_1.jpg" alt="sample-photo" class="artist-pic" id="artist-profile">
                <div id="profile-mask"></div>
                <h2 id="edit-photo">Edit Photo</h2>
                <input type="file" name= "imgFile" id="imgFile" accept="image/*" style="display: none;">
            </div>
            <button type = "submit" id = "submit-button" name = "submit-button">Save</button>
        </form>
    </div>
    <script src="../../../../../public/javascript/util.js"></script>
    <script src = "../../../../../public/javascript/add_artist.js"></script>
</body>

</html>