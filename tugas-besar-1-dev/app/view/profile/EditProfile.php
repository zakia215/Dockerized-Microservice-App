<?php
    require_once $_ENV['PWD'] . '/app/view/browse/lib.php';
   $tes= ($_SESSION['is_admin']);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Profile</title>
    <link rel="stylesheet" type= "text/css" href="../../../public/styles/navbar.css">
    <link rel="stylesheet" type="text/css" href = "../../../public/styles/browse.css">
    <link rel="stylesheet" type="text/css" href = "../../../public/styles/profile/profile.css">
    <link rel="stylesheet" type="text/css" href = "../../../public/styles/components.css">
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
                    <h1>Edit Profile</h1>
                    <form id = "edit-profile-form">
                    <div class="username_info">
                        <div class="image-container" id="image-container-profile">
                            <?php  $photo = basename($_SESSION['profile_picture']); ?>
                            <img src="../../../upload/<?php echo $photo ?>" alt="" class="artist-pic" id="image-profile-picture">
                            <div id="profile-mask-edit"></div>
                            <h2 id="edit-photo-profile">Edit Photo</h2>
                            <input type="file" name= "imgFile" id="imgFileInputProfile" accept="image/*" style="display: none;">
                        </div>
                        <div class="username-info-container">
                            <label for="username-info">Username : </label>
                            <input type="text" name = "username-info" id = "username-info" value = <?php echo $_SESSION ['username'] ?>>
                        </div>
                        <div class="password-info-container">
                            <label for="password-info">Password : </label>
                            <input type="password" name= "password-info" id = "password-info">
                        </div>
                        <div class="confirm-password-info-container">
                            <label for="confirm-password-info">Confirm Password : </label>
                            <input type="password" name= "confirm-password-info" id = "confirm-password-info">
                        </div>
                    </div>
                 
                    <div class="all-buttons">
                        <div class="save-button">
                            <button type = "submit" id = "save-button">Save</button>
                        </div>
                        </form>
                    </div>
                    

                </div>
                
        </div>
        
</div>
    <script src="../../../../../public/javascript/util.js"></script>
    <script src = "../../../../../public/javascript/edit-profile.js"></script>
</body>
</html>