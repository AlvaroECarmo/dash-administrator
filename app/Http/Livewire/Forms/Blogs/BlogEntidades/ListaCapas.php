<?php

namespace App\Http\Livewire\Forms\Blogs\BlogEntidades;

use App\Http\Livewire\Base\PaginatedComponent;
use App\Models\Parlamento\BlogPagContents;
use App\Models\Parlamento\BlogPagDeputy;
use App\Models\Parlamento\Mainmenu;
use App\Models\Parlamento\Social;
use App\Models\Parlamento\TipCategoria;
use App\Models\Traits\SoutTable;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Str;
use Livewire\Component;

class ListaCapas extends PaginatedComponent
{

    use SoutTable;

    protected $listeners = ['changeItemMenu', 'successEventDeputy', 'sendEventList'];
    public $menuItemContentId;
    public $search;
    public $menuIdlegis;
    public $itemMenuDepu = array();
    const BLOG_ARRAY = 'BlogPagEntidades';
    public $dataInicial;
    public $dataFinalFilro;

    public $cargos;

    public $cargoIDTDS;
    public $cargoTextERS;

    public function mount()
    {
        $this->modelName = BlogPagDeputy::class;
        $this->itemMenuDepu = Mainmenu::where('elements', 43)->get();

        $this->cargos = TipCategoria::where('typeDescripts', 'CargosInfo')->get();
    }

    public function render()
    {


        // dd(Date::parse($this->dataInicial)->format('Y-m-d'),Date::parse($this->dataFinalFilro)->format('Y-m-d') );
        // Paginação de deputados Outros perfis
        if (STR::length($this->search) > 2) {
            $capas = BlogPagDeputy::with('socials', 'depudy')
                ->orderBy('title')
                ->where('localkeyMenu', 'LIKE', "%{$this->menuIdlegis}%")
                ->whereDate('created_at', '>=', Date::parse($this->dataInicial)->format('Y-m-d'))
                ->whereDate('created_at', '<=', Date::parse($this->dataFinalFilro)->format('Y-m-d'))
                ->where('cargoText', 'LIKE', "%{$this->cargoTextERS}%")
                ->where('entityType', self::BLOG_ARRAY)
                ->search($this->search)
                ->get();
        } else {

            $capas = BlogPagDeputy::with('socials', 'depudy')
                ->orderBy('ordem')
                ->where('localkeyMenu', 'LIKE', "%{$this->menuIdlegis}%")
                ->whereDate('created_at', '>=', Date::parse($this->dataInicial)->format('Y-m-d'))
                ->whereDate('created_at', '<=', Date::parse($this->dataFinalFilro)->format('Y-m-d'))
                ->where('cargoText', 'LIKE', "%{$this->cargoTextERS}%")
                ->where('entityType', self::BLOG_ARRAY)
                ->get();
        }

        // val
        if (intval(Date::parse($this->dataInicial)->format('Y')) == (intval(Date::now()->format('Y')) - 1)) {
            $capas = BlogPagDeputy::with('socials', 'depudy')
                ->orderBy('ordem')
                ->where('localkeyMenu', 'LIKE', "%{$this->menuIdlegis}%")
                ->whereDate('created_at', '>=', Date::parse($this->dataInicial)->format('Y-m-d'))
                ->whereDate('created_at', '<=', Date::parse($this->dataFinalFilro)->format('Y-m-d'))
                ->where('cargoText', 'LIKE', "%{$this->cargoTextERS}%")
                ->where('entityType', self::BLOG_ARRAY)
                ->paginate(100);
        }

        return view('livewire.forms.blogs.blog-entidades.lista-capas', compact('capas'));
    }

    public function publicTCapa()
    {

        $indexData['header'] = [
            'Author' => "Centro de Informática",
            "Local" => "Assembleia Nacional de Angola",
            "_token" => csrf_token(),
            "Authentication" => \Auth::user()->name
        ];


        foreach (BlogPagDeputy::where('entityType', self::BLOG_ARRAY)->orderBy('ordem')->get()->groupBy('localkeyMenu') as $key => $value) {

            $indexData['entities'] = BlogPagDeputy::with('category')->orderBy('ordem')
                ->where('localkeyMenu', $key)
                ->get();

            \Storage::disk('public')->put("json/{$key}.json", $indexData['entities']);
        }


        foreach (BlogPagDeputy::where('entityType', self::BLOG_ARRAY)
                     ->orderBy('title')->get() as $blg) {

            $entidade['entity'] = $blg;
            $dataUnick = response()->json($entidade, 200, [
                'Content-Type' => 'application/json;charset=UTF-8',
                'Charset' => 'utf-8'
            ], JSON_UNESCAPED_UNICODE)->content();
            \Storage::disk('public')->put("json/{$blg->object_iuu}.json", $dataUnick);
        }

        $this->dispatchBrowserEvent('success-send', ['message' => 'O item foi publicado com sucesso!']);

    }

    public function changeItemMenu($id)
    {
        $this->menuItemContentId = $id;
        // $this->capas = BlogPagDeputy::where('id', $this->menuItemContentId)->orderBy('ordem')->get();
        $this->dispatchBrowserEvent('imageFuncionality');
    }

    public function updated()
    {

        $this->dispatchBrowserEvent('imageFuncionality');
    }

    public function publishAll()
    {

        $indexData['header'] = [
            'Author' => "Centro de Informática",
            "Local" => "Assembleia Nacional de Angola",
            "_token" => csrf_token(),
            "Authentication" => \Auth::user()->name
        ];

        foreach (BlogPagDeputy::with('blogPageBody')->where('entityType', self::BLOG_ARRAY)->get() as $blog) {

            $indexData[$blog->keyMenu]['header']['h1'] = $blog->title;
            $indexData[$blog->keyMenu]['header']['img'] = $blog->imgCapa;
            $indexData[$blog->keyMenu]['header']['url'] = url('storage') . '/';

            $indexData[$blog->keyMenu]['body'] = $blog->blogPageBody;

        }

        //$indexData['noticeCorrent'] = Blogpag::with('anexolists')->orderBy('order')->first();


        $dataSend = response()->json($indexData, 200, [
            'Content-Type' => 'application/json;charset=UTF-8',
            'Charset' => 'utf-8'
        ], JSON_UNESCAPED_UNICODE)->content();

        //$indexDataJSON = json_encode($indexData, true);

        file_put_contents(base_path('public/json/SiteContent.json'), $dataSend);
        $this->dispatchBrowserEvent('send-success', ['message' => 'Foi publicado as alterações no site com sucesso!']);

        // exec('cd C:\Projectos\parlamento_ao && npm run build');
        return $indexData;


    }

    public function removeElement(BlogPagDeputy $attr)
    {
        $attr->delete();

        Social::where('aboutSection', $attr->id)->delete();

        $this->dispatchBrowserEvent('success-send', ['message' => 'O item foi removido como sucesso!']);
        $this->dispatchBrowserEvent('activeFunctionality');
        $this->render();

    }

    public function successEventDeputy()
    {
        $this->render();
        /*  if ($this->menuItemContentId > 0)
              $this->capas = BlogPagDeputy::where('id', $this->menuItemContentId)->orderBy('ordem')->get();
          else
              $this->capas = BlogPagDeputy::orderBy('ordem')->get();*/
    }

    public function sendEventList()
    {
        $this->render();
        /*  if ($this->menuItemContentId > 0)
              $this->capas = BlogPagDeputy::where('id', $this->menuItemContentId)->orderBy('ordem')->get();
          else
              $this->capas = BlogPagDeputy::orderBy('ordem')->get();*/
    }

    public function publicMyCapa($event, $attr)
    {
        $this->emit('sentCapa', $attr);
    }

    public function edtitElement($attr)
    {
        $this->emit('editDataDeputy', $attr);
    }
}




