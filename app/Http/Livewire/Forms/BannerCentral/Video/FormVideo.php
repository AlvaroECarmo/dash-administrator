<?php

namespace App\Http\Livewire\Forms\BannerCentral\Video;

use App\Http\Controllers\API\Search\SearchYoutubeAPI;
use App\Models\GetJSON;
use App\Models\Parlamento\VideoYoutube;
use Illuminate\Support\Fluent;
use Livewire\Component;

class FormVideo extends Component
{
    use GetJSON;

    public $data = array();
    public $ifram = null;
    public $videosYA = array();
    public $ideoSelect;
    public $videoImportId;
    public $videoImportName;
    public $context;
    public $details;

    public function mount(): void
    {
        if (!(new Fluent($this->parseEncode('RESTYOUTUBE.json', 'public/storage/')))->items) {
            SearchYoutubeAPI::_videoListsAll();
        }

        $this->videosYA = (new Fluent($this->parseEncode('RESTYOUTUBE.json', 'public/storage/')))->items;

        $this->ideoSelect = $this->videosYA[0];

    }

    public function render()
    {

        return view('livewire.forms.banner-central.video.form-video');
    }

    public function updatedVideoImportId(){
        $this->ideoSelect['id']['videoId'] = $this->videoImportId;
        $this->render();
    }

    public function publicarPesquisado(){

        VideoYoutube::create([
            'title' =>$this->videoImportName,
            'ifram' => $this->videoImportId,
            'context' => $this->context,
            'details' => $this->details,
            'src' => "https://www.youtube.com/embed/" . $this->videoImportId
        ]);
        $this->render();
        $this->dispatchBrowserEvent('send-success-video', ['message' => 'O ifram para apresentação do vedeo youtube foi inserido como sucesso!']);
        $this->emit('updateViewEle');

    }


    public function actualizar()
    {
        SearchYoutubeAPI::_videoListsAll();
    }

    public function destacarEste($attr)
    {

        VideoYoutube::where('ifram', $attr['id']['videoId'])->delete();
        VideoYoutube::create([
            'title' => $attr['snippet']['title'],
            'ifram' => $attr['id']['videoId'],
            'context' => $attr['snippet']['description'],
            'details' => $attr['snippet']['thumbnails']['high']['url'],
            'src' => "https://www.youtube.com/embed/" . $attr['id']['videoId']
        ]);
        $this->render();
    }

    public function publicarVideo($attr)
    {

        VideoYoutube::create([
            'title' => $attr['snippet']['title'],
            'ifram' => $attr['id']['videoId'],
            'context' => $attr['snippet']['description'],
            'details' => $attr['snippet']['thumbnails']['high']['url'],
            'src' => "https://www.youtube.com/embed/" . $attr['id']['videoId']
        ]);
        $this->render();
        $this->dispatchBrowserEvent('send-success-video', ['message' => 'O ifram para apresentação do vedeo youtube foi inserido como sucesso!']);
    }

    public function removedVideo($attr)
    {
        VideoYoutube::where('ifram', $attr['id']['videoId'])->delete();
        $this->render();
        $this->dispatchBrowserEvent('send-success-video', ['message' => 'O ifram para apresentação do vedeo youtube foi removido como sucesso!']);
    }


    public function selectdNews($attrs)
    {
        $this->ideoSelect = $attrs;
    }


    public function changeDataIfram()
    {
        $pos = strpos($this->data['ifram'], "watch?v=");
        $url = $this->data['ifram'];
        $context = mb_substr($this->data['ifram'], __($pos + 8), __(\Str::length($this->data['ifram']) + 1));

        $this->ifram = "https://www.youtube.com/embed/" . $context;
    }


    public function moverImgPublish()
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
