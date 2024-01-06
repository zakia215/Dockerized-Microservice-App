<?php
class playlistModel extends baseModel{
    private $playlist_id;
    private $title;
    private $description;
    private $created_by;
    private $created_at;

    public function __construct(){
        parent::__construct();
        parent::$primaryKey = ['playlist_id'];
    }
    public function populateFromAssosiativeArr($arr){
        $this->playlist_id = $arr['playlist_id'];
        $this->title = $arr['title'];
        $this->description = $arr['description'];
        $this->created_by = $arr['created_by'];
        $this->created_at = $arr['created_at'];
    }
    public function getAssosiativeArray(){
        $arr = array(
            'playlist_id' => $this->playlist_id,
            'title' => $this->title,
            'description' => $this->description,
            'created_by' => $this->created_by,
            'created_at' => $this->created_at
        );
        return $arr;
    }

}



?>