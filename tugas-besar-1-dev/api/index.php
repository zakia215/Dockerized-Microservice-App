<?php

require_once $_ENV['PWD'] . '/app/init/bootstrap.php';

require_once $_ENV['PWD'] . '/app/router/ApiRouter.php';

require_once $_ENV['PWD'] . '/app/controller/auth/SignupController.php';
require_once $_ENV['PWD'] . '/app/controller/auth/LoginController.php';
require_once $_ENV['PWD'] . '/app/controller/upload/UploadController.php';
require_once $_ENV['PWD'] . '/app/controller/artist/AddArtistController.php';
require_once $_ENV['PWD'] . '/app/controller/artist/ArtistController.php';
require_once $_ENV['PWD'] . '/app/controller/browse/SongController.php';
require_once $_ENV['PWD'] . '/app/controller/album/AddAlbumController.php';
require_once $_ENV['PWD'] . '/app/controller/album/AlbumController.php';
require_once $_ENV['PWD'] . '/app/controller/song/AddSongController.php';
require_once $_ENV['PWD'] . '/app/controller/song/UpdateDeleteSongController.php';
require_once $_ENV['PWD'] . '/app/controller/auth/ProfileController.php';
require_once $_ENV['PWD'] . '/app/controller/podcaster/PodcasterController.php';
require_once $_ENV['PWD'] . '/app/controller/podcast/PodcastController.php';
require_once $_ENV['PWD'] . '/app/controller/subscription/SubscriptionController.php';
require_once $_ENV['PWD'] . '/app/controller/subscription/SoapSubscriptionController.php';
require_once $_ENV['PWD'] . '/app/controller/podcaster/PodcasterCallbackController.php';
require_once $_ENV['PWD'] . '/app/controller/podcaster/SubscribedPodcasterController.php';

$apiRouter = new ApiRouter();

// authentication
$apiRouter->addHandler('/api/signup', SignupController::getInstance(), []);
$apiRouter->addHandler('/api/profile/*', ProfileController::getInstance(), []);
$apiRouter->addHandler('/api/login', LoginController::getInstance(), []);

// file upload
$apiRouter->addHandler('/api/upload', UploadController::getInstance(), []);

// Adding entities
$apiRouter->addHandler('/api/add-artist', AddArtistController::getInstance(), []);
$apiRouter->addHandler('/api/add-album', AddAlbumController::getInstance(), []);
$apiRouter->addHandler('/api/add-song', AddSongController::getInstance(), []);

$apiRouter->addHandler('/api/edit-artist/*', AddArtistController::getInstance(), []);
$apiRouter->addHandler('/api/edit-album/*', AddAlbumController::getInstance(), []);
$apiRouter->addHandler('/api/edit-song/*', AddSongController::getInstance(), []);

// Update or Delete Entities
$apiRouter->addHandler('/api/browse/album/*', AlbumController::getInstance(), []);
$apiRouter->addHandler('/api/browse/artist/*', ArtistController::getInstance(), []);
// Browse
$apiRouter->addHandler('/api/browse/song', SongController::getInstance(), []);
$apiRouter->addHandler('/api/browse/song/*', SongController::getInstance(), []);
$apiRouter->addHandler('/api/all-podcasters', PodcasterController::getInstance(), []);
$apiRouter->addHandler('/api/podcasts/*', PodcastController::getInstance(), []);

$apiRouter->addHandler('/api/subscription/callback/*/*', SubscriptionController::getInstance(), []);
$apiRouter->addHandler('/api/subscription/callback', SubscriptionController::getInstance(), []);

$apiRouter->addHandler('/api/subscription', SoapSubscriptionController::getInstance(), []);

$apiRouter->addHandler('/api/podcaster/callback', PodcasterCallbackController::getInstance(), []);
$apiRouter->addHandler('/api/subscribed-podcaster', SubscribedPodcasterController::getInstance(), []);

$apiRouter->router($_SERVER['REQUEST_URI'], $_SERVER['REQUEST_METHOD']);