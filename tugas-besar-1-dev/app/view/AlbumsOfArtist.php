<?php
    require_once $_ENV['PWD'] . '/app/view/browse/lib.php';
    require_once $_ENV['PWD'] . '/app/service/AlbumService.php';
    require_once $_ENV['PWD'] . '/app/service/ArtistService.php';
    $albumService = AlbumService::getInstance();
    $artistService = ArtistService::getInstance();
    $artist_id = $_GET['id'];
    $artist_name = $artistService->getArtistByID($artist_id)['name'];
    $albumsByArtistID = $albumService->getAlbumByArtistID($artist_id);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Albums of Artist</title>
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
            <h1>Albums By <?php echo $artist_name ?></h1>
            <div class="card-container">
                <?php
                foreach ($albumsByArtistID as $album) {

                    $title = $album['title'];
                    $editButton = '';
                    $deleteButton = '';
                    $file_name = basename($album['cover_art']);
                    $file_path = "../../../upload/" . $file_name;
                    $id = $album['album_id'];
                ?>
                    <a href="/song-of-album?id=<?php echo $id ?>">
                        <div class="img-container">
                            <img class="profile" src="<?php echo $file_path; ?>" alt="photo-profile">
                            <p class="judulLagu"><?php echo $title; ?></p>
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