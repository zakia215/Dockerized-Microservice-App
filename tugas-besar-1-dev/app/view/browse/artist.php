<?php
require_once $_ENV['PWD'] . '/app/view/browse/lib.php';
require_once $_ENV['PWD'] . '/app/service/ArtistService.php';
if(!isset($_SESSION['user_id'])){
    header('Location: /');
}
$ArtistService = ArtistService::getInstance();

// Get the total number of artists
$numAllArtists = $ArtistService->getNumOfRows()[0]['count'];

$numOfArtistPerPage = 18;
$numOfPages = ceil($numAllArtists / $numOfArtistPerPage);
$active_page = (isset($_GET["page"]) && is_numeric($_GET["page"])) ? intval($_GET["page"]) : 1;
$firstArtist = ($numOfArtistPerPage * $active_page) - $numOfArtistPerPage;
$artistToShow = $ArtistService->getSomeOfRowsByLimit($firstArtist, $numOfArtistPerPage);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Browse songs</title>
    <link rel="stylesheet" type="text/css" href="../../../public/styles/navbar.css">
    <link rel="stylesheet" type="text/css" href="../../../public/styles/browse.css">
</head>
<body>
    <div class="all-contents">
        <div class="nav">
            <?php require_once $_ENV["PWD"] . "/app/view/navbar/navbar.php" ?>
        </div>
        <div class="container">
            <?php  echo_right_navbar(basename($_SESSION['profile_picture'])); ?>
            <h1>Artists</h1>

            <div class="card-container">
                <?php
                foreach ($artistToShow as $artist) {
                    $id = $artist['artist_id'];
                    $artist_name = $artist['name'];
                    $editButton = '';
                    $deleteButton = '';
                    $file_name = basename($artist['profile_picture']);
                    $file_path = "../../../upload/" . $file_name;
                    $id = $artist['artist_id'];
                    if($_SESSION['is_admin']) {
                        $editButton = "<a href = '/edit-artist?id=$id'><button class='edit-button'>Edit</button> </a>";
                        $deleteButton = "<button artist-id=$id class='delete-button'>Delete</button>";
                    }
                ?>
                    <a href="/album-of-artist?id=<?php echo $id?>">
                        <div class="img-container">
                            <img class="profile" src="<?php echo $file_path; ?>" alt="photo-profile">
                            <p class="judulLagu"><?php echo $artist_name; ?></p>
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
                    echo '<a href = "/add-artist"><button class = "add-entity-button">Add Artists</button></a>';
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
    <script src = "../../../../../public/javascript/artist.js"></script>
</body>
</html>
