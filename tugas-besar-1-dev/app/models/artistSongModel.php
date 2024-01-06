<?php
class artistSongModel extends baseModel{
    private $artist_id;
    private $song_id;
    public function __constructor(){
        parent::__construct();
        parent::$primaryKey= ['artist_id', 'song_id'];

    }

    public function populateFromAssosiativeArr($arr){
        $this->artist_id = $arr['artist_id'];
        $this->song_id = $arr['song_id'];
    }

    public function getAssosiativeArray(){
        $arr = array(
            'artist_id' => $this->artist_id,
            'song_id' => $this->song_id
        );
        return $arr;
    }
}



?>