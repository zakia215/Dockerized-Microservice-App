<?php
    require_once $_ENV['PWD'] . '/app/view/browse/lib.php';
    require_once $_ENV['PWD'] . '/app/service/ArtistService.php';
    require_once $_ENV['PWD'] . '/app/service/AlbumService.php';
    if(!isset($_SESSION['is_admin'])){
        header('Location: /');
    }
    if(!$_SESSION['is_admin']){
        header('Location: /403page');
    }
    $artistService = ArtistService::getInstance();
    $albumService = AlbumService::getInstance();
    $artists = $artistService->getAllArtists();
    $albums = $albumService->getAllAlbums();

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
    <link rel="stylesheet" type="text/css" href = "../../../public/styles/components.css">
</head>

<body>
    <div class="nav">
        <?php require_once $_ENV['PWD'] . "/app/view/navbar/navbar.php" ?>
    </div>
    <div class="container">
        <?php echo_right_navbar(basename($_SESSION['profile_picture'])); ?>
        <form id="add-song-form" class = "add-form">
            <div class="component-name">
                <input type="text" id="songTitle" class = "componentName" name="songTitle" placeholder="Song Title">
                <button type="button" id="edit-song-title" class = "editButton">Edit</button>
            </div>
            <div class = "dropdown-container">
                <label for="artist_id">
                    Artist Name
                </label>
                <select name="artist_id_song" id="artist_id_song" class = "dropdown-list">
                    <?php foreach($artists as $artist){
                        echo '<option value = "' . $artist['artist_id'] . '">' . $artist['name'] . '</option>';
                    }
                    ?>
                </select>
            </div>
            <div class="dropdown-container">
                <label for="artist_id">
                    Album Title
                </label>
                <select class= "dropdown-list" name="album_id_song" id="album_id_song">
                    <?php 
                        foreach($albums as $album){
                            echo '<option value = "' . $album['album_id'] . '">' . $album['title'] . '</option>';
                        }
                    ?>
                </select>
            </div>

            <div class="image-container" id="image-container-song">
                <img src="../../../public/img/foto_jahim_1.jpg" alt="sample-photo" class="cover_art" id="cover_art_song">
                <div id="profile-mask-song"></div>
                <h2 id="edit-photo-song">Edit Photo</h2>
                <input type="file" name= "imgFileSong" id="imgFileSongInput" accept="image/*" style="display: none;">
            </div>
            <div class="dropdown-container">
                <label for="genre-song">
                    Genre
                </label>
                <select class= "dropdown-list" name="genre-song" id="genre-song">
                    <option value="Pop">Pop</option>
                    <option value="RnB">RnB</option>
                    <option value="Dangdut">Dangdut</option>
                    <option value="Country">Country</option>
                </select>
            </div>
            <div class="audio-container">
                <label for="audio-song-file">
                    Audio File
                </label>
                <div class="file-input-field" id="audio-input-field">
                    <button class="choose-file" id="choose-audio-button" type="button">File</button>
                    <p class="chosen-file">example.png</p>
                </div>
                <input type="file" name="audio-song-file" id="audio-song-file" style="display: none;" accept="audio/*">

            </div>

            <button type = "submit" id = "submit-button-song" name = "submit-button">Save</button>
        </form>
    </div>
    <script src="../../../../../public/javascript/util.js"></script>
    <script src = "../../../../../public/javascript/add-song.js"></script>
</body>

</html>