<?php
    require_once $_ENV['PWD'] . '/app/view/browse/lib.php';
    require_once $_ENV['PWD'] . '/app/service/SongService.php';
    require_once $_ENV['PWD'] . '/app/service/AlbumService.php';

    $album_id = $_GET['id'];
    $songService = SongService::getInstance();
    $albumService = AlbumService::getInstance();
    $allSongs = $songService->getSongsByAlbumID($album_id);
    $title = $albumService->getAlbumByID($album_id)['title'];




?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Songs of Album</title>
    <link rel="stylesheet" type= "text/css" href="../../../public/styles/navbar.css">
    <link rel="stylesheet" type="text/css" href = "../../../public/styles/browse.css">
</head>
<body>
<div class="all-contents">
        <div class = "nav">
            <?php require_once $_ENV["PWD"] . "/app/view/navbar/navbar.php" ?>
        </div>
        <div class="container">
            <?php  echo_right_navbar(basename($_SESSION['profile_picture'])); ?>
            <h1>Songs of Album <?php echo $title ?></h1>
            <div class="card-container">
                <?php
                foreach ($allSongs as $song) {
                    $song_title = $song['title'];
                    $file_name = basename($song['cover_art']);
                    $file_path = "../../../upload/" . $file_name;
                    $id = $song['song_id'];
                ?>
                    <a href="/listen-now?song_id=<?php echo $id?>">
                        <div class="img-container">
                            <img class="profile" src="<?php echo $file_path; ?>" alt="photo-profile">
                            <p class="judulLagu"><?php echo $song_title; ?></p>

                        </div>
                    </a>
                <?php
                }
                ?>
            </div>
            
            <div class = "pagination">
            <?php 
                for ($i = 1; $i <= $numOfPages; $i++) : ?>
                    <a class="page-number" href="?page=<?= $i; ?>"><?= $i; ?></a>
            <?php
            endfor;
            ?>
            </div>
        </div>
        


    </div>
    
</body>
</html>