<?php

namespace App\Http\Livewire\Dashboard;

use App\Http\Controllers\API\Search\SearchYoutubeAPI;
use App\Http\Livewire\Base\PaginatedComponent;
use App\Http\Livewire\Listas\Users\UserList;
use App\Models\GetJSON;
use App\Models\Parlamento\VideoYoutube;
use App\Models\User;
use Illuminate\Support\Fluent;
use Livewire\Component;

class Home extends PaginatedComponent
{
    use GetJSON;

    public $ideoSelect;
    public $videosYA;

    public function bootIfNotBooted()
    {
        try {
            SearchYoutubeAPI::_videoListsAll();

            if (!(new Fluent($this->parseEncode('RESTYOUTUBE.json', 'public/storage/')))->items) {
                SearchYoutubeAPI::_videoListsAll();
            }

        } catch (\Exception $d) {

        }

        $this->videosYA = (new Fluent($this->parseEncode('RESTYOUTUBE.json', 'public/storage/')))->items;
        $this->ideoSelect = $this->videosYA[0];
    }


    public function render()
    {
        $userList = User::paginate(10);
        return view('livewire.dashboard.home', [
            'usersLis' => $userList
        ]);
    }

    public function publicarVideo($attrY)
    {

        VideoYoutube::create([
            'title' => $attrY['snippet']['title'],
            'ifram' => $attrY['id']['videoId'],
            'context' => $attrY['snippet']['description'],
            'details' => $attrY['snippet']['thumbnails']['high']['url'],
            'src' => "https://www.youtube.com/embed/" . $attrY['id']['videoId']
        ]);

        // $this->dispatchBrowserEvent('send-success-video', ['message' => 'O ifram para apresentação do vedeo youtube foi inserido como sucesso!']);

        $this->moverImgPublish();
        $this->render();
    }


    public function moverImgPublish(): void
    {

        $indexData['header'] = [
            'Author' => "Centro de Informática",
            "Local" => "Assembleia Nacional de Angola",
            "_token" => csrf_token(),
            "Authentication" => \Auth::user()->name
        ];
        $indexData['body_header'] = VideoYoutube::orderBy('id', 'desc')->get();
        $indexData['body_content'] = VideoYoutube::orderBy('id', 'desc')->get();

        $dataSend = response()->json($indexData, 200, [
            'Content-Type' => 'application/json;charset=UTF-8',
            'Charset' => 'utf-8'
        ], JSON_UNESCAPED_UNICODE)->content();

        \Storage::disk('public')->put('json/VideosYoutube.json', $dataSend);

        $item = VideoYoutube::orderBy('id', 'desc')->first();

        $indexData2 = array();

        $indexData2['noticeCorrent']['header'] = [
            "h1" => $item->title,
            "img" => $item->details,
            "src" => $item->details,
            "codeTool" => true,
        ];

        $indexData2['notices'] = VideoYoutube::orderBy('id', 'desc')->get();

        $dataSend2 = response()->json($indexData2, 200, [
            'Content-Type' => 'application/json;charset=UTF-8',
            'Charset' => 'utf-8'
        ], JSON_UNESCAPED_UNICODE)->content();

        \Storage::disk('public')->put('json/Videos.json', $dataSend2);

        $this->dispatchBrowserEvent('send-success-video', ['message' => 'Foi publicado as alterações no site com sucesso!']);

    }
}
