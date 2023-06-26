<?php

namespace App\Http\Livewire\Forms\Blogs\BlogDeputado;

use App\Http\Livewire\Base\PaginatedComponent;
use App\Models\Parlamento\BlogPagContents;
use App\Models\Parlamento\BlogPagDeputy;
use App\Models\Parlamento\Mainmenu;
use App\Models\Parlamento\Social;
use App\Models\Traits\SoutTable;
use Illuminate\Support\Fluent;
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
    const BLOG_ARRAY = 'BlogPagDeputy';

    // public $capas = array();

    public function mount()
    {
        $this->modelName = BlogPagDeputy::class;
        $this->itemMenuDepu = Mainmenu::where('elements', 212)->get();
    }

    public function render()
    {
        if ((STR::length($this->search) > 2) && $this->menuIdlegis) {
            $capas = BlogPagDeputy::with('socials', 'depudy')
                ->orderBy('title')
                ->where('localkeyMenu', $this->menuIdlegis)
                ->where('entityType', self::BLOG_ARRAY)
                ->search($this->search)
                ->paginate(4);
        } else if (STR::length($this->search) > 2) {
            $capas = BlogPagDeputy::with('socials', 'depudy')
                ->orderBy('title')
                ->where('entityType', self::BLOG_ARRAY)
                ->search($this->search)
                ->paginate(4);
        } else if ($this->menuIdlegis) {
            $capas = BlogPagDeputy::with('socials', 'depudy')
                ->orderBy('title')
                ->where('localkeyMenu', $this->menuIdlegis)
                ->where('entityType', self::BLOG_ARRAY)
                ->paginate(230);
        } else {

            $capas = BlogPagDeputy::with('socials', 'depudy')
                ->orderBy('ordem')
                ->where('entityType', self::BLOG_ARRAY)
                ->paginate(4);
        }


        return view('livewire.forms.blogs.blog-deputado.lista-capas', [
            'capas' => $capas
        ]);
    }

    public function publicTCapa()
    {


        $indexData['header'] = [
            'Author' => "Centro de Informática",
            "Local" => "Assembleia Nacional de Angola",
            "_token" => csrf_token(),
            "Authentication" => \Auth::user()->name
        ];

        /**
         * "id" => "15"
         * "keyMenu" => "Alberto Paulino"
         * "imgCapa" => "Alberto_Paulino/img/7Bz1CR9WzOXUeRCQ2YWfCuzA9gw4xDjFWxjRd5Io.jpg"
         * "title" => "Alberto Paulino"
         * "context" => "<!-- wp:html -->Grupo Parlamentar MPLA;Círculo Eleitoral Nacional; Habilitações Literárias: Licenciatura Comissão Parlamentar 4ª Comissão: Administração do Esta ▶"
         * "email" => "Alberto.Paulino@parlamento.ao"
         * "object_iuu" => "Alberto_Paulino_319"
         * "user_id" => "6"
         * "ordem" => null
         * "created_at" => "2022-08-18 13:31:32.617"
         * "updated_at" => "2023-01-09 10:16:17.653"
         * "deleted_at" => null
         * "localkeyMenu" => "IV-legislatura"
         * "entityType" => "BlogPagDeputy"
         * "cargoID" => null
         * "cargoText" => null
         * "departamentoID" => null
         * "departamentoName" => null
         */

        foreach (BlogPagDeputy::where('entityType', self::BLOG_ARRAY)
                     ->orderBy('title')->get()->groupBy('localkeyMenu') as $key => $value) {

            $indexData['entities'] = BlogPagDeputy::with('socials')->where('entityType', self::BLOG_ARRAY)->orderBy('title')
                ->where('localkeyMenu', $key)
                ->get()->map(function ($e) use ($key) {

                    $data = $e;
                    $data->object_iuu = $e->object_iuu . '_' . $e->localkeyMenu;

                    return $data;
                })->toArray();


            //$endidate['entity'] = $value;
            $arrayDeputies = response()->json($indexData['entities'], 200, [
                'Content-Type' => 'application/json;charset=UTF-8',
                'Charset' => 'utf-8'
            ], JSON_UNESCAPED_UNICODE)->content();


            try {
                \Storage::disk('public')->put("json/{$key}.json", $arrayDeputies);
            } catch (\Exception $ex) {

            }


        }


        foreach (BlogPagDeputy::where('entityType', self::BLOG_ARRAY)->get() as $blg) {

            $entidade['entity'] = $blg;
            $dataUnick = response()->json($entidade, 200, [
                'Content-Type' => 'application/json;charset=UTF-8',
                'Charset' => 'utf-8'
            ], JSON_UNESCAPED_UNICODE)->content();

            $urls = $blg->object_iuu . "_" . $blg->localkeyMenu;

            \Storage::disk('public')->put("json/{$urls}.json", $dataUnick);
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
