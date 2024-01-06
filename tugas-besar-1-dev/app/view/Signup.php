<?php
    if (isset($_SESSION['user_id'])) {
        header('Location: /browse');
    }
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Spotiplay - Discover your favorite music</title>
    <link rel="stylesheet" href="../../../public/styles//signup//signup.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Averia+Serif+Libre:ital,wght@0,400;0,700;1,400;1,700&display=swap" rel="stylesheet">
</head>

<body>
    <div class="main-container">
        <div class="container-l">
            <div class="header-container">
                <img src="../../../public/img/spotiplay.svg" alt="spotiplay-logo">
                <h1>Spotiplay</h1>
            </div>
        </div>
        <div class="container-r">
            <div class="login-container">
                <h1>Sign up</h1>
                <form method="post" id="register-form" enctype="multipart/form-data">
                    <div class="form-label username-container">
                        <label for="username">Username</label>
                        <input type="text" id="username" name="username">                        
                    </div>
                    <div class="form-label password-container">
                        <label for="password">Password</label>
                        <div class="password-input">
                            <input type="password" id="password" name="password" class="secret">
                            <button type="button" class="peek" id="peek-password">
                                <img src="../../../public/img/peek.svg" alt="peek-icon">
                            </button>
                        </div>
                    </div>
                    <div class="form-label password-container">
                        <label for="confirmpassword">Confirm Password</label>
                        <div class="password-input">
                            <input type="password" id="confirmpassword" name="confirmpassword" class="secret">
                            <button type="button" class="peek" id="peek-confirm">
                                <img src="../../../public/img/peek.svg" alt="peek-icon">
                            </button>
                        </div>
                    </div>
                    <div class="profile-pic-container">
                        <label class="form-label" for="file">Profile Picture</label>
                        <div class="file-input-field" id="file-input-field">
                            <button class="choose-file" id="choose-file-button" type="button">File</button>
                            <p class="chosen-file">example.png</p>
                        </div>
                        <input type="file" name="profile-pic" id="profile-pic" style="display: none;" accept="image/*">
                    </div>
                    <div class="sign-up-as-admin">
                        <input type="checkbox" name="is_admin" id="is_admin">
                        <label for="is_admin">Register as admin</label>
                    </div>
                    <h3 class="warning" style="display: none;" id="error">This is a warning</h3>
                    <button type="submit" class="signup">Sign up</button>
                </form>
            </div>
        </div>
    </div>
    <script src="../../../public/javascript/util.js"></script>
    <script src="../../../public/javascript/signup_button.js"></script>
    <script src="../../../public/javascript/signup_api.js"></script>
</body>

</html>