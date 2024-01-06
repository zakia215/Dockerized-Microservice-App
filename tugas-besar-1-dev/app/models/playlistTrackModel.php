<?php
class playlistTrackModel extends baseModel{
    private $playlist_id;
    private $song_id;
    private $date_added;

    public function __construct(){
        parent::__construct();
        parent::$primaryKey= ['playlist_id', 'song_id'];
    }

    public function populateFromAssosiativeArr($arr){
        $this->playlist_id = $arr['playlist_id'];
        $this->song_id = $arr['song_id'];
        $this->date_added = $arr['date_added'];
    }
    public function getAssosiativeArray(){
        $arr = array(
            'playlist_id' => $this->playlist_id,
            'song_id' => $this->song_id,
            'date_added' => $this->date_added
        );
        return $arr;
    }

}

?>