<?php

namespace App\Http\Livewire\Forms\BannerCentral\Noticia;

use App\Http\Livewire\Base\PaginatedComponent;
use App\Models\Parlamento\Blogpag;
use App\Models\Traits\SoutTable;
use Illuminate\Support\Facades\Date;

class ListaNoticia extends PaginatedComponent
{
    use SoutTable;

    protected $listeners = ['sendSucess'];
    public $titleInfor;
    public $dataFinalFilro;
    public $dataInicial;

    public function mount(): void
    {
        $this->modelName = Blogpag::class;
        $this->dataInicial = Date::now()->subtract(30, 'days')->format('d-m-Y');
        $this->dataFinalFilro = \date('d-m-Y');

    }

    public function render()
    {
        if (\Str::length($this->titleInfor) > 3) {
            $noticies = Blogpag::with('anexolists')->orderBy('id', 'desc')->orderBy('created_at', 'desc')
                ->whereDate('created_at', '>=', Date::parse($this->dataInicial)->format('Y-m-d'))
                ->whereDate('created_at', '<=', Date::parse($this->dataFinalFilro)->format('Y-m-d'))
                ->search($this->titleInfor)
                ->paginate(3);
        } else {
            $noticies = Blogpag::with('anexolists')->orderBy('id', 'desc')->orderBy('created_at', 'desc')
                ->whereDate('created_at', '>=', Date::parse($this->dataInicial)->format('Y-m-d'))
                ->whereDate('created_at', '<=', Date::parse($this->dataFinalFilro)->format('Y-m-d'))
                ->paginate(3);
        }

        $this->dispatchBrowserEvent('activeFunctionality');
        return view('livewire.forms.banner-central.noticia.lista-noticia', [
            'aboutSection' => $noticies,
        ]);
    }

    public function removeItem(Blogpag $item)
    {
        $item->delete();
        $this->dispatchBrowserEvent('success-send', ['message' => 'A noticia foi eliminado com sucesso!']);
    }

    public function sendSucess()
    {
        $this->render(); // --
    }

    public function moverImgPublish()
    {
        $indexData['header'] = [
            'Author' => "Centro de Informática",
            "Local" => "Assembleia Nacional de Angola",
            "_token" => csrf_token(),
            "Authentication" => \Auth::user()->name,
        ];

        $item = Blogpag::with('anexolists')->orderBy('id', 'desc')->first();
        $indexData['noticeCorrent'] = $item;
        $indexData['noticeCorrent']['baseUrl'] = url('storage') . '/';
        $info = Blogpag::with('anexolists')->orderBy('id', 'desc')->get();
        $indexData['notices'] = $info;
        $indexData['DataEvento'] = $item->dataEvento;

        $indexData['noticeCorrent']['header'] = [
            "h1" => $item->context,
            "img" => $item->img,
            "codeTool" => true,
        ];

        $dataSend = response()->json($indexData, 200, [
            'Content-Type' => 'application/json;charset=UTF-8',
            'Charset' => 'utf-8',
        ], JSON_UNESCAPED_UNICODE)->content();

        //$indexDataJSON = json_encode($indexData, true);
        $dataPublic = config('cian.LOCALJSON');
        //file_put_contents(base_path($dataPublic . 'Noticia.json'), $dataSend);
        \Storage::disk('public')->put('json/Noticia.json', $dataSend);

        foreach ($info as $item) {

            $dataInfo['data'] = $item;
            $dataInfo['data']['header'] = [
                "h1" => "",
                "img" => $item->img,
            ];

            $dataInfo['data']['body'] = [
                [
                    "title" => $item->context,
                    "context" => $item->p,
                ],
            ];

            $dataSend = response()->json($dataInfo, 200, [
                'Content-Type' => 'application/json;charset=UTF-8',
                'Charset' => 'utf-8',
            ], JSON_UNESCAPED_UNICODE)->content();
            \Storage::disk('public')->put("json/Noticia_{$item->id}.json", $dataSend);
        }

        $this->dispatchBrowserEvent('send-success', ['message' => 'Foi publicado as alterações no site com sucesso!']);


    }

    public function editarConteudo($attr)
    {

        $this->emit('alterarNoticias', $attr);
    }

}
