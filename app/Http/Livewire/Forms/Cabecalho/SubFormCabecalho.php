<?php

namespace App\Http\Livewire\Forms\Cabecalho;

use App\Models\FunctionComuns;
use App\Models\Parlamento\Headercontent;
use App\Models\Traits\SoutTable;
use Livewire\Component;
use function Symfony\Component\Translation\t;

class SubFormCabecalho extends Component
{
    use FunctionComuns;
    use SoutTable;

    public $data = ['icon' => '', 'url' => '', 'context' => '', 'tipo' => ''];
    public $idParent = ['id' => 0];
    public $headerContent;
    public $tipoSelect = "";
    public $nameTitle = "Titulo";

    protected $listeners = ['sendHeaderContent', 'updatedOne', 'openModal'];

    public function mount()
    {
        $this->initial();
    }


    public function openModal($attr)
    {
        $this->idParent = $attr;
        $this->dispatchBrowserEvent('open-socialite-form');
    }

    public function deleteElement(Headercontent $attr)
    {
        $attr->delete();
        $this->dispatchBrowserEvent('send-success', ['message' => 'O item foi eliminado com sucesso!']);
    }

    public function sendHeaderContent($element)
    {
        $this->data['url'] = $element['url'];
        $this->data['icon'] = $element['icon'];
        $this->data['context'] = $element['context'];

        if ($element['socialitesList'] != null)
            $this->data['tipo'] = 'socialitesList';

        if ($element['inforList'] != null)
            $this->data['tipo'] = 'inforList';

        if ($element['linksBox'] != null)
            $this->data['tipo'] = 'linksBox';

        if ($element['listLange'] != null)
            $this->data['tipo'] = 'listLange';

        $this->headerContent = $element;
    }

    public function render()
    {

        $headercontent = Headercontent::where('parente_id', $this->idParent['id'])->orderBy('tipoItem')->orderBy('order')->get();
        return view('livewire.forms.cabecalho.sub-form-cabecalho', ['headercontent' => $headercontent]);
    }

    public function saveThen()
    {

        try {
            $this->tipoItem();

            $this->data[$this->data['tipo']] = $this->idParent['id'];
            $this->data['order'] = 9000;

            if ($this->data['url'] == '')
                $this->data['url'] = "#";

            $this->data['parente_id'] = $this->idParent['id'];

            if ($this->headerContent) {
                Headercontent::find($this->headerContent['id'])->update($this->data);
                $this->dispatchBrowserEvent('send-success', ['message' => 'Registro actualizado com sucesso no sistema!']);
            } else {
                Headercontent::create($this->data);
                $this->dispatchBrowserEvent('send-success', ['message' => 'Registro inserido com sucesso no sistema']);
            }

            $this->initial();

            $this->emit('updatedOne');

        } catch (\Exception $e) {

        }


    }

    public function updatedDataTipo()
    {
        $this->tipoSelect = $this->data['tipo'];

        if ($this->tipoSelect == "socialitesList")
            $this->nameTitle = "Nome";

        if ($this->tipoSelect == "listLange")
            $this->nameTitle = "Sigla";

        if ($this->tipoSelect == "linksBox")
            $this->nameTitle = "Designação";

        $this->emit('sendTipo', $this->data['tipo']);
    }

    private function initial()
    {
        $this->data = ['icon' => '', 'url' => '', 'context' => ''];
        $this->headerContent = null;
        $this->modelName = Headercontent::class;
    }

    public function editingInfor($attr)
    {

        $this->tipoSelect = $attr['socialitesList'] ? 'socialitesList' : null;
        if (!$this->tipoSelect)
            $this->tipoSelect = $attr['inforList'] ? 'inforList' : null;

        if (!$this->tipoSelect)
            $this->tipoSelect = $attr['linksBox'] ? 'linksBox' : null;

        if (!$this->tipoSelect)
            $this->tipoSelect = $attr['listLange'] ? 'listLange' : null;

        $this->data = [
            'icon' => $attr['icon'],
            'tipo' => $this->tipoSelect,
            'url' => $attr['url'],
            'context' => $attr['context'],
            'designation' => $attr['designation'],

        ];


        $this->headerContent = $attr;
    }


    private function tipoItem()
    {
        if ($this->tipoSelect == 'socialitesList')
            $this->data['tipoItem'] = 1;

        if ($this->tipoSelect == 'inforList')
            $this->data['tipoItem'] = 2;

        if ($this->tipoSelect == 'linksBox')
            $this->data['tipoItem'] = 3;

        if ($this->tipoSelect == 'listLange')
            $this->data['tipoItem'] = 4;
    }

}
