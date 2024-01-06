<?php

class RestClient{
    private static $url = "http://host.docker.internal:3000";
    public static function post($_url, $_data){
        $ch = curl_init($_url);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($_data));
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER,true);

        $result = curl_exec($ch);
        curl_close($ch);
        return $result;
    }
    public static function get($_url){
        $ch = curl_init($_url);
        curl_setopt($ch, CURLOPT_URL, $_url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
        $result = curl_exec($ch);
        curl_close($ch);
        return $result;

    }
    public static function getPodcasters(){
        $complete_url = self::$url.'/api/v1/podcaster';
        $result = self::get($complete_url);
        return json_decode($result);
    }
    public static function getPodcast($podcast_id){
        $complete_url = self::$url ."/api/v1/podcast/$podcast_id";
        $result = self::get($complete_url);
        return json_decode($result);
    }

    public static function getPodcastByPodcasterID( $podcasterID ){
        $complete_url = self::$url."/api/v1/podcaster/$podcasterID";
        $result = self::get($complete_url);
        return json_decode($result);
    }
}

?>