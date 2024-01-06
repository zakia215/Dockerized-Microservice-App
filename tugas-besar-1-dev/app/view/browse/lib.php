<?php

function echo_right_navbar($profile_picture)
{
    $html = <<<EOT
    <div class="right-navbar">
        <div class="right-navbar-container">
            
            <button class="logout-button" onclick="window.location.href = '/logout'" >
                Logout
            
            </button>
            
            <a href="/profile">
                <img class="profile-navbar" src="../../../upload/$profile_picture" alt="photo-profile">
            </a>
        </div>
    </div>
EOT;

    echo $html;
}


function echo_search_sort($category)
{
    $html = <<<EOT
    <div class="search-sort">
    <div class="search-box">
        <button type="submit"><img src="../../../public/img/Search.png" alt="search-icon"></button>
        <input type="text" placeholder="Search...">
    </div>
    EOT;
    if ($category == 'Song' or $category == 'Album') {
        $html .= <<<EOT
        <div class= "sort">
        EOT;
        if ($category == 'Song') {
            $html .= <<<EOT
            <select name="sort-song" id="sort-song" class= "dropdown">
            EOT;
        } else if ($category == 'Album') {
            $html .= <<<EOT
            <select name="sort-album" id="sort-album" class= "dropdown">
            EOT;
        }
        $html .= <<<EOT
            <option selected>Sort by</option>
            <option value="$category name ascending"> $category name ascending</option>
            <option value="$category name descending"> $category name descending</option>
            <option value="artist ascending">Artist ascending</option>
            <option value="artist descending">Artist descending</option>
        </select>
        </div>
            <div class = "filter">
                <select name="filter-genre" id="filter-genre" class= "dropdown">
                    <option selected>Genre</option>
                    <option value="Pop">Pop</option>
                    <option value="RnB">RnB</option>
                    <option value="Electric">Electric</option>
                    <option value="JPop">JPop</option>
                </select>
            </div>
            <div class = "filter">
                <select name="filter-artist" id="filter-artist" class= "dropdown">
                    <option selected>Artist</option>
                    <option value="Taylor Sqift">Taylor Sqift</option>
                    <option value="Adam Levis">Adam Levis</option>
                </select>
            </div>
        </div> 
        EOT;
    } else {
        $html .= <<<EOT
            <div class= "sort">
            <select name="sort-song" id="sort-song" class= "dropdown">
                <option selected>Sort by</option>
                <option value="artist ascending">Artist ascending</option>
                <option value="artist descending">Artist descending</option>
            </select>
            </div>
            </div> 
            EOT;
    }



    // using query function to retrieve all songs


    echo $html;
}



function podcast_container($podcast){
    $podcast_id = $podcast->podcast_id;
    $podcast_name = $podcast->title;
    $podcast_cover_art = $podcast->cover_art;
    // TODO: nanti fotonya harus diganti sama foto yang sebenarnya
    $html = <<<EOT
    <a href="/listen-now?podcast_id={$podcast_id}">
        <div class = "img-container">
            <img class = "profile" src="$podcast_cover_art" alt="podcaster-img"> 
            <p class = "judulLagu">$podcast_name</p>
        </div>
    </a>
    EOT;

    return $html;
}

function podcaster_container($podcaster, $podcaster_arr){
    if ($podcaster_arr == null) {
        $podcaster_id = $podcaster->podcaster_id;
        $podcaster_name = $podcaster->name;
        $podcaster_cover_art = $podcaster->cover_art;
        // TODO: nanti fotonya harus diganti sama foto yang sebenarnya
        $html = <<<EOT
        <div>
            <div class = "img-container">
                <img class = "profile" src="$podcaster_cover_art" alt="podcaster-img"> 
                <p class = "judulLagu">$podcaster_name</p>
                <div class = "button-container">
                    <button class='subscribe-button' data-id = {$podcaster_id}>Subscribe</button> 
                </div>
            </div>
        </div>
        EOT;
    
        return $html;
    } else {
        $podcaster_id = $podcaster->podcaster_id;

        // Check if $podcaster_id exists in the $podcaster_arr
        $isInArray = false;
        foreach ($podcaster_arr as $creator) {
            if ($creator['creator_id'] == $podcaster_id) {
                $isInArray = true;
                break;
            }
        }

        if ($isInArray) {
            $podcaster_name = $podcaster->name;
            $podcaster_cover_art = $podcaster->cover_art;

            $html = <<<EOT
            <a href="/podcasts?podcaster_id={$podcaster_id}">
                <div class="img-container subscribed-podcaster" data-id={$podcaster_id}>
                    <img class="profile" src="$podcaster_cover_art" alt="podcaster-img"> 
                    <p class="judulLagu">$podcaster_name</p>
                </div>
            </a>
            EOT;

            return $html;
        } else {
            // If $podcaster_id is not in the array, return an empty string or handle it as needed.
            return '';
        }
    }
}

function song_container($song, $artist, $session)
{
    $song_title = $song['title'];
    $artist_id = $song['artist_id'];

    // Find artist_name in $artist with artist_id
    $song_artist = '';
    foreach ($artist as $a) {
        if ($a['artist_id'] == $artist_id) {
            $song_artist = $a['artist_name'];
            break;
        }
    }

    $song_title = $song['title'];
    $cover_art = basename($song['cover_art']);
    $id = $song['song_id'];
    $editButton = '';
    if ($session) {
        $editButton = "<a href = '/edit-song?id=$id'><button class='edit-button'>Edit</button> </a>";
    }
    $html = <<<EOT
    <a href="/listen-now?song_id=$id">
        <div class = "img-container">
            <img class = "cover-art" src="../../../upload/$cover_art" alt="song-cover">
            <p class = "judulLagu">$song_title</p>
            <p class = "artistName">$song_artist</p>
            <div class = "button-container">
            $editButton
            </div>
        </div>
    </a>
    EOT;

    return $html;
}

function page_container($currentPage, $totalPage)
{
    $html = '';
    $html .= <<<EOT
        <a class="page-num-nav next-prev-container">
            <div class="next-prev">
                <img src="../../../public/img/prev_page.svg" alt="prev-icon">
            </div>
        </a>
        EOT;
    if ($totalPage <= 11) {
        for ($i = 1; $i <= $totalPage; $i++) {
            if ($i == $currentPage) {
                $toAdd = " selected-page";
            } else {
                $toAdd = "";
            }
            $html .= <<<EOT
            <a class="page-num-nav$toAdd">
                <div class="page-num-container">
                    <p>$i</p>
                </div>
            </a>
            EOT;
        }
    } else {
        if ($currentPage <= 5 || $currentPage >= $totalPage - 4) {
            for ($i = 1; $i <= 5; $i++) {
                if ($i == $currentPage) {
                    $toAdd = " selected-page";
                } else {
                    $toAdd = "";
                }
                $html .= <<<EOT
                <a class="page-num-nav$toAdd">
                    <div class="page-num-container">
                        <p>$i</p>
                    </div>
                </a>
                EOT;
            }

            $html .= <<<EOT
                <div class="filler-dot">
                    <p>...</p>
                </div>
            EOT;


            for ($i = $totalPage - 4; $i <= $totalPage; $i++) {
                if ($i == $currentPage) {
                    $toAdd = " selected-page";
                } else {
                    $toAdd = "";
                }
                $html .= <<<EOT
                <a class="page-num-nav$toAdd">
                    <div class="page-num-container">
                        <p>$i</p>
                    </div>
                </a>
                EOT;
            }
        } else {
            for ($i = 1; $i <= 2; $i++) {
                $html .= <<<EOT
                <a class="page-num-nav">
                    <div class="page-num-container">
                        <p>$i</p>
                    </div>
                </a>
                EOT;
            }
            $html .= <<<EOT
                <div class="filler-dot">
                    <p>...</p>
                </div>
            EOT;

            for ($i = $currentPage - 2; $i <= $currentPage + 2; $i++) {
                if ($i == $currentPage) {
                    $toAdd = " selected-page";
                } else {
                    $toAdd = "";
                }
                $html .= <<<EOT
                <a class="page-num-nav$toAdd">
                    <div class="page-num-container">
                        <p>$i</p>
                    </div>
                </a>
                EOT;
            }

            $html .= <<<EOT
                <div class="filler-dot">
                    <p>...</p>
                </div>
            EOT;

            for ($i = $totalPage - 1; $i <= $totalPage; $i++) {
                $html .= <<<EOT
                <a class="page-num-nav">
                    <div class="page-num-container">
                        <p>$i</p>
                    </div>
                </a>
                EOT;
            }
        }
    }
    $html .= <<<EOT
        <a class="page-num-nav next-prev-container">
            <div class="next-prev">
                <img src="../../../public/img/next_page.svg" alt="next-icong">
            </div>
        </a>
        EOT;

    return $html;
}
