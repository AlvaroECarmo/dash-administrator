<?php

namespace App\Http\Livewire\Forms\BannerCentral\DefinComposicao;

use App\Http\Controllers\API\AboutsectionAPIController;
use App\Http\Controllers\API\Publish\IndexDataAPIController;
use App\Http\Livewire\Base\PaginatedComponent;
use App\Models\Parlamento\Aboutsection;
use App\Models\Parlamento\Configure;
use App\Models\Parlamento\Sliderinfo;
use App\Models\Parlamento\TaskActivities;
use App\Models\Traits\SoutTable;
use Illuminate\Support\Facades\File;

class ListaDefinicaoCompos extends PaginatedComponent
{
    use SoutTable;

    protected $listeners = ['createdEvent'];

    public function mount()
    {
        $this->modelName = Aboutsection::class;
    }

    public function render()
    {
        return view('livewire.forms.banner-central.defin-composicao.lista-definicao-compos', [
            'aboutSection' => Aboutsection::with('imageBox')->orderBy('order')->paginate(3)
        ]);
    }

    public function removeItem(Aboutsection $attribute)
    {
        $attribute->delete();
        TaskActivities::createdActivity(
            $attribute->toArray(),
            "Livewire.Forms.BannerCentral.FormDefinicaoCompos",
            TaskActivities::DELETE, "Eliminado a Difinição e Composição "
        );
        $this->render();
        $this->dispatchBrowserEvent('send-success', ['message' => 'O item foi removido com sucesso da lista!']);
    }

    public function createdEvent()
    {
        $this->dispatchBrowserEvent('activeFunctionality');
        $this->render();
    }

    public function moverImgPublish()
    {

        $indexData['header'] = [
            'Author' => "Centro de Informática",
            "Local" => "Assembleia Nacional de Angola",
            "_token" => csrf_token(),
            "Authentication" => \Auth::user()->name
        ];

        $indexData['data'] = AboutsectionAPIController::aboutsection();

        $dataSend = response()->json($indexData, 200, [
            'Content-Type' => 'application/json;charset=UTF-8',
            'Charset' => 'utf-8'
        ], JSON_UNESCAPED_UNICODE)->content();

        //$indexDataJSON = json_encode($indexData, true);

        //file_put_contents(base_path('public/json/DeficaoComposicao.json'), $dataSend);
        \Storage::disk('public')->put('json/DeficaoComposicao.json', $dataSend);
        $this->dispatchBrowserEvent('send-success', ['message' => 'Foram publicadas as alterações com sucesso!']);
    }
}
