<?php

namespace App\Http\Livewire\Forms\Cabecalho;

use App\Http\Controllers\API\Publish\HeaderContentAPIController;
use App\Http\Livewire\Base\PaginatedComponent;
use App\Models\FunctionComuns;
use App\Models\Parlamento\Headercontent;
use App\Models\Parlamento\Mainheader;
use App\Models\Parlamento\TaskActivities;
use App\Models\Traits\SoutTable;

class ListaCabecalhos extends paginatedcomponent
{
    use functioncomuns;
    use souttable;

    public $data = ['tipo' => ''];
    // accordion-collapse collapse show   aria-expanded="true"
    public $status = ['element' => 'collapse', 'parent' => 'false'];

    protected $listeners = ['sendtipo', 'updatedOne'];

    public function mount()
    {
        $this->modelName = mainheader::class;

        $this->status['parent'] = false;
        $this->status['element'] = "collapse";
    }

    public function sendtipo($context)
    {
        $this->data['tipo'] = $context;
    }

    public function render()
    {
        return view('livewire.forms.cabecalho.lista-cabecalhos',
            ['dataList' => mainheader::with('socialitesList')->orderby('order')->paginate(3)]
        );
    }

    public function sendevent()
    {
        if (!$this->status['parent']) {
            $this->status['parent'] = true;
            $this->status['element'] = "accordion-collapse collapse show";
        } else {
            $this->status['parent'] = false;
            $this->status['element'] = "collapse";
        }
    }

    public function editingthen(headercontent $element)
    {
        $this->emit('sendheadercontent', $element);
    }

    public function deletethen(headercontent $element)
    {
        $element->delete();
        $this->dispatchbrowserevent('send-success', ['message' => 'registro foi eliminado com sucesso!']);
    }

    public function publishInfo()
    {
        if (headercontentapicontroller::publish())
            $this->dispatchbrowserevent('send-success', ['message' => 'alterações publicadas com sucesso!']);
        else
            $this->dispatchbrowserevent('send-success', ['message' => 'não foi possivel publicar']);
    }

    public function editingThenParent(mainheader $element)
    {
        $this->emit('sendmainheader', $element);
    }

    public function deleteThenParent(mainheader $element)
    {
        $element->delete();

        headercontent::where('socialiteslist', $element->id)->delete();
        headercontent::where('inforlist', $element->id)->delete();
        headercontent::where('linksbox', $element->id)->delete();
        headercontent::where('listlange', $element->id)->delete();

        taskactivities::createdactivity(
            $element->toarray(),
            "livewire.forms.cabecalho.listacabecalhos",
            taskactivities::DELETE, "eliminado o cabeçalho da pagina"
        );

        $this->dispatchbrowserevent('send-success', ['message' => 'o item foi eliminado com sucesso!']);
    }

    public function openSocialiteModal($attr)
    {
        $this->emit('openModal', $attr);
    }

    public function updatedOne()
    {
        $this->render();
    }
}
