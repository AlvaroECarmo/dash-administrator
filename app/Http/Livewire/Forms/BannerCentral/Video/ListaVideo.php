<?php

namespace App\Http\Livewire\Forms\BannerCentral\Video;

use App\Models\Parlamento\EntityHistory;
use App\Models\Parlamento\VideoYoutube;
use Livewire\Component;

class ListaVideo extends Component
{
    public $itemDelet;
    public $confirm = false;
    protected $listeners = ['updateViewEle'];


    public function render()
    {
        $iframs = VideoYoutube::latest()->paginate(3);
        return view('livewire.forms.banner-central.video.lista-video', [
            'iframs' => $iframs
        ]);
    }

    public function destacarEste(VideoYoutube $attr)
    {
        $data = $attr->toArray();
        $attr->delete();

        VideoYoutube::create($data);
        $this->dispatchBrowserEvent('send-success-video', ['message' => 'Foi publicado as alterações no site com sucesso!']);
    }


    public function moverImgPublish()
    {

        $indexData['header'] = [
            'Author' => "Centro de Informática",
            "Local" => "Assembleia Nacional de Angola",
            "_token" => csrf_token(),
            "Authentication" => \Auth::user()->name
        ];
        $indexData['body_header'] = VideoYoutube::orderBy('id', 'desc')->get()->take(10);
        $indexData['body_content'] = VideoYoutube::orderBy('id', 'desc')->get();

        $item = VideoYoutube::orderBy('id', 'desc')->first();

        $indexData2 = array();
        $indexData2['noticeCorrent']['header'] = [
            "h1" => $item->title,
            "img" => $item->details,
            "codeTool" => true,
        ];
        $indexData2['notices'] = VideoYoutube::orderBy('id', 'desc')->get();

        $dataSend = response()->json($indexData, 200, [
            'Content-Type' => 'application/json;charset=UTF-8',
            'Charset' => 'utf-8'
        ], JSON_UNESCAPED_UNICODE)->content();

        \Storage::disk('public')->put('json/VideosYoutube.json', $dataSend);

        $dataSend2 = response()->json($indexData2, 200, [
            'Content-Type' => 'application/json;charset=UTF-8',
            'Charset' => 'utf-8'
        ], JSON_UNESCAPED_UNICODE)->content();


        \Storage::disk('public')->put('json/Videos.json', $dataSend2);

        $this->dispatchBrowserEvent('send-success-video', ['message' => 'Foi publicado as alterações no site com sucesso!']);

    }


    public function deleteElement($attr)
    {
        $this->itemDelet = $attr;
        $this->dispatchBrowserEvent('confirm-event', 'Pretende eliminar a entidade');
    }


    public function updatedConfirm()
    {

        VideoYoutube::find($this->itemDelet['id'])->delete();
        $this->dispatchBrowserEvent('event-success', ['message' => 'O item foi eliminado com sucesso no sistema!']);
    }

    public function updateViewEle()
    {
        $this->render();
    }
}
