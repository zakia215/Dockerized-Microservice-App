<?php
require_once $_ENV['PWD'] . '/app/view/browse/lib.php';
require_once $_ENV['PWD'] . '/app/clients/RestClient.php';
if(!isset($_SESSION["user_id"]) || $_SESSION["is_admin"]) {
    header('Location: /');
}
echo $_SESSION['user_id'];

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>All Podcasters</title>
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
            <h1>Podcasters</h1>
            <div class="card-container" id = "card-container"> 
            </div>
        </div>
    </div>
    <div class="page-number-container">
    </div>

    
    
</body>
<script>
        const  userId=<?php echo json_encode($_SESSION['user_id']); ?>
</script>
<script defer src = "../../../public/javascript/util.js"></script>
<script defer src = "../../../public/javascript/browse_podcasters.js"></script>
    
</html>