<?php
    require_once $_ENV['PWD'] . '/app/view/browse/lib.php';
    require_once $_ENV['PWD'] . '/app/service/AlbumService.php';
    require_once $_ENV['PWD'] . '/app/service/SongService.php';
    require_once $_ENV['PWD'] . '/app/service/ArtistService.php';
    if(!isset($_SESSION['user_id'])){
        header('Location: /');
    }
    $albumService = AlbumService::getInstance();
    $songService = SongService::getInstance();
    $artistService = ArtistService::getInstance();

    $_7album = $albumService->get7Rows();
    $_7song = $songService->get7Rows();
    $_7artist = $artistService->get7Rows();


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Browse Music</title>
    <link rel="stylesheet" type= "text/css" href="../../../public/styles/navbar.css">
    <link rel="stylesheet" type="text/css" href = "../../../public/styles/browse.css">
</head>
<body>
    <div class ="all-contents">
        <div class = "nav">
            <?php require_once $_ENV["PWD"] . "/app/view/navbar/navbar.php" ?>
        </div>
        <div class = 'container'>
            <?php echo_right_navbar(basename($_SESSION['profile_picture'])); ?>
            <h1>Browse</h1>
            <div class= "songs-summary-container">
                <a href="/browse/song"><h2>Songs ></h2></a>
                <div class = "songs-summary">
                    <!-- use query function to get top 7 new songs -->
                    <?php
                    foreach($_7song as $song){ // use query function to get all album from db
                    $img = basename($song['cover_art']);
                    $judul = $song['title'];
                    $id = $song['song_id'];
                    $artistName = $artistService->getArtistNameBySongID($id)['name'];
                    echo "<a href='/listen-now?song_id=$id'>
                    <div class = 'img-container'>
                        <img class = 'profile' src='../../../upload/$img' alt=''>
                        <p class = 'judulLagu'>$judul</p>
                        <p class = 'artistName'>$artistName</p>
                    </div>
                    </a>";
                    
                    }
                    ?>

                </div>

            </div>
            <div class= "artists-summary-container">
                <a href="/browse/artist"><h2>Artists ></h2></a>
                <div class = "artists-summary">
                    <!-- use query function to get top 7 new artists -->
                    <?php
                    foreach($_7artist as $artist){ // use query function to get all album from db
                    $name = $artist['name'];
                    $id = $artist['artist_id'];
                    $img = basename($artist['profile_picture']);
                    echo "<a href='/album-of-artist?id=$id'>
                    <div class = 'img-container'>
                        <img class = 'profile' src='../../../upload/$img' alt='artist-photo'>
                        <p class = 'judulLagu'>$name</p>


                    </div>
                    </a>";
                    
                    }
                    ?>
                    
                </div>

            </div>
            <div class = "albums-summary-container">
                <a href="/browse/album"><h2>Albums ></h2></a>
                                    <!-- use query function to get top 7 new albums -->
                <div class = 'albums-summary'>
                    <?php
                    foreach($_7album as $album){ // use query function to get all album from db
                    $albumName = $album['title'];
                    $img = basename($album['cover_art']);
                    $id = $album['album_id'];
                    $artistName = $artistService->getArtistNameByAlbumID($id)['name'];
                    echo "<a href='song-of-album?id=$id'>
                    <div class = 'img-container'>
                        <img class = 'profile' src='../../../upload/$img' alt='album-photo'>
                        <p class = 'judulLagu'>$albumName</p>
                        <p class = 'artistName'>$artistName</p>

                    </div>
                    </a>";
                    
                    }
                    ?>
                </div>
            </div>
    
        </div>

    </div>
    
</body>
</html>