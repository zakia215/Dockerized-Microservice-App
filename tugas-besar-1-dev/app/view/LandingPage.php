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
    <link rel="stylesheet" href="../../../public/styles/landing-page/landing.css">
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
            <div class="welcome-container">
                <h1>Welcome!</h1>
                <p>
                    Lorem Ipsum is simply dummy text of the printing and typesetting industry.
                    Lorem Ipsum has been the industry's standard dummy text ever since the 1500s
                </p>
                <div class="button-container">
                    <form action="/login" method="post">
                        <button type="submit" class="login">Log in</button>
                    </form>
                    <form action="/signup" method="post">
                        <button type="submit" class="signup">Sign up</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>

</html>