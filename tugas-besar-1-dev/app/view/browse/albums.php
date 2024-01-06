<?php

    require_once $_ENV['PWD'] . '/app/view/browse/lib.php';
    require_once $_ENV['PWD'] . '/app/service/AlbumService.php';
    require_once $_ENV['PWD'] . '/app/service/ArtistService.php';

    if(!isset($_SESSION['user_id'])){
        header('Location: /');
    }
    $AlbumService = AlbumService::getInstance();
    $ArtistService = ArtistService::getInstance();

    // Get the total number of albums
    $numAllAlbums = $AlbumService->getNumOfRows()[0]['count'];

    $numOfAlbumsPerPage = 18;
    $numOfPages = ceil($numAllAlbums / $numOfAlbumsPerPage);
    $active_page = (isset($_GET["page"]) && is_numeric($_GET["page"])) ? intval($_GET["page"]) : 1;
    $firstAlbum = ($numOfAlbumsPerPage * $active_page) - $numOfAlbumsPerPage;
    $albumsToShow = $AlbumService->getSomeOfRowsByLimit($firstAlbum, $numOfAlbumsPerPage);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Browse songs</title>
    <link rel="stylesheet" type= "text/css" href="../../../public/styles/navbar.css">
    <link rel="stylesheet" type="text/css" href = "../../../public/styles/browse.css">
</head>
<body>
    <div class= "all-contents">
        <div class = "nav">
            <?php include __DIR__ . '/../navbar/navbar.php'?>
        </div>
        <div class = "container">
            <?php echo_right_navbar(basename($_SESSION['profile_picture'])); ?>
            <h1>Albums</h1>

            <div class = "card-container">
            <?php
                foreach ($albumsToShow as $album) {
                    $id = $album['album_id'];
                    $album_name = $album['title'];
                    $file_name = basename($album['cover_art']);
                    $editButton = '';
                    $deleteButton = '';
                    $file_path = "../../../upload/" . $file_name;
                    if($_SESSION['is_admin']){
                        $editButton = "<a href = '/edit-album?id=$id'><button class='edit-button'>Edit</button> </a>";
                        $deleteButton = "<button album-id=$id class='delete-button'>Delete</button>";
                    }
                ?>
                    <a href="/song-of-album?id=<?php echo $id ?>">
                        <div class="img-container">
                            <img class="profile" src="<?php echo $file_path; ?>" alt="">
                            <p class="judulLagu"><?php echo $album_name; ?></p>
                            <p class = "artistName"><?php echo $ArtistService->getArtistNameByAlbumID($id)['name'];?></p>
                            <div class = "button-container">
                            <?php echo $editButton ?>
                            <?php echo $deleteButton ?>
                            </div>
                        </div>
                    </a>
                <?php
                }
                ?>
            </div>
            <?php 
                if($_SESSION['is_admin']){
                    echo '<a href = "/add-album"><button class = "add-entity-button">Add Albums</button></a>';
                }
            ?>

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
    


    <script src="../../../../../public/javascript/util.js"></script>
    <script src = "../../../../../public/javascript/album.js"></script>
</body>
</html>