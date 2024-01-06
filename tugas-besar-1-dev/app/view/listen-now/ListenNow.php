<?php
require_once $_ENV['PWD'] . '/app/view/browse/lib.php';
require_once $_ENV['PWD'] . '/app/service/SongService.php';
require_once $_ENV['PWD'] . '/app/service/ArtistService.php';
require_once $_ENV['PWD'] . '/app/service/SubscriptionService.php';
require_once $_ENV['PWD'] . '/app/clients/RestClient.php';
if (!isset($_SESSION['user_id'])) {
    header('Location: /');
}
if (isset($_GET['song_id'])) {
    $songService = SongService::getInstance();
    $artistService = ArtistService::getInstance();
    $song_id = $_GET['song_id'];
    $audio = $songService->getSongByID($song_id);
    $audio_cover_art = "../../../upload/" . basename($audio['cover_art']);
    $audio_title = $audio['title'];
    $audio_path = basename($audio['file_path']);
}
if (isset($_GET['podcast_id'])) {
    $subscribed_podcaster = SubscriptionService::getInstance()->getSubscribedPodcast($_SESSION['user_id']);
    $isSubscribed = false;

    foreach ($subscribed_podcaster as $creator) {
        $podcastDetails = RestClient::getPodcastByPodcasterId($creator['creator_id'])->data;

        foreach ($podcastDetails->produced_podcasts as $podcast) {
            if ($podcast->podcast_id == $_GET['podcast_id']) {
                $isSubscribed = true;
                break;
            }
        }
    }

    if (!$isSubscribed) {
        header('Location: /403page');
    }

    $podcast_id = $_GET['podcast_id'];
    $podcast = RestClient::getPodcast($podcast_id);
    $arr = $podcast->data;
    $audio_title = $arr->podcast_title;
    $audio_cover_art = $arr->cover_art;
    $audio_path = basename($arr->audio_file_path);
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Averia+Serif+Libre:ital,wght@0,400;0,700;1,400;1,700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../../../public/styles/listen_now.css">
    <link rel="stylesheet" type="text/css" href="../../../public/styles/navbar.css">
    <link rel="stylesheet" type="text/css" href="../../../public/styles/browse.css">
</head>

<body>
    <div class="nav">
        <?php require_once $_ENV['PWD'] . '/app/view/navbar/navbar.php' ?>
    </div>
    <?php
    echo_right_navbar(basename($_SESSION['profile_picture']));
    ?>
    <div class="listen-now">
        <div class="song-control">
            <div class="entity">
                <?php $img = $audio_cover_art; ?>
                <img class="cover-art" src="<?php echo $audio_cover_art; ?>" alt="song-cover-art">
                <h2 class="song"><?php echo $audio_title ?></h2>
            </div>
            <?php $path = $audio_path ?>
            <audio id="song" src="../../../upload/<?php echo $path; ?>"></audio>
            <div class="controller">
                <button id="previous">
                    <img src="../../../public/img/prev.svg" alt="prev-icon">
                </button>
                <button id="playPause">
                    <img src="../../../public/img/play.svg" alt="play-icon">
                </button>
                <button id="next">
                    <img src="../../../public/img/next.svg" alt="next-icon">
                </button>
            </div>
            <div class="time-volume-container">
                <div class="seek-container">
                    <div class="time">
                        <span id="currentTime">0:00</span>
                        <div class="duration-slider">
                            <input type="range" class="duration-input" id="seek" min="0" max="100">
                            <div class="overlay" id="overlay"></div>
                            <div class="dot" id="dot"></div>
                        </div>
                        <span id="duration">0:00</span>
                    </div>
                </div>
                <div class="volume">
                    <img src="../../../public/img/speaker.svg" alt="speaker-icon">
                    <div class="volume-control-container">
                        <input id="volumeSlider" type="range" min="0" max="100" value="100">
                        <div class="volume-line" id="volume-line"></div>
                        <div class="volume-dot" id="volume-dot"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script defer src="../../../public/javascript/listen_now/song_control.js"></script>

</body>

</html>