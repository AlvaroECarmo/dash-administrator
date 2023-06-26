<?php

namespace App\Http\Controllers\API\Search;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Fluent;

class SearchYoutubeAPI extends BaseSeach
{
    public function index()
    {
        $videoLists = self::_videoListsAll();


        return $videoLists;
    }

    public function seraching(Request $request)
    {


        $pesquisa = self::explodeWord($request->input('term', ''));

        $data = $this->_videoLists($pesquisa);

        $search = array();
        foreach ($data->items as $i) {

            $id = (new Fluent((new Fluent($i))['id']))['videoId'];
            $title = (new Fluent((new Fluent($i))['snippet']))['title'];
            $context = (new Fluent((new Fluent($i))['snippet']))['description'];
            $thumbnails = (new Fluent((new Fluent($i))['snippet']))['thumbnails'];

            $high = (new Fluent((new Fluent($thumbnails))['high']))['url'];



            // ['high']['url']

            $search[] = [
                'id' => $id, 'text' => $title,
                'context' => $context, 'details' => $high
            ];
        }
        // 'context' => $attr['snippet']['description'],
        // 'details' => $attr['snippet']['thumbnails']['high']['url'],
        return ['results' => new Fluent($search)];


    }


    public function results(Request $request)
    {
        session(['search_query' => $request->search_query]);
        $videoLists = $this->_videoLists($request->search_query);
        return view('results', compact('videoLists'));
    }

    public function watch($id)
    {
        $singleVideo = $this->_singleVideo($id);
        if (session('search_query')) {
            $videoLists = $this->_videoLists(session('search_query'));
        } else {
            $videoLists = $this->_videoLists('laravel chat');
        }
        return view('watch', compact('singleVideo', 'videoLists'));
    }

    // We will get search result here

    /**
     * <?php
     * require_once "config.php";
     *
     * $arr_list = array();
     * if (array_key_exists('channel', $_GET) && array_key_exists('max_result', $_GET)) {
     * $channel = $_GET['channel'];
     * $url = "https://www.googleapis.com/youtube/v3/search?channelId=$channel&order=date&part=snippet&type=video&maxResults=". $_GET['max_result'] ."&key=". GOOGLE_API_KEY;
     * $arr_list = getYTList($url);
     * }
     * ?>
     */
    public static function _videoListsAll(): void
    {
        $part = 'snippet';
        $country = 'BD';
        $apiKey = config('services.youtube.api_key');
        $maxResults = 12;
        $channelId = 'UCBJnqOPNlG4CFyCS0n7mezA';
        $youTubeEndPoint = config('services.youtube.search_endpoint');
        $type = 'video'; // You can select any one or all, we are getting only videos


        //2CcontentDetails

        $url = "$youTubeEndPoint?channelId=$channelId&order=date&part=snippet&type=$type&maxResults=$maxResults&key=" . $apiKey;

        $response = Http::get($url);
        $results = json_decode($response);

        // We will create a json file to see our response

        if ((bool)$results) {
            File::put(storage_path() . '/app/public/RESTYOUTUBE.json', $response->body());

        } else {
            File::put(storage_path() . '/app/public/1YoutError.json', $response->body());
        }


    }

    protected function _videoLists($keywords)
    {
        $part = 'snippet';
        $country = 'BD';
        $apiKey = config('services.youtube.api_key');
        $maxResults = 12;
        $channelId = 'UCBJnqOPNlG4CFyCS0n7mezA';
        $youTubeEndPoint = config('services.youtube.search_endpoint');
        $type = 'video'; // You can select any one or all, we are getting only videos


        $url = "$youTubeEndPoint?channelId=$channelId&order=date&part=$part&maxResults=$maxResults&regionCode=$country&type=$type&key=$apiKey&q=$keywords";


        $response = Http::get($url);
        $results = json_decode($response);

        // We will create a json file to see our response
        File::put(storage_path() . '/app/public/RESTYOUTUBE00112.json', $response->body());
        return $results;
    }

    protected function _singleVideo($id)
    {
        $apiKey = config('services.youtube.api_key');
        $part = 'snippet';
        $url = "https://www.googleapis.com/youtube/v3/videos?part=$part&id=$id&key=$apiKey";
        $response = Http::get($url);
        $results = json_decode($response);

        // Will create a json file to see our single video details
        File::put(storage_path() . '/app/public/single.json', $response->body());
        return $results;
    }


    public static function singlevideo($id)
    {
        $apiKey = config('services.youtube.api_key');
        $part = 'snippet';
        $url = "https://www.googleapis.com/youtube/v3/videos?part=$part&id=$id&key=$apiKey";
        $response = Http::get($url);
        $results = json_decode($response);

        // Will create a json file to see our single video details
        File::put(storage_path() . '/app/public/single.json', $response->body());
        return $results;
    }
}
