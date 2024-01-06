<?php

require_once $_ENV['PWD'] . '/app/controller/BaseController.php';
require_once $_ENV['PWD'] . '/app/service/SongService.php';
require_once $_ENV['PWD'] . '/app/view/browse/lib.php';

class SongController extends BaseController {
    protected static $instance = null;

    private function __construct($songService) {
        parent::__construct($songService);
    }

    public static function getInstance() {
        if (self::$instance == null) {
            self::$instance = new SongController(
                SongService::getInstance()
            );
        }
        return self::$instance;
    }

    public function get($urlParams) {
        $searchKey = $_GET['search-key'] ?? '';
        $searchBy = $_GET['search-by'] ?? '';
        $sort = $_GET['sort-attribute'] ?? '';
        $isAsc = $_GET['is-asc'] ?? '';
        $filterGenre = $_GET['genre'] ?? '';
        $filterReleaseDate = $_GET['date'] ?? '';
        $pageNumber = $_GET['page'] ?? 1;
        $pageLimit = $_GET['limit'] ?? 3;

        $songs = $this->service->getSongs($searchKey, $searchBy, $sort, $isAsc, $filterGenre, $filterReleaseDate, $pageNumber, $pageLimit);
        $artist = $this->service->getArtists();
        $allPages = ceil($this->service->countSongs($searchKey, $searchBy, $sort, $isAsc, $filterGenre, $filterReleaseDate) / $pageLimit);

        $html = '';
        foreach($songs as $song) {
            $html .= song_container($song, $artist, $_SESSION['is_admin']);
        }

        $html .= '<div id="separator"></div>';
        
        $html .= page_container($pageNumber, $allPages);

        echo $html;
    }

    public function put($urlParams) {
        $song_id = $urlParams[0];

        parse_str(file_get_contents('php://input'), $_PUT);

        if (isset($_PUT['title'])) {
            $title = $_PUT['title'];
        } else {
            $title = '';
        }
        if (isset($_PUT['file_path'])) {
            $filePath = $_PUT['file_path'];
        } else {
            $filePath = '';
        }
        if (isset($_PUT['cover_art'])) {
            $coverArt = $_PUT['cover_art'];
        } else {
            $coverArt = '';
        }
        if (isset($_PUT['album_id'])) {
            $albumId = $_PUT['album_id'];
        } else {
            $albumId = '';
        }
        if (isset($_PUT['artist_id'])) {
            $artistId = $_PUT['artist_id'];
        } else {
            $artistId = '';
        }
        if (isset($_PUT['genre'])) {
            $genre = $_PUT['genre'];
        } else {
            $genre = '';
        }

        $res = $this->service->updateSong($song_id, $title, $filePath, $coverArt, $albumId, $genre, $artistId);

        return (new Response(true, "successfully updated", $res, 200))->json();
    }

    public function delete($urlParams) {
        $song_id = $urlParams[0];

        echo $song_id;
        $res = $this->service->deleteSongByID($song_id);

        return (new Response(true, "successfully deleted", $res, 200))->json();
    }


}