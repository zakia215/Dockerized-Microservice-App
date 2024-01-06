<?php
    require_once $_ENV['PWD'] . '/app/view/browse/lib.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Subscribed Podcasters</title>
    <link rel="stylesheet" type="text/css" href="../../../public/styles/podcaster/subscribedpodcaster.css">
    <link rel="stylesheet" type="text/css" href="../../../public/styles/navbar.css">
    <link rel="stylesheet" type="text/css" href="../../../public/styles/browse.css">
</head>
<body>
    <div class="all-contents">
        <div class="nav">
            <?php require_once $_ENV["PWD"] . "/app/view/navbar/navbar.php"?>
        </div>
        <div class="container">
            <?php echo_right_navbar(basename($_SESSION["profile_picture"]));?>
            <h1>Subscribed Podcasters</h1>
            <div class="card-container" id = "card-container"> 
            </div>
        </div>
        <div class="page-number-container">
        </div>
            <!-- <div class="podcast-container"> 
                <img class="image" src="../../../public/img/bjorka.jpg">
                <div class="podcast-details">
                    <div class="title">
                        Happy Podcast
                    </div>
                    <div class="author">
                        Joe Rogan
                    </div>
                </div>
            </div>
            <div class="podcast-container2"> 
                <img class="image" src="../../../public/img/sakti.png">
                <div class="podcast-details">
                    <div class="title">
                        IF
                    </div>
                    <div class="author">
                        JerichoFletcher
                    </div>
                </div>
            </div>
        </div> -->
    </div>
    <div class="page-number-container">
    </div>
</body>
<script>
        const  userId= <?php echo json_encode($_SESSION['user_id']); ?>
</script>
<script defer src = "../../../public/javascript/util.js"></script>
<script defer src = "../../../public/javascript/subscribed_podcasters.js"></script>
    
</html>