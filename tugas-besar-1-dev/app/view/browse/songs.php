<?php
require_once $_ENV['PWD'] . '/app/view/browse/lib.php';
if(!isset($_SESSION['user_id'])){
    header('Location: /');
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Browse songs</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Averia+Serif+Libre:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="../../../public/styles/navbar.css">
    <link rel="stylesheet" type="text/css" href="../../../public/styles/browse.css">
    <link rel="stylesheet" type="text/css" href="../../../public/styles/page_number.css">
</head>

<body>
    <div class="all-contents">
        <div class="nav">
            <?php require_once __DIR__ . '/../navbar/navbar.php' ?>
        </div>
        <div class="container">
            <?php 
            echo_right_navbar(basename($_SESSION['profile_picture']));
            ?>
            <h1>Songs</h1>

            <!-- <?php echo_search_sort('Song'); ?> -->
            <form method="get" id="search-form">
                <div class="search-sort">
                    <div class="search-box">
                        <button type="submit" id="submit-button"><img src="../../../public/img/search.svg" alt="search-icon"></button>
                        <input type="text" name="search-key" id="search-key">
                    </div>
                    <div class="search-by">
                        <select name="search-song-by" id="search-song-by" class="dropdown">
                            <option value="title" selected>Search by</option>
                            <option value="title">Title</option>
                            <option value="artist">Artist</option>
                        </select>
                        <button type="button" id="custom-dropdown">
                            <img src="../../../public/img/dropdown_button.svg" alt="dropdown-button-img">
                        </button>
                    </div>
                    <div class="sort">
                        <select name="sort-song" id="sort-song" class="dropdown">
                            <option value="" selected>Sort by</option>
                            <option value="title">Title</option>
                            <option value="artist">Artist</option>
                        </select>
                        <button type="button" id="custom-dropdown">
                            <img src="../../../public/img/dropdown_button.svg" alt="dropdown-button-img">
                        </button>
                        <button type="button" id="sort-order-button">
                            <img src="../../../public/img/sort.svg" alt="sort-button-img">
                        </button>
                        <input type="checkbox" id="is-asc" name="is-asc" style="display: none;">
                    </div>
                    <div class="filter">
                        <select name="filter-genre" id="filter-genre" class="dropdown">
                            <option value="" selected>Genre</option>
                            <option value="Pop">Pop</option>
                            <option value="RnB">RnB</option>
                            <option value="Dangdut">Dangdut</option>
                            <option value="Country">Country</option>
                        </select>
                        <button type="button" id="custom-dropdown">
                            <img src="../../../public/img/dropdown_button.svg" alt="drop-down-button">
                        </button>
                    </div>
                    <div class="filter" id="filter-release-date-container">
                        <select name="filter-release-date" id="filter-release-date" class="dropdown">
                            <option value="" selected>Release Date</option>
                            <option value="1">This Month</option>
                            <option value="12">This Year</option>
                            <option value="120">Last 10 Years</option>
                        </select>
                        <button type="button" id="custom-dropdown">
                            <img src="../../../public/img/dropdown_button.svg" alt="dropdown-button">
                        </button>
                    </div>
                </div>
            </form>

            <div class="card-container" id="card-container">

            </div>
            <?php 
                if($_SESSION['is_admin']){
                    echo '<a href="/add-song"><button class="add-entity-button" style="
                    font-family: Averia Serif Libre;
                    line-height: normal;
                    background-color:#ffdc34;
                    color: black;
                    padding: 10px;
                    font-weight: bold;
                    border-radius: 30px;">Add Song</button></a>';
                }
            ?>
            <input type="text" name="selected-page" id="selected-page" style="display: none;">
            
        </div>
    </div>
    <div class="page-number-container">
    </div>

    <script defer src="../../../public/javascript/util.js"></script>
    <script defer src="../../../public/javascript/browse_song.js"></script>
    <!-- <script src="../../../public/javascript/edit_delete_song.js"></script> -->
</body>

</html>