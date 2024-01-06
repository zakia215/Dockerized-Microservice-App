<?php
require_once $_ENV['PWD'] . '/app/service/ArtistService.php';

$artist_id = $_GET['id'];
$artisService = ArtistService::getInstance();
$artist = $artisService->getArtistByID($artist_id);
$name = $artist['name'];
$profilePic = $artist['profile_picture'];
?>
<?php
require_once $_ENV['PWD'] . '/app/view/browse/lib.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Profile</title>
    <link rel="stylesheet" type="text/css" href="../../../public/styles/navbar.css">
    <link rel="stylesheet" type="text/css" href="../../../public/styles/browse.css">
    <link rel="stylesheet" type="text/css" href="../../../public/styles/profile/profile.css">
    <link rel="stylesheet" type="text/css" href="../../../public/styles/components.css">
</head>

<body>
    <div class="all-contents">
        <div class="nav">
            <?php require_once $_ENV["PWD"] . "/app/view/navbar/navbar.php" ?>
        </div>

        <div class='container-profile'>

            <?php echo_right_navbar(basename($_SESSION['profile_picture'])); ?>

            <div class='container-profile-1'>
                <div class="items-profile">
                    <h1>Edit Artist</h1>
                    <form id="edit-profile-form">
                        <div class="username_info">
                            <div class="image-container" id="image-container-profile">
                                <?php $photo = $profilePic ?>
                                <img src="../../../upload/<?php echo basename($photo) ?>" alt="" class="artist-pic" id="image-profile-picture">
                                <div id="profile-mask-edit"></div>
                                <h2 id="edit-photo-profile">Edit Photo</h2>
                                <input type="file" name="imgFile" id="imgFileInputProfile" accept="image/*" style="display: none;">
                            </div>
                            <div class="username-info-container">
                                <label for="username-info">Artist name : </label>
                                <input type="text" name="username-info" id="username-info" value='<?php echo $name ?>' ?>>
                            </div>
                        </div>

                        <div class="all-buttons">
                            <div class="save-button">
                                <button type="submit" id="save-button">Save</button>
                            </div>
                    </form>
                </div>


            </div>

        </div>

    </div>
    <script>
        const artist_id = <?php echo $artist_id; ?>;
    </script>
    <script src="../../../../../public/javascript/util.js"></script>
    <script src="../../../../../public/javascript/edit-artist.js"></script>
</body>

</html>