<?php
require_once $_ENV['PWD'] . '/app/view/browse/lib.php';
if(!isset($_SESSION['user_id'])){
    header('Location: /');
}
$profile_picture = $_SESSION['profile_picture']
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type= "text/css" href="../../../public/styles/navbar.css">
    <link rel="stylesheet" type="text/css" href = "../../../public/styles/browse.css">
    <link rel="stylesheet" type="text/css" href = "../../../public/styles/profile/profile.css">
    <link rel="stylesheet" type="text/css" href = "../../../public/styles/components.cssde">
    <title>My Profile</title>
</head>
<body>
<div class ="all-contents">
        <div class = "nav">
            <?php require_once $_ENV["PWD"] . "/app/view/navbar/navbar.php" ?>
        </div>
        <div class = 'container-profile'>
            <?php echo_right_navbar(basename($_SESSION['profile_picture'])); ?>
            <div class = 'container-profile-1'>
                <div class="items-profile">
                    <h1>Profile</h1>
                    <div class="photo-profile">
                        <img src="../../../upload/<?php echo basename($profile_picture)?>" alt="">
                    </div>
                    <div class="username_info">
                        <p class= "username"> Username : <?php echo $_SESSION["username"]?></p> 

                    </div>
                    <div class="all-buttons" id= "all-buttons-profile">
                        <div class="delete-button-profile">
                            <button id = "deleteUser">Delete User</button>
                        </div>
                        <div class="edit-button-profile">
                            <a href = "/edit-profile"><button id = "editProfile">Edit Profile</button></a>
                        </div>
                    </div>

                </div>
                
            </div>
        </div>
</div>
    <script>
        const user_id = <?php echo $_SESSION['user_id']; ?>;
    </script>
    <script src="../../../../../public/javascript/util.js"></script>
    <script src = "../../../../../public/javascript/profile.js"></script>
</body>
</html>