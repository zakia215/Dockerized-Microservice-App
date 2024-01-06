<?php
require_once $_ENV['PWD'] . '/app/service/ArtistService.php';
require_once $_ENV['PWD'] . '/app/view/browse/lib.php';
if(!isset($_SESSION['is_admin'])){
    header('Location: /');
}
if(!$_SESSION['is_admin']){
    header('Location: /403page');
}
$artistService = ArtistService::getInstance();
$artists = $artistService->getAllArtists();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Spotiplay - Discover your favorite music</title>
    <link rel="stylesheet" href="../../../public/styles//edit-album/editalbum.css">
    <link rel="stylesheet" type="text/css" href="../../../public/styles/navbar.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Averia+Serif+Libre:ital,wght@0,400;0,700;1,400;1,700&display=swap" rel="stylesheet">
    <script src="../../../public//javascript//login//button.js"></script>
    <link rel="stylesheet" type= "text/css" href="../../../public/styles/navbar.css">
    <link rel="stylesheet" type="text/css" href = "../../../public/styles/browse.css">
    <link rel="stylesheet" type="text/css" href = "../../../public/styles/components.css">
</head>

<body>
    <div class="nav">
    <?php require_once $_ENV["PWD"] . "/app/view/navbar/navbar.php" ?>
    </div>
    <div class="container">
        <?php echo_right_navbar(basename($_SESSION['profile_picture'])); ?>
        <form id = "add-album-form" class= "add-form">
            <!-- <div class="all"> -->
            <div class="component-name">
                <input type="text" name="title" id= "title" class= "componentName" placeholder = "Album Name">
                <button type="button" id="edit-album-title" class = "editButton">Edit</button>
            </div>
            <div class="dropdown-container">
                <label for="artist_id">Select Artist</label>
                <select class= "dropdown-list" id= "artist_id" name="artist_id">
                <?php
                    foreach($artists as $artist){
                        echo '<option value="' . $artist['artist_id'] . '">' . $artist['name'] . '</option>';
                    }
                ?>
                </select>
            </div>
            <div class="image-container" id= "image-container-album">
                <img src="../../../public/img/foto_jahim_1.jpg" alt="sample-photo" class="cover_art" id="cover_art_album">
                <div id="profile-mask-album"></div>
                <h2 id="edit-photo-album">Edit Photo</h2>
                <input type="file" id="cover_art" name = "imgFileSong" accept="image/*">
            </div>
            <div class="description-container"></div>
                <textarea id = "description" name = "description" placeholder="Enter your description" required></textarea>
                
                <button type="submit" name = "submit-button" id = 'submit-button-album'>Save</button> 
            </div>
            
            
            
                  
            
             
            
        </form>

        
    </div>
    </form>
    <script src="../../../../../public/javascript/util.js"></script>
    <script src = "../../../../../public/javascript/add_album.js"></script>
</body>

</html>