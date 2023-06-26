<?php

namespace App\Http\Livewire\Forms\BannerCentral\Slider;

use App\Http\Controllers\API\Publish\IndexDataAPIController;
use App\Models\FunctionComuns;
use App\Models\Parlamento\BlogPagContents;
use App\Models\Parlamento\Configure;
use App\Models\Parlamento\Sliderinfo;
use Illuminate\Contracts\View\View;
use Livewire\Component;
use File;

class ListaSlider extends Component
{

    public $upload;

    protected $listeners = ['updatedOne'];


    public function mount(): void
    {
        $this->dispatchBrowserEvent('publicSlider', ['message' => 'As informações da pagina de inicio foi publicado com sucesso!']);


    }

    public function render(): View
    {
        $slider = Sliderinfo::all();
        return view('livewire.forms.banner-central.slider.lista-slider', ['sliders' => $slider]);
    }




    public function infoPublish(): void
    {


        $indexData['header'] = [
            'Author' => "Centro de Informática",
            "Local" => "Assembleia Nacional de Angola",
            "_token" => csrf_token(),
            "Authentication" => \Auth::user()->name
        ];
        $indexData['data'] = Sliderinfo::orderBy('id', 'desc')->get()->take(10);


        foreach (Sliderinfo::orderBy('id', 'desc')->get()->take(10) as $blog) {

            $indexDataInterno['header'] = [
                'Author' => "Centro de Informática",
                "Local" => "Assembleia Nacional de Angola",
                "_token" => csrf_token(),
                "Authentication" => \Auth::user()->name
            ];

            $indexDataInterno['data']['id'] = $blog->id;
            $indexDataInterno['data']['img'] = $blog->url;
            $indexDataInterno['data']['p'] = __($blog->p ?? null) . '<br>' . __($blog->description ?? null);
            $indexDataInterno['data']['context'] = $blog->p;
            $indexDataInterno['data']['destaque'] = $blog->p;

            $indexDataInterno['data']['header']['h1'] = $blog->h1 ?? null;
            $indexDataInterno['data']['header']['img'] = $blog->url ?? null;

            $indexDataInterno['data']['body'] = [
                [
                    'title' => $blog->h1 ?? null,
                    'context' => __($blog->p ?? null) . '<br>' . __($blog->description ?? null)
                ]
            ];


            $indexDataInterno['data']['anexolists'] = [];


            $dataSendContestes = response()->json($indexDataInterno, 200, [
                'Content-Type' => 'application/json;charset=UTF-8',
                'Charset' => 'utf-8'
            ], JSON_UNESCAPED_UNICODE)->content();

            $blogQuery = "Slider_" . $blog->id;
            \Storage::disk('public')->put("json/{$blogQuery}.json", $dataSendContestes);
        }


        $dataSend = response()->json($indexData, 200, [
            'Content-Type' => 'application/json;charset=UTF-8',
            'Charset' => 'utf-8'
        ], JSON_UNESCAPED_UNICODE)->content();

        //$indexDataJSON = json_encode($indexData, true);
        // $location = config('cian.LOCALJSON');

        \Storage::disk('public')->put('json/Slider.json', $dataSend);


        $this->dispatchBrowserEvent('successeventsubinport', ['message' => 'As informações da pagina de inicio foi publicado com sucesso!']);
    }

    public function updatedOne()
    {
        $this->render();
    }


}
