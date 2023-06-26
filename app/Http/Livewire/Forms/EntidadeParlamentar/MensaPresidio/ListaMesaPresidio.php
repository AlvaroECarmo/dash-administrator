<?php

namespace App\Http\Livewire\Forms\EntidadeParlamentar\MensaPresidio;

use App\Http\Controllers\API\Publish\IndexDataAPIController;
use App\Http\Controllers\API\SchedulessectionAPIController;
use App\Http\Controllers\API\SolutionssectionAPIController;
use App\Http\Livewire\Base\PaginatedComponent;
use App\Models\Deputy\Deputy;
use App\Models\Parlamento\Configure;
use App\Models\Parlamento\EntityHistory;
use App\Models\Parlamento\Schedulessection;
use App\Models\Parlamento\Sliderinfo;
use App\Models\Parlamento\Social;
use App\Models\Parlamento\Tab;
use Illuminate\Support\Facades\Validator;

class ListaMesaPresidio extends PaginatedComponent
{

    protected $listeners = ['updatedElement'];

    public $itemDelet = array();
    public $confirm = false;
    public $nomeDeputado = '';
    public $schedulesSections = array();
    public $schedulesSection;


    public function mount()
    {
        $this->schedulesSections = Schedulessection::all();
    }

    public function render()
    {

        $deputadosPresidio = EntityHistory::where('type', 'Mesa do Presidio')
            ->orderBy('order_on', 'asc')
            ->get();


        return view('livewire.forms.entidade-parlamentar.mensa-presidio.lista-mesa-presidio', [
            'deputadosPresidio' => $deputadosPresidio,
         ]);
    }

    public function updatedElement()
    {
        $this->render();
    }

    public function deleteElement($attr)
    {
        $this->itemDelet = $attr;

        $this->dispatchBrowserEvent('confirm-event', 'Pretende eliminar a entidade');
    }

    public function updatedConfirm()
    {

        Social::where('deputy_id', $this->itemDelet['primavera_id'])->delete();
        EntityHistory::find($this->itemDelet['id'])->delete();
        $this->dispatchBrowserEvent('event-success', ['message' => 'A entidade foi eliminado com sucesso no sistema!']);
    }

    public function collImageSet(Deputy $attr)
    {
        dump('this element attr', $attr->id);
    }

    public function moverImg()
    {
        $this->validateSc();

        $indexData['header'] = [
            'Author' => "Centro de Informática",
            "Local" => "Assembleia Nacional de Angola",
            "_token" => csrf_token(),
            "Authentication" => \Auth::user()->name
        ];


        $indexData['data'] = Schedulessection::where('id', $this->schedulesSection)->with(
            'subscribeInner', 'subscribeInner.history', 'tabbtnslis', 'subscribeInner.tabEntity.socialites'
        )->first();


        $indexData['data']['tabs_content'] = [
            "id" => 1,
            "tab2" => Tab::with('tabEntity.socialites')->where('tabId', 2)
                ->whereIn('id', EntityHistory::get('id_tabOriginal')->toArray() ?? [])
                ->orderBy('tabId')
                ->orderBy('id')
                ->get(),

            "tab3" => Tab::with('tabEntity.socialites')->where('tabId', 3)
                ->whereIn('id', EntityHistory::get('id_tabOriginal')->toArray() ?? [])
                ->orderBy('tabId')
                ->orderBy('id')
                ->get()
        ];

        $dataSend = response()->json($indexData, 200, [
            'Content-Type' => 'application/json;charset=UTF-8',
            'Charset' => 'utf-8'
        ], JSON_UNESCAPED_UNICODE)->content();

        $location = config('cian.LOCALJSON');

        // file_put_contents(base_path($location . 'MessaPresidio.json'), $dataSend);
        \Storage::disk('public')->put('json/MessaPresidio.json', $dataSend);
        $this->dispatchBrowserEvent('event-success', ['message' => 'As informações da pagina de inicio foi publicado com sucesso!']);

    }

    public function validateSc()
    {
        $validado = Validator::make(['schedulesSection' => $this->schedulesSection], [
            'schedulesSection' => 'required',
        ])->setCustomMessages([
            'schedulesSection.required' => 'É importante que seleciones a secção de apresentação à publicar no sistema...',
        ]);


        if ($validado->fails()) {
            $this->dispatchBrowserEvent('show-fails', ['message' => $validado->getMessageBag()->first()]);
            $validado->validate();
        }
    }

    public function alterarElemento($attr)
    {
        $this->emit('updateMedaPresidio', $attr);
    }
}
